@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="grid gap-10 lg:grid-cols-2">
    <div class="space-y-4">
        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/600x450' }}" class="w-full rounded-2xl shadow-sm" alt="{{ $product->name }}">
        <div class="grid grid-cols-3 gap-3">
            @forelse ($product->images as $image)
                <img src="{{ asset('storage/' . $image->image) }}" class="h-28 w-full object-cover rounded-xl border" alt="{{ $product->name }}">
            @empty
                <p class="col-span-3 text-sm text-slate-500">Pas d'autres images disponibles.</p>
            @endforelse
        </div>
    </div>
    <div class="space-y-6">
        <div>
            <p class="text-sm uppercase text-slate-400">{{ $product->type->name ?? 'Produit' }}</p>
            <h1 class="text-3xl font-semibold">{{ $product->name }}</h1>
            <p class="text-slate-500 mt-2">{{ $product->description }}</p>
        </div>
        <div class="flex items-center gap-4">
            <span class="text-3xl font-bold text-indigo-600">{{ number_format($product->price, 2, ',', ' ') }} DA</span>
            <span class="text-sm text-slate-500">Stock : {{ $product->stock > 0 ? $product->stock : 'Indisponible' }}</span>
        </div>
        <ul class="text-sm text-slate-500 space-y-1">
            <li><span class="font-semibold">Marque :</span> {{ $product->brand ?? 'N/A' }}</li>
            <li><span class="font-semibold">Couleur :</span> {{ $product->color ?? 'N/A' }}</li>
            <li><span class="font-semibold">Catégorie :</span> {{ $product->category->name ?? '—' }}</li>
        </ul>

        <form method="POST" action="{{ route('cart.add') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1">Quantité</label>
                <input type="number" name="quantity" min="1" value="1" class="w-32 rounded border border-slate-200 px-3 py-2">
            </div>
            <button class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-700" @disabled($product->stock <= 0)>
                Ajouter au panier
            </button>
        </form>
    </div>
</div>
@endsection
