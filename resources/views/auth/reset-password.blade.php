@extends('layouts.app')

@section('title', 'Réinitialiser le mot de passe')

@section('content')
<div class="max-w-lg mx-auto bg-white rounded-xl shadow-sm p-8">
    <h1 class="text-2xl font-semibold mb-4 text-center">Nouveau mot de passe</h1>
    <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ request('email', $email) }}">
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1">Mot de passe</label>
            <input type="password" name="password" required autofocus
                class="w-full rounded-lg border border-slate-200 px-4 py-2.5 focus:border-indigo-500 focus:ring-indigo-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1">Confirmez le mot de passe</label>
            <input type="password" name="password_confirmation" required
                class="w-full rounded-lg border border-slate-200 px-4 py-2.5 focus:border-indigo-500 focus:ring-indigo-500">
        </div>
        <button class="w-full bg-indigo-600 text-white rounded-lg py-2.5 font-semibold hover:bg-indigo-700">
            Mettre à jour
        </button>
    </form>
</div>
@endsection
