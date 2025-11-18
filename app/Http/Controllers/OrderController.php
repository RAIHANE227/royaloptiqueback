<?php

namespace App\Http\Controllers;

use App\Models\DeliveryFee;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $query = Order::with('user')->latest();

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        return view('admin.orders.index', [
            'orders' => $query->paginate(25)->withQueryString(),
        ]);
    }

    public function myOrders(): View
    {
        $orders = Auth::user()->orders()->with('items.product')->latest()->paginate(10);

        return view('shop.orders.index', compact('orders'));
    }

    public function create(): View|RedirectResponse
    {
        [$items, $subtotal] = $this->cartItemsWithTotals();

        if (empty($items)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        return view('shop.checkout.index', [
            'items' => $items,
            'subtotal' => $subtotal,
            'deliveryFees' => DeliveryFee::orderBy('wilaya')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse|JsonResponse
    {
        [$items, $subtotal] = $this->cartItemsWithTotals();

        if (empty($items)) {
            return $this->orderError('Votre panier est vide.', $request);
        }

        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:50'],
            'customer_address' => ['required', 'string', 'max:255'],
            'delivery_type' => ['required', 'in:home,office'],
            'wilaya' => ['required', 'string', 'max:255'],
            'prescription_image' => ['nullable', 'image', 'max:4096'],
        ]);

        $deliveryFee = DeliveryFee::where('wilaya', $data['wilaya'])->first();

        if (! $deliveryFee) {
            return $this->orderError('Aucun tarif de livraison disponible pour cette wilaya.', $request);
        }

        $deliveryAmount = $deliveryFee->getFeeForType($data['delivery_type']);
        $prescriptionPath = $request->hasFile('prescription_image')
            ? $request->file('prescription_image')->store('orders/prescriptions', 'public')
            : null;

        try {
            $order = DB::transaction(function () use ($items, $subtotal, $deliveryAmount, $data, $prescriptionPath) {
                foreach ($items as $item) {
                    if ($item['product']->stock < $item['quantity']) {
                        throw ValidationException::withMessages([
                            'stock' => "Le produit {$item['product']->name} n'a plus assez de stock.",
                        ]);
                    }
                }

                $order = Order::create([
                    'user_id' => Auth::id(),
                    'total_price' => $subtotal + $deliveryAmount,
                    'status' => 'pending',
                    'customer_name' => $data['customer_name'],
                    'customer_phone' => $data['customer_phone'],
                    'customer_address' => $data['customer_address'],
                    'prescription_image' => $prescriptionPath,
                    'delivery_type' => $data['delivery_type'],
                    'wilaya' => $data['wilaya'],
                ]);

                foreach ($items as $item) {
                    $product = $item['product'];
                    $product->decrement('stock', $item['quantity']);

                    $order->items()->create([
                        'product_id' => $product->id,
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                    ]);
                }

                return $order;
            });
        } catch (ValidationException $e) {
            if ($prescriptionPath) {
                Storage::disk('public')->delete($prescriptionPath);
            }

            throw $e;
        }

        session()->forget('cart.items');

        return $this->orderSuccess('Commande enregistrée.', $request, $order);
    }

    public function show(Order $order)
    {
        $order->load('items.product', 'user');

        if (! Auth::user()->isAdmin() && $order->user_id !== Auth::id()) {
            abort(403);
        }

        if (Auth::user()->isAdmin()) {
            return view('admin.orders.show', compact('order'));
        }

        return view('shop.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order): RedirectResponse|JsonResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:pending,processing,shipped,completed,canceled'],
            'customer_phone' => ['nullable', 'string', 'max:50'],
            'customer_address' => ['nullable', 'string', 'max:255'],
        ]);

        $previousStatus = $order->status;

        $order->update($data);

        if ($previousStatus !== 'canceled' && $order->status === 'canceled') {
            foreach ($order->items as $item) {
                $item->product->increment('stock', $item->quantity);
            }
        }

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Commande mise à jour.']);
        }

        return back()->with('success', 'Commande mise à jour.');
    }

    public function destroy(Order $order): RedirectResponse
    {
        if ($order->status !== 'canceled') {
            foreach ($order->items as $item) {
                $item->product->increment('stock', $item->quantity);
            }
        }

        if ($order->prescription_image) {
            Storage::disk('public')->delete($order->prescription_image);
        }

        $order->delete();

        return back()->with('success', 'Commande supprimée.');
    }

    protected function cartItemsWithTotals(): array
    {
        $items = session('cart.items', []);
        $productIds = array_keys($items);
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        $subtotal = 0;
        foreach ($items as $id => &$item) {
            if (! isset($products[$id])) {
                unset($items[$id]);
                continue;
            }

            $product = $products[$id];
            $item['product'] = $product;
            $item['price'] = $product->price;
            $item['subtotal'] = $product->price * $item['quantity'];
            $subtotal += $item['subtotal'];
        }

        return [$items, $subtotal];
    }

    protected function orderSuccess(string $message, Request $request, Order $order)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'message' => $message,
                'order' => $order->load('items.product'),
            ]);
        }

        return redirect()->route('orders.show', $order)->with('success', $message);
    }

    protected function orderError(string $message, Request $request, int $code = 422)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $message], $code);
        }

        return back()->with('error', $message);
    }
}
