<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['type', 'category', 'images']);

        if ($search = $request->string('q')->trim()) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%");
            });
        }

        if ($typeId = $request->input('product_type_id')) {
            $query->where('product_type_id', $typeId);
        }

        if ($categoryId = $request->input('category_id')) {
            $query->where('category_id', $categoryId);
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', (float) $request->input('price_min'));
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', (float) $request->input('price_max'));
        }

        $products = $query->latest()->paginate(12)->withQueryString();

        if ($request->expectsJson()) {
            return response()->json($products);
        }

        $viewData = [
            'products' => $products,
            'types' => ProductType::orderBy('name')->get(),
            'categories' => Category::orderBy('name')->get(),
        ];

        if ($request->routeIs('admin.produits.*')) {
            return view('admin.products.index', $viewData);
        }

        return view('shop.products.index', $viewData);
    }

    public function byType(Request $request, string $type)
    {
        $typeMap = [
            'lunettes' => 1,
            'lentilles' => 2,
            'verres-medicaux' => 3,
            'accessoires' => 4,
        ];

        $typeId = $typeMap[$type] ?? null;
        if (!$typeId) {
            abort(404);
        }

        $query = Product::with(['type', 'category', 'images'])
                        ->where('product_type_id', $typeId);

        if ($search = $request->string('q')->trim()) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%");
            });
        }

        $products = $query->latest()->paginate(12)->withQueryString();
        
        if ($request->expectsJson()) {
            return response()->json($products);
        }

        $typeName = match($type) {
            'lunettes' => 'Lunettes',
            'lentilles' => 'Lentilles',
            'verres-medicaux' => 'Verres médicaux',
            'accessoires' => 'Accessoires',
            default => 'Produits',
        };

        return view('shop.products.by-type', [
            'products' => $products,
            'type' => $type,
            'typeName' => $typeName,
        ]);
    }

    public function create(): View
    {
        return view('admin.products.create', [
            'types' => ProductType::orderBy('name')->get(),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $data = $this->validateProduct($request);

        $data['image'] = $this->storePrimaryImage($request);

        $product = Product::create($data);

        $this->syncGallery($product, $request);

        return $this->respondSaved($request, $product, 'Produit ajouté avec succès.');
    }

    public function show(Product $product)
    {
        $product->load(['type', 'category', 'images']);

        if (request()->expectsJson()) {
            return response()->json($product);
        }

        if (request()->routeIs('admin.produits.show')) {
            return view('admin.products.show', [
                'product' => $product,
            ]);
        }

        return view('shop.products.show', [
            'product' => $product,
        ]);
    }

    public function edit(Product $product): View
    {
        return view('admin.products.edit', [
            'product' => $product->load('images'),
            'types' => ProductType::orderBy('name')->get(),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Product $product): RedirectResponse|JsonResponse
    {
        $data = $this->validateProduct($request, true);

        if ($request->hasFile('primary_image')) {
            $this->deleteFile($product->image);
            $data['image'] = $this->storePrimaryImage($request);
        }

        $product->update($data);

        $this->syncGallery($product, $request);

        return $this->respondSaved($request, $product, 'Produit mis à jour.');
    }

    public function destroy(Product $product): RedirectResponse|JsonResponse
    {
        // Check if product has associated orders
        if ($product->orderItems()->exists()) {
            return back()->with('error', 'Ce produit ne peut pas être supprimé car il est associé à des commandes.');
        }

        // Load images before deletion
        $product->load(['images']);

        $this->deleteFile($product->image);
        foreach ($product->images as $image) {
            $this->deleteFile($image->image);
        }
        $product->delete();

        if (request()->expectsJson()) {
            return response()->json(['message' => 'Produit supprimé.']);
        }

        return back()->with('success', 'Produit supprimé.');
    }

    protected function validateProduct(Request $request, bool $isUpdate = false): array
    {
        return $request->validate([
            'product_type_id' => ['required', 'exists:product_types,id'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'brand' => ['nullable', 'string', 'max:255'],
            'color' => ['nullable', 'string', 'max:255'],
            'primary_image' => [$isUpdate ? 'nullable' : 'required', 'image', 'max:4096'],
            'gallery.*' => ['nullable', 'image', 'max:4096'],
            'clear_gallery' => ['nullable', 'boolean'],
        ]);
    }

    protected function storePrimaryImage(Request $request): ?string
    {
        return $request->file('primary_image')
            ? $request->file('primary_image')->store('products', 'public')
            : null;
    }

    protected function syncGallery(Product $product, Request $request): void
    {
        if ($request->boolean('clear_gallery')) {
            foreach ($product->images as $image) {
                $this->deleteFile($image->image);
            }
            $product->images()->delete();
        }

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $path = $file->store('products/gallery', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                ]);
            }
        }
    }

    protected function deleteFile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    protected function respondSaved(Request $request, Product $product, string $message)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'message' => $message,
                'product' => $product->load('images'),
            ]);
        }

        return redirect()->route('admin.produits.index')->with('success', $message);
    }
}
