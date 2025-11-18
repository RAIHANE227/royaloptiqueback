@extends('layouts.admin')

@section('title', 'Produits')
@section('header', 'Gestion des produits')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Produits</h1>
    <a href="{{ route('admin.produits.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-semibold">Ajouter</a>
</div>
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
            <tr>
                <th class="text-left px-4 py-3">Nom</th>
                <th class="text-left px-4 py-3">Type</th>
                <th class="text-left px-4 py-3">Prix</th>
                <th class="text-left px-4 py-3">Stock</th>
                <th class="text-right px-4 py-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr class="border-t border-slate-100">
                    <td class="px-4 py-3 font-medium">{{ $product->name }}</td>
                    <td class="px-4 py-3">{{ $product->type->name ?? '—' }}</td>
                    <td class="px-4 py-3">{{ number_format($product->price, 0, ',', ' ') }} DA</td>
                    <td class="px-4 py-3">{{ $product->stock }}</td>
                    <td class="px-4 py-3 text-right space-x-3">
                        <a href="{{ route('admin.produits.edit', $product) }}" class="text-indigo-600 font-semibold">Modifier</a>
                        <form method="POST" action="{{ route('admin.produits.destroy', $product) }}" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-red-500">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-slate-500">Aucun produit pour le moment.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">
    {{ $products->links() }}
</div>
@endsection
