@extends('layouts.app')

@section('title', 'Mot de passe oublié')

@section('content')
<div class="max-w-lg mx-auto bg-white rounded-xl shadow-sm p-8">
    <h1 class="text-2xl font-semibold mb-4 text-center">Réinitialiser votre mot de passe</h1>
    <p class="text-sm text-slate-500 mb-6 text-center">Saisissez votre adresse e-mail pour recevoir un lien de réinitialisation.</p>
    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1">Adresse e-mail</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                class="w-full rounded-lg border border-slate-200 px-4 py-2.5 focus:border-indigo-500 focus:ring-indigo-500">
        </div>
        <button class="w-full bg-indigo-600 text-white rounded-lg py-2.5 font-semibold hover:bg-indigo-700">
            Envoyer le lien
        </button>
        <p class="text-center text-sm text-slate-500">
            <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-700 font-semibold">Retour à la connexion</a>
        </p>
    </form>
</div>
@endsection
