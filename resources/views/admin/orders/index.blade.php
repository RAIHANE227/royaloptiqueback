@extends('layouts.admin')

@section('title', 'Commandes')
@section('header', 'Gestion des commandes')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Commandes</h1>
</div>
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
            <tr>
                <th class="text-left px-4 py-3">Commande</th>
                <th class="text-left px-4 py-3">Client</th>
                <th class="text-left px-4 py-3">Statut</th>
                <th class="text-left px-4 py-3">Total</th>
                <th class="text-right px-4 py-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr class="border-t border-slate-100">
                    <td class="px-4 py-3 font-semibold">#{{ $order->id }}</td>
                    <td class="px-4 py-3">{{ $order->customer_name }}</td>
                    <td class="px-4 py-3">{{ ucfirst($order->status) }}</td>
                    <td class="px-4 py-3">{{ number_format($order->total_price, 0, ',', ' ') }} DA</td>
                    <td class="px-4 py-3 text-right space-x-3">
                        <a href="{{ route('admin.commandes.show', $order) }}" class="text-indigo-600 font-semibold">Voir</a>
                        <form method="POST" action="{{ route('admin.commandes.destroy', $order) }}" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-red-500">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-slate-500">Aucune commande.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">
    {{ $orders->links() }}
</div>
@endsection
