@extends('layouts.admin')

@section('title', 'Modifier un produit')
@section('header', 'Modifier un produit')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-xl shadow-sm p-6">
    <h1 class="text-2xl font-semibold mb-6">Modifier {{ $product->name }}</h1>
    <form method="POST" action="{{ route('admin.produits.update', $product) }}" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-slate-600">Nom</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
            </div>
            <div>
                <label class="text-sm text-slate-600">Prix</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" required class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
            </div>
        </div>
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-slate-600">Type</label>
                <select name="product_type_id" class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" @selected($product->product_type_id == $type->id)>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-sm text-slate-600">Catégorie</label>
                <select name="category_id" class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
                    <option value="">Aucune</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected($product->category_id == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-slate-600">Stock</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
            </div>
            <div>
                <label class="text-sm text-slate-600">Marque</label>
                <input type="text" name="brand" value="{{ old('brand', $product->brand) }}" class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
            </div>
        </div>
        <div>
            <label class="text-sm text-slate-600">Couleur</label>
            <input type="text" name="color" value="{{ old('color', $product->color) }}" class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
        </div>
        <div>
            <label class="text-sm text-slate-600">Description</label>
            <textarea name="description" rows="4" class="mt-1 w-full rounded border border-slate-200 px-3 py-2">{{ old('description', $product->description) }}</textarea>
        </div>
        <div>
            <label class="text-sm text-slate-600">Image principale</label>
            <input type="file" name="primary_image" class="mt-1 w-full text-sm">
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="mt-2 h-24 rounded" alt="{{ $product->name }}">
            @endif
        </div>
        <div>
            <label class="text-sm text-slate-600">Galerie</label>
            <input type="file" name="gallery[]" multiple class="mt-1 w-full text-sm">
            <p class="text-xs text-slate-400 mt-1">Cocher pour vider la galerie existante :</p>
            <label class="inline-flex items-center gap-2 text-sm">
                <input type="checkbox" name="clear_gallery" value="1" class="rounded border-slate-300">
                <span>Supprimer les images existantes</span>
            </label>
        </div>
        <button class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg font-semibold">Mettre à jour</button>
    </form>
</div>
@endsection
