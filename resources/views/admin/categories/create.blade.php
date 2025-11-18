@extends('layouts.admin')

@section('title', 'Ajouter une catégorie')
@section('header', 'Ajouter une catégorie')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-xl shadow-sm p-6">
    <h1 class="text-2xl font-semibold mb-6">Ajouter une catégorie</h1>
    <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-5">
        @csrf
        <div>
            <label class="text-sm text-slate-600">Nom de la catégorie</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
        </div>
        <div>
            <label class="text-sm text-slate-600">Type de produit</label>
            <select name="product_type_id" class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
        <button class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg font-semibold">Enregistrer</button>
    </form>
</div>
@endsection
