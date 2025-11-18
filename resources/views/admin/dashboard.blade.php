@extends('layouts.admin')

@section('title', 'Tableau de bord')
@section('header', 'Tableau de bord')

@section('content')
<div class="grid gap-6 md:grid-cols-2 xl:grid-cols-5 mb-8">
    <div class="bg-white rounded-xl shadow-sm p-5">
        <p class="text-sm text-slate-500">Commandes totales</p>
        <p class="text-3xl font-semibold">{{ $stats['orders_count'] }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-5">
        <p class="text-sm text-slate-500">Commandes du jour</p>
        <p class="text-3xl font-semibold">{{ $stats['orders_today'] }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-5">
        <p class="text-sm text-slate-500">Chiffre d'affaires total</p>
        <p class="text-3xl font-semibold">{{ number_format($stats['revenue_total'], 0, ',', ' ') }} DA</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-5">
        <p class="text-sm text-slate-500">Chiffre d'affaires du jour</p>
        <p class="text-3xl font-semibold">{{ number_format($stats['revenue_today'], 0, ',', ' ') }} DA</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-5">
        <p class="text-sm text-slate-500">Utilisateurs actifs</p>
        <p class="text-3xl font-semibold">{{ $stats['active_users'] }}</p>
    </div>
</div>

<div class="grid gap-6 lg:grid-cols-2">
    <section class="bg-white rounded-xl shadow-sm">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-lg font-semibold">Top produits</h2>
            <span class="text-xs uppercase text-slate-400">Nom & ventes</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-left text-xs uppercase text-slate-500">
                    <tr>
                        <th class="px-6 py-3 font-semibold">Nom du produit</th>
                        <th class="px-6 py-3 font-semibold text-right">Ventes</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($stats['top_products'] as $product)
                        <tr>
                            <td class="px-6 py-3 font-medium text-slate-900">{{ $product->name }}</td>
                            <td class="px-6 py-3 text-right font-semibold text-slate-700">{{ $product->order_items_count }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-6 text-center text-slate-500">Pas encore de ventes.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <section class="bg-white rounded-xl shadow-sm">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-lg font-semibold">Commandes récentes</h2>
            <span class="text-xs uppercase text-slate-400">Dernières 24h</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-left text-xs uppercase text-slate-500">
                    <tr>
                        <th class="px-6 py-3 font-semibold">#ID</th>
                        <th class="px-6 py-3 font-semibold">Client</th>
                        <th class="px-6 py-3 font-semibold text-right">Montant</th>
                        <th class="px-6 py-3 font-semibold text-right">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($recentOrders as $order)
                        <tr>
                            <td class="px-6 py-3 font-semibold text-slate-900">#{{ $order->id }}</td>
                            <td class="px-6 py-3 text-slate-700">{{ $order->user->name ?? $order->customer_name }}</td>
                            <td class="px-6 py-3 text-right font-semibold">{{ number_format($order->total_price, 0, ',', ' ') }} DA</td>
                            <td class="px-6 py-3 text-right text-slate-500">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-6 text-center text-slate-500">Aucune commande récente.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
