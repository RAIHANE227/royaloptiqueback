@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<h1 class="text-3xl font-semibold mb-8">Nous contacter</h1>
<div class="grid gap-8 lg:grid-cols-2">
    <div class="space-y-4">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold mb-2">Coordonnées</h2>
            <p class="text-slate-600">Téléphone : +213 770 00 00 00</p>
            <p class="text-slate-600">Email : contact@optiqueroyale.dz</p>
            <p class="text-slate-600">Adresse : Centre-ville, Alger</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold mb-2">Horaires</h2>
            <p class="text-slate-600">Dimanche - Jeudi : 9h00 - 18h00</p>
            <p class="text-slate-600">Vendredi : 9h00 - 13h00</p>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-lg font-semibold mb-4">Formulaire</h2>
        <form class="space-y-4">
            <input type="text" placeholder="Nom" class="w-full rounded border border-slate-200 px-3 py-2">
            <input type="email" placeholder="Email" class="w-full rounded border border-slate-200 px-3 py-2">
            <textarea rows="5" placeholder="Votre message" class="w-full rounded border border-slate-200 px-3 py-2"></textarea>
            <button class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg font-semibold">Envoyer</button>
        </form>
    </div>
</div>
@endsection
