@extends('layouts.app')

@section('title', 'Commande #' . $order->id)

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-semibold">Commande #{{ $order->id }}</h1>
        <p class="text-sm text-slate-500">Passée le {{ $order->created_at->format('d/m/Y à H:i') }}</p>
    </div>
    <span class="px-4 py-1.5 rounded-full bg-slate-100 text-sm font-medium">Statut : {{ ucfirst($order->status) }}</span>
</div>
<div class="grid gap-8 lg:grid-cols-3">
    <section class="bg-white rounded-xl shadow-sm p-6 lg:col-span-2 space-y-4">
        <h2 class="text-lg font-semibold">Articles</h2>
        @foreach ($order->items as $item)
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <div>
                    <p class="font-semibold">{{ $item->product->name }}</p>
                    <p class="text-sm text-slate-500">Qté : {{ $item->quantity }}</p>
                </div>
                <span class="font-semibold">{{ number_format($item->price * $item->quantity, 2, ',', ' ') }} DA</span>
            </div>
        @endforeach
    </section>
    <aside class="bg-white rounded-xl shadow-sm p-6 space-y-3">
        <h2 class="text-lg font-semibold">Détails de livraison</h2>
        <p class="text-sm text-slate-500">{{ $order->customer_name }}</p>
        <p class="text-sm text-slate-500">{{ $order->customer_phone }}</p>
        <p class="text-sm text-slate-500">{{ $order->customer_address }}</p>
        <p class="text-sm text-slate-500">{{ ucfirst($order->delivery_type) }} - {{ $order->wilaya }}</p>
        <div class="border-t border-slate-100 pt-3 text-sm">
            <div class="flex justify-between">
                <span>Sous-total</span>
                <span>{{ number_format($order->items->sum(fn($item) => $item->price * $item->quantity), 2, ',', ' ') }} DA</span>
            </div>
            <div class="flex justify-between font-semibold text-lg">
                <span>Total</span>
                <span>{{ number_format($order->total_price, 2, ',', ' ') }} DA</span>
            </div>
        </div>
        @if ($order->prescription_image)
            <a href="{{ asset('storage/' . $order->prescription_image) }}" class="text-indigo-600 text-sm font-semibold" target="_blank">Voir l'ordonnance</a>
        @endif
    </aside>
</div>
@endsection
