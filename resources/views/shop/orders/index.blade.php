@extends('layouts.app')

@section('title', 'Mes commandes')

@section('content')
<h1 class="text-2xl font-semibold mb-6">Mes commandes</h1>
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
            <tr>
                <th class="text-left px-4 py-3">Commande</th>
                <th class="text-left px-4 py-3">Date</th>
                <th class="text-left px-4 py-3">Adresse</th>
                <th class="text-left px-4 py-3">Statut</th>
                <th class="text-left px-4 py-3">Total</th>
                <th class="text-right px-4 py-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr class="border-t border-slate-100">
                    <td class="px-4 py-3 font-semibold">#{{ $order->id }}</td>
                    <td class="px-4 py-3">{{ $order->created_at->format('d/m/Y') }}</td>
                    <td class="px-4 py-3">{{ $order->customer_address }}</td>
                    <td class="px-4 py-3">
                        <span class="px-3 py-1 rounded-full text-xs bg-slate-100">{{ ucfirst($order->status) }}</span>
                    </td>
                    <td class="px-4 py-3 font-semibold">{{ number_format($order->total_price, 2, ',', ' ') }} DA</td>
                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('orders.show', $order) }}" class="text-indigo-600 font-semibold">Détails</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-slate-500">Aucune commande pour le moment.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">
    {{ $orders->links() }}
</div>
@endsection
