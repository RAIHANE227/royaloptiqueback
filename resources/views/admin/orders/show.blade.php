@extends('layouts.admin')

@section('title', 'Commande #' . $order->id)
@section('header', 'Détail commande')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-semibold">Commande #{{ $order->id }}</h1>
        <p class="text-sm text-slate-500">Client : {{ $order->customer_name }}</p>
    </div>
    <form method="POST" action="{{ route('admin.commandes.update', $order) }}" class="flex items-center gap-3">
        @csrf
        @method('PUT')
        <select name="status" class="rounded border border-slate-200 px-3 py-2 text-sm">
            @foreach (['pending', 'processing', 'shipped', 'completed', 'canceled'] as $status)
                <option value="{{ $status }}" @selected($order->status === $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
        <button class="bg-indigo-600 text-white px-4 py-2 rounded">Mettre à jour</button>
    </form>
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
        <h2 class="text-lg font-semibold">Livraison & paiement</h2>
        <p class="text-sm text-slate-500">Téléphone : {{ $order->customer_phone }}</p>
        <p class="text-sm text-slate-500">Adresse : {{ $order->customer_address }}</p>
        <p class="text-sm text-slate-500">Wilaya : {{ $order->wilaya }}</p>
        <p class="text-sm text-slate-500">Type : {{ ucfirst($order->delivery_type) }}</p>
        <div class="border-t border-slate-100 pt-3 text-sm">
            <div class="flex justify-between">
                <span>Total</span>
                <span class="font-semibold">{{ number_format($order->total_price, 2, ',', ' ') }} DA</span>
            </div>
        </div>
        @if ($order->prescription_image)
            <a href="{{ asset('storage/' . $order->prescription_image) }}" class="text-indigo-600 text-sm font-semibold" target="_blank">Voir l'ordonnance</a>
        @endif
    </aside>
</div>
@endsection
