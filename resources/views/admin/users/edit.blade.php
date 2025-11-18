@extends('layouts.admin')

@section('title', 'Modifier un utilisateur')
@section('header', 'Modifier un utilisateur')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-xl shadow-sm p-6">
    <h1 class="text-2xl font-semibold mb-6">Modifier {{ $user->name }}</h1>
    
    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-5">
        @csrf @method('PUT')
        
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-slate-600">Nom</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required 
                       class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="text-sm text-slate-600">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required 
                       class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-slate-600">Téléphone</label>
                <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" 
                       class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
                @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="text-sm text-slate-600">Rôle</label>
                <select name="role" required class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
                    @foreach ($roles as $role)
                        <option value="{{ $role }}" @selected($user->role == $role)>{{ ucfirst($role) }}</option>
                    @endforeach
                </select>
                @error('role') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-4">
            <div>
                <label class="text-sm text-slate-600">Adresse</label>
                <input type="text" name="address" value="{{ old('address', $user->address) }}" 
                       class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
                @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="text-sm text-slate-600">Ville</label>
                <input type="text" name="city" value="{{ old('city', $user->city) }}" 
                       class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
                @error('city') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="text-sm text-slate-600">Wilaya</label>
                <input type="text" name="wilaya" value="{{ old('wilaya', $user->wilaya) }}" 
                       class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
                @error('wilaya') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label class="text-sm text-slate-600">Code postal</label>
            <input type="text" name="postal_code" value="{{ old('postal_code', $user->postal_code) }}" 
                   class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
            @error('postal_code') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-slate-600">Nouveau mot de passe (laisser vide pour ne pas changer)</label>
                <input type="password" name="password" 
                       class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
                @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="text-sm text-slate-600">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" 
                       class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
                @error('password_confirmation') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="flex gap-3">
            <button class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg font-semibold">Mettre à jour</button>
            <a href="{{ route('admin.users.index') }}" class="text-slate-600 hover:text-slate-800 px-4 py-2">Annuler</a>
        </div>
    </form>
</div>
@endsection
