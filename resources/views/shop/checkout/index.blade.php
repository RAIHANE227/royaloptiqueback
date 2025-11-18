@extends('layouts.app')

@section('title', 'Passer commande')

@section('content')
<h1 class="text-2xl font-semibold mb-6">Finaliser ma commande</h1>
<div class="grid gap-8 lg:grid-cols-3">
    <div class="lg:col-span-2 space-y-6">
        <section class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold mb-4">Informations client</h2>
            <form method="POST" action="{{ route('orders.store') }}" enctype="multipart/form-data" class="space-y-5">
                @csrf
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm text-slate-600">Nom complet</label>
                        <input type="text" name="customer_name" value="{{ old('customer_name', auth()->user()->name) }}" required class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm text-slate-600">Téléphone</label>
                        <input type="text" name="customer_phone" value="{{ old('customer_phone', auth()->user()->phone) }}" required class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
                    </div>
                </div>
                <div>
                    <label class="text-sm text-slate-600">Adresse complète</label>
                    <input type="text" name="customer_address" value="{{ old('customer_address', auth()->user()->address) }}" required class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
                </div>
                <div class="grid md:grid-cols-3 gap-4">
                    <div>
                        <label class="text-sm text-slate-600">Wilaya</label>
                        <input type="text" name="wilaya" value="{{ old('wilaya', auth()->user()->wilaya) }}" required class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm text-slate-600">Type de livraison</label>
                        <select name="delivery_type" class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
                            <option value="home" @selected(old('delivery_type') === 'home')>Livraison à domicile</option>
                            <option value="office" @selected(old('delivery_type') === 'office')>Point relais / bureau</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm text-slate-600">Ordonnance (si nécessaire)</label>
                        <input type="file" name="prescription_image" class="mt-1 w-full text-sm">
                    </div>
                </div>
                <button class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold">Confirmer ma commande</button>
            </form>
        </section>

        <section class="bg-white rounded-xl shadow-sm p-6 space-y-4">
            <h2 class="text-lg font-semibold mb-4">Articles</h2>
            @foreach ($items as $item)
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <div>
                        <p class="font-semibold">{{ $item['product']->name }}</p>
                        <p class="text-sm text-slate-500">Qté : {{ $item['quantity'] }}</p>
                    </div>
                    <span class="font-semibold">{{ number_format($item['subtotal'], 2, ',', ' ') }} DA</span>
                </div>
            @endforeach
        </section>
    </div>

    <aside class="bg-white rounded-xl shadow-sm p-6 space-y-4">
        <h2 class="text-lg font-semibold">Récapitulatif</h2>
        <div class="flex justify-between text-sm">
            <span>Sous-total</span>
            <span class="font-semibold">{{ number_format($subtotal, 2, ',', ' ') }} DA</span>
        </div>
        <p class="text-xs text-slate-500">Les frais de livraison seront calculés selon la wilaya choisie.</p>
        <button form="" class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold" onclick="document.querySelector('form').submit()">
            Confirmer et payer à la livraison
        </button>
    </aside>
</div>
@endsection
