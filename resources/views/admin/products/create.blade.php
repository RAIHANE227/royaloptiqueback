@extends('layouts.admin')

@section('title', 'Ajouter un produit')
@section('header', 'Ajouter un produit')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-xl shadow-sm p-6">
    <h1 class="text-2xl font-semibold mb-6">Ajouter un produit</h1>
    <form method="POST" action="{{ route('admin.produits.store') }}" enctype="multipart/form-data" class="space-y-5">
        @csrf
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-slate-600">Nom</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
            </div>
            <div>
                <label class="text-sm text-slate-600">Prix</label>
                <input type="number" name="price" value="{{ old('price') }}" required class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
            </div>
        </div>
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-slate-600">Type</label>
                <select name="product_type_id" class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-sm text-slate-600">Catégorie</label>
                <select name="category_id" class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
                    <option value="">Aucune</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-slate-600">Stock</label>
                <input type="number" name="stock" value="{{ old('stock', 0) }}" class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
            </div>
            <div>
                <label class="text-sm text-slate-600">Marque</label>
                <input type="text" name="brand" value="{{ old('brand') }}" class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
            </div>
        </div>
        <div>
            <label class="text-sm text-slate-600">Couleur</label>
            <input type="text" name="color" value="{{ old('color') }}" class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
        </div>
        <div>
            <label class="text-sm text-slate-600">Description</label>
            <textarea name="description" rows="4" class="mt-1 w-full rounded border border-slate-200 px-3 py-2">{{ old('description') }}</textarea>
        </div>
        <div>
            <label class="text-sm text-slate-600">Image principale</label>
            <input type="file" name="primary_image" class="mt-1 w-full text-sm">
        </div>
        <div>
            <label class="text-sm text-slate-600">Galerie</label>
            <input type="file" name="gallery[]" multiple class="mt-1 w-full text-sm">
        </div>
        <button class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg font-semibold">Enregistrer</button>
    </form>
</div>
@endsection
