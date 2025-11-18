@extends('layouts.app')

@section('title', 'Mentions légales')

@section('content')
<h1 class="text-3xl font-semibold mb-8">Mentions légales</h1>
<div class="space-y-6 bg-white rounded-xl shadow-sm p-6">
    <section>
        <h2 class="text-lg font-semibold mb-2">Éditeur</h2>
        <p class="text-slate-600">Optique Royale - RC 123456789, siège social : Centre-ville, Alger.</p>
    </section>
    <section>
        <h2 class="text-lg font-semibold mb-2">Directeur de publication</h2>
        <p class="text-slate-600">Mme Amina BELKACEM</p>
    </section>
    <section>
        <h2 class="text-lg font-semibold mb-2">Hébergement</h2>
        <p class="text-slate-600">Serveur sécurisé situé en Algérie, maintenance assurée par l’équipe Optique Royale.</p>
    </section>
</div>
@endsection
