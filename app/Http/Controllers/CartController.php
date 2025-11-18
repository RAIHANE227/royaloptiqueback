<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(Request $request): View|JsonResponse
    {
        [$items, $total] = $this->itemsWithTotals();

        if ($request->expectsJson()) {
            return response()->json([
                'items' => array_values($items),
                'total' => $total,
            ]);
        }

        return view('shop.cart.index', [
            'items' => $items,
            'total' => $total,
        ]);
    }

    public function add(Request $request): RedirectResponse|JsonResponse
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $product = Product::findOrFail($data['product_id']);

        if ($product->stock < $data['quantity']) {
            return $this->cartError('Stock insuffisant pour cet article.', $request);
        }

        $items = $this->cartItems();

        $items[$product->id] = [
            'product_id' => $product->id,
            'quantity' => Arr::get($items, "$product->id.quantity", 0) + $data['quantity'],
            'price' => $product->price,
            'name' => $product->name,
            'image' => $product->image,
        ];

        $this->saveCart($items);

        return $this->cartSuccess('Article ajouté au panier.', $request);
    }

    public function update(Request $request, Product $product): RedirectResponse|JsonResponse
    {
        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        if ($product->stock < $data['quantity']) {
            return $this->cartError('Stock insuffisant pour cet article.', $request);
        }

        $items = $this->cartItems();

        if (! isset($items[$product->id])) {
            return $this->cartError('Article introuvable dans le panier.', $request, 404);
        }

        $items[$product->id]['quantity'] = $data['quantity'];
        $items[$product->id]['price'] = $product->price;

        $this->saveCart($items);

        return $this->cartSuccess('Quantité mise à jour.', $request);
    }

    public function remove(Request $request, Product $product): RedirectResponse|JsonResponse
    {
        $items = $this->cartItems();
        unset($items[$product->id]);
        $this->saveCart($items);

        return $this->cartSuccess('Article supprimé du panier.', $request);
    }

    public function clear(Request $request): RedirectResponse|JsonResponse
    {
        session()->forget('cart.items');
        return $this->cartSuccess('Panier vidé.', $request);
    }

    public function summary(): JsonResponse
    {
        [$items, $total] = $this->itemsWithTotals();

        return response()->json([
            'items' => array_values($items),
            'total' => $total,
        ]);
    }

    protected function cartItems(): array
    {
        return session('cart.items', []);
    }

    protected function saveCart(array $items): void
    {
        session(['cart.items' => $items]);
    }

    protected function itemsWithTotals(): array
    {
        $items = $this->cartItems();
        $productIds = array_keys($items);
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        $total = 0;
        foreach ($items as $id => &$item) {
            if (! isset($products[$id])) {
                unset($items[$id]);
                continue;
            }

            $product = $products[$id];
            $item['name'] = $product->name;
            $item['price'] = $product->price;
            $item['image'] = $product->image;
            $item['subtotal'] = $item['price'] * $item['quantity'];
            $item['product'] = $product;
            $total += $item['subtotal'];
        }

        return [$items, $total];
    }

    protected function cartSuccess(string $message, Request $request): RedirectResponse|JsonResponse
    {
        if ($request->expectsJson()) {
            [$items, $total] = $this->itemsWithTotals();
            return response()->json([
                'message' => $message,
                'items' => array_values($items),
                'total' => $total,
            ]);
        }

        return redirect()->route('cart.index')->with('success', $message);
    }

    protected function cartError(string $message, Request $request, int $code = 422): RedirectResponse|JsonResponse
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $message], $code);
        }

        return back()->with('error', $message);
    }
}
