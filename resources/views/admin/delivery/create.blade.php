@extends('layouts.admin')

@section('title', 'Ajouter un tarif de livraison')
@section('header', 'Ajouter un tarif de livraison')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-xl shadow-sm p-6">
    <h1 class="text-2xl font-semibold mb-6">Ajouter un tarif</h1>
    <form method="POST" action="{{ route('admin.livraison.store') }}" class="space-y-5">
        @csrf
        <div>
            <label class="text-sm text-slate-600">Wilaya</label>
            <input type="text" name="wilaya" value="{{ old('wilaya') }}" required class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
        </div>
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-slate-600">Frais domicile</label>
                <input type="number" name="fee_home" value="{{ old('fee_home') }}" required class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
            </div>
            <div>
                <label class="text-sm text-slate-600">Frais bureau</label>
                <input type="number" name="fee_office" value="{{ old('fee_office') }}" required class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
            </div>
        </div>
        <button class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg font-semibold">Enregistrer</button>
    </form>
</div>
@endsection
