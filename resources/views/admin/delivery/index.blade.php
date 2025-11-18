@extends('layouts.admin')

@section('title', 'Frais de livraison')
@section('header', 'Tarifs de livraison')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Frais de livraison</h1>
    <a href="{{ route('admin.livraison.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-semibold">Ajouter</a>
</div>
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
            <tr>
                <th class="text-left px-4 py-3">Wilaya</th>
                <th class="text-left px-4 py-3">Maison</th>
                <th class="text-left px-4 py-3">Bureau</th>
                <th class="text-right px-4 py-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($fees as $fee)
                <tr class="border-t border-slate-100">
                    <td class="px-4 py-3 font-medium">{{ $fee->wilaya }}</td>
                    <td class="px-4 py-3">{{ number_format($fee->fee_home, 0, ',', ' ') }} DA</td>
                    <td class="px-4 py-3">{{ number_format($fee->fee_office, 0, ',', ' ') }} DA</td>
                    <td class="px-4 py-3 text-right space-x-3">
                        <a href="{{ route('admin.livraison.edit', $fee) }}" class="text-indigo-600 font-semibold">Modifier</a>
                        <form method="POST" action="{{ route('admin.livraison.destroy', $fee) }}" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-red-500">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-8 text-center text-slate-500">Aucun tarif configuré.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">
    {{ $fees->links() }}
</div>
@endsection
