@extends('layouts.app')

@section('title', 'Politique de confidentialité')

@section('content')
<h1 class="text-3xl font-semibold mb-8">Politique de confidentialité</h1>
<div class="space-y-6 bg-white rounded-xl shadow-sm p-6">
    <section>
        <h2 class="text-lg font-semibold mb-2">Collecte de données</h2>
        <p class="text-slate-600">Nous recueillons les informations nécessaires au traitement des commandes (nom, email, adresse, téléphone).</p>
    </section>
    <section>
        <h2 class="text-lg font-semibold mb-2">Utilisation</h2>
        <p class="text-slate-600">Les données sont utilisées uniquement pour le suivi des commandes et la communication client.</p>
    </section>
    <section>
        <h2 class="text-lg font-semibold mb-2">Conservation</h2>
        <p class="text-slate-600">Les données sont conservées sur des serveurs sécurisés et peuvent être supprimées sur simple demande.</p>
    </section>
</div>
@endsection
