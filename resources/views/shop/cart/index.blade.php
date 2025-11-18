@extends('layouts.app')

@section('title', 'Mon panier')

@section('content')
<h1 class="text-2xl font-semibold mb-6">Mon panier</h1>
<div class="grid gap-8 lg:grid-cols-3">
    <div class="lg:col-span-2 space-y-4">
        @forelse ($items as $item)
            <div class="bg-white rounded-xl shadow-sm p-4 flex items-center gap-4">
                <img src="{{ $item['image'] ? asset('storage/' . $item['image']) : 'https://via.placeholder.com/100x100' }}" class="w-24 h-24 object-cover rounded-lg" alt="{{ $item['name'] }}">
                <div class="flex-1">
                    <h2 class="font-semibold">{{ $item['name'] }}</h2>
                    <p class="text-slate-500 text-sm">{{ number_format($item['price'], 2, ',', ' ') }} DA</p>
                    <form method="POST" action="{{ route('cart.update', $item['product']) }}" class="mt-2 flex items-center gap-2">
                        @csrf
                        @method('PATCH')
                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                            class="w-24 rounded border border-slate-200 px-3 py-1">
                        <button class="text-sm text-indigo-600 font-semibold">Mettre à jour</button>
                    </form>
                </div>
                <form method="POST" action="{{ route('cart.remove', $item['product']) }}">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500">Supprimer</button>
                </form>
            </div>
        @empty
            <div class="bg-white rounded-xl shadow-sm p-8 text-center text-slate-500">
                Votre panier est vide.
            </div>
        @endforelse
        @if ($items)
            <form method="POST" action="{{ route('cart.clear') }}" class="text-right">
                @csrf
                @method('DELETE')
                <button class="text-sm text-red-500">Vider le panier</button>
            </form>
        @endif
    </div>
    <aside class="bg-white rounded-xl shadow-sm p-6 space-y-4">
        <h2 class="text-xl font-semibold">Récapitulatif</h2>
        <div class="flex items-center justify-between text-sm">
            <span>Sous-total</span>
            <span class="font-semibold">{{ number_format($total, 2, ',', ' ') }} DA</span>
        </div>
        <a href="{{ route('checkout') }}" class="block bg-indigo-600 text-center text-white py-3 rounded-lg font-semibold @if(empty($items)) opacity-50 pointer-events-none @endif">
            Passer la commande
        </a>
    </aside>
</div>
@endsection
