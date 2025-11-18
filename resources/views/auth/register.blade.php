@extends('layouts.app')

@section('title', 'Inscription')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-xl shadow-sm p-8">
    <h1 class="text-2xl font-semibold mb-6 text-center">Créer un compte</h1>
    <form method="POST" action="{{ route('register.submit') }}" class="grid gap-5 md:grid-cols-2">
        @csrf
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-slate-600 mb-1">Nom complet</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                class="w-full rounded-lg border border-slate-200 px-4 py-2.5 focus:border-indigo-500 focus:ring-indigo-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1">Adresse e-mail</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                class="w-full rounded-lg border border-slate-200 px-4 py-2.5 focus:border-indigo-500 focus:ring-indigo-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1">Téléphone</label>
            <input type="text" name="phone" value="{{ old('phone') }}"
                class="w-full rounded-lg border border-slate-200 px-4 py-2.5 focus:border-indigo-500 focus:ring-indigo-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1">Mot de passe</label>
            <input type="password" name="password" required
                class="w-full rounded-lg border border-slate-200 px-4 py-2.5 focus:border-indigo-500 focus:ring-indigo-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1">Confirmation du mot de passe</label>
            <input type="password" name="password_confirmation" required
                class="w-full rounded-lg border border-slate-200 px-4 py-2.5 focus:border-indigo-500 focus:ring-indigo-500">
        </div>
        <div class="md:col-span-2">
            <button class="w-full bg-indigo-600 text-white rounded-lg py-2.5 font-semibold hover:bg-indigo-700">
                Créer mon compte
            </button>
        </div>
        <p class="md:col-span-2 text-center text-sm text-slate-500">
            Déjà inscrit ?
            <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-700 font-semibold">Se connecter</a>
        </p>
    </form>
</div>
@endsection
