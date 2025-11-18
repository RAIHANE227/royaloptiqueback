@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<div class="max-w-lg mx-auto bg-white rounded-xl shadow-sm p-8">
    <h1 class="text-2xl font-semibold mb-6 text-center">Connexion à votre compte</h1>
    <form method="POST" action="{{ route('login.submit') }}" class="space-y-5">
        @csrf
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1">Adresse e-mail</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                class="w-full rounded-lg border border-slate-200 px-4 py-2.5 focus:border-indigo-500 focus:ring-indigo-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1">Mot de passe</label>
            <input type="password" name="password" required
                class="w-full rounded-lg border border-slate-200 px-4 py-2.5 focus:border-indigo-500 focus:ring-indigo-500">
        </div>
        <div class="flex items-center justify-between text-sm">
            <label class="inline-flex items-center gap-2">
                <input type="checkbox" name="remember" class="rounded border-slate-300 text-indigo-600">
                <span>Se souvenir de moi</span>
            </label>
            <a href="{{ route('password.request') }}" class="text-indigo-600 hover:text-indigo-700">Mot de passe oublié ?</a>
        </div>
        <button class="w-full bg-indigo-600 text-white rounded-lg py-2.5 font-semibold hover:bg-indigo-700">
            Se connecter
        </button>
        <p class="text-center text-sm text-slate-500">
            Pas encore de compte ?
            <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-700 font-semibold">Créer un compte</a>
        </p>
    </form>
</div>
@endsection
