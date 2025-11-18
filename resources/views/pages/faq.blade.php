@extends('layouts.app')

@section('title', 'Foire aux questions')

@section('content')
<h1 class="text-3xl font-semibold mb-8">Foire aux questions</h1>
<div class="space-y-6">
    <article class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-lg font-semibold mb-2">Quels sont les délais de livraison ?</h2>
        <p class="text-slate-600">Les commandes sont traitées sous 24h et livrées sous 2 à 5 jours ouvrés selon la wilaya sélectionnée.</p>
    </article>
    <article class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-lg font-semibold mb-2">Puis-je payer en ligne ?</h2>
        <p class="text-slate-600">Le règlement s’effectue exclusivement à la livraison (Cash on Delivery).</p>
    </article>
    <article class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-lg font-semibold mb-2">Comment suivre ma commande ?</h2>
        <p class="text-slate-600">Connectez-vous à votre espace client pour consulter l’historique et le statut détaillé.</p>
    </article>
</div>
@endsection
