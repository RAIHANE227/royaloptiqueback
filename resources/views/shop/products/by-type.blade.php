@extends('layouts.app')

@section('title', $typeName)

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">{{ $typeName }}</h1>
        <form method="GET" class="w-64">
            <input type="text" name="q" placeholder="Recherche..." value="{{ request('q') }}" 
                   class="w-full rounded-full border border-slate-200 px-4 py-2">
        </form>
    </div>

    @if ($products->isEmpty())
        <div class="bg-white rounded-xl shadow-sm p-8 text-center text-slate-500">
            Aucun produit de type "{{ $typeName }}" ne correspond à votre recherche.
        </div>
    @else
        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
            @foreach ($products as $product)
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x300' }}" alt="{{ $product->name }}" class="h-48 w-full object-cover">
                    <div class="p-4 space-y-2">
                        <p class="text-xs uppercase text-slate-400">{{ $product->type->name ?? 'Produit' }}</p>
                        <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
                        <p class="text-sm text-slate-500 line-clamp-2">{{ $product->description }}</p>
                        <div class="flex items-center justify-between pt-2">
                            <span class="text-xl font-bold text-indigo-600">{{ number_format($product->price, 2, ',', ' ') }} DA</span>
                            <a href="{{ route('products.show', $product) }}" class="text-sm font-semibold text-indigo-600">Voir</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection
