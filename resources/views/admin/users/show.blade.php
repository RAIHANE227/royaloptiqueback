@extends('layouts.admin')

@section('title', 'Utilisateur ' . $user->name)
@section('header', 'Détails utilisateur')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-semibold">{{ $user->name }}</h1>
        <p class="text-sm text-slate-500">{{ $user->email }}</p>
    </div>
    <div class="flex gap-3">
        <a href="{{ route('admin.users.edit', $user) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-semibold">Modifier</a>
        @if ($user->id !== auth()->id())
            <form method="POST" action="{{ route('admin.users.toggle', $user) }}" class="inline">
                @csrf
                <button class="bg-orange-500 text-white px-4 py-2 rounded-lg font-semibold">
                    {{ str_contains($user->email, '_disabled_') ? 'Réactiver' : 'Désactiver' }}
                </button>
            </form>
        @endif
    </div>
</div>

<div class="grid gap-6 lg:grid-cols-3">
    <section class="bg-white rounded-xl shadow-sm p-6 lg:col-span-2 space-y-4">
        <h2 class="text-lg font-semibold">Informations personnelles</h2>
        
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-slate-500">Nom</p>
                <p class="font-medium">{{ $user->name }}</p>
            </div>
            <div>
                <p class="text-sm text-slate-500">Email</p>
                <p class="font-medium">{{ $user->email }}</p>
            </div>
            <div>
                <p class="text-sm text-slate-500">Téléphone</p>
                <p class="font-medium">{{ $user->phone ?? 'Non renseigné' }}</p>
            </div>
            <div>
                <p class="text-sm text-slate-500">Rôle</p>
                <span class="px-2 py-1 text-xs rounded-full {{ $user->role === 'admin' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700' }}">
                    {{ ucfirst($user->role) }}
                </span>
            </div>
            <div>
                <p class="text-sm text-slate-500">Statut</p>
                @if (str_contains($user->email, '_disabled_'))
                    <span class="text-red-500 font-medium">Inactif</span>
                @else
                    <span class="text-green-500 font-medium">Actif</span>
                @endif
            </div>
            <div>
                <p class="text-sm text-slate-500">Date d'inscription</p>
                <p class="font-medium">{{ $user->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <div class="border-t border-slate-100 pt-4">
            <h3 class="text-lg font-semibold mb-3">Adresse</h3>
            <div class="space-y-2">
                @if ($user->address)
                    <p class="text-sm"><span class="text-slate-500">Adresse :</span> {{ $user->address }}</p>
                @endif
                @if ($user->city)
                    <p class="text-sm"><span class="text-slate-500">Ville :</span> {{ $user->city }}</p>
                @endif
                @if ($user->wilaya)
                    <p class="text-sm"><span class="text-slate-500">Wilaya :</span> {{ $user->wilaya }}</p>
                @endif
                @if ($user->postal_code)
                    <p class="text-sm"><span class="text-slate-500">Code postal :</span> {{ $user->postal_code }}</p>
                @endif
                @if (!$user->address && !$user->city && !$user->wilaya && !$user->postal_code)
                    <p class="text-sm text-slate-500">Aucune adresse renseignée</p>
                @endif
            </div>
        </div>
    </section>

    <aside class="bg-white rounded-xl shadow-sm p-6 space-y-4">
        <h2 class="text-lg font-semibold">Statistiques</h2>
        
        <div class="space-y-3">
            <div class="flex justify-between">
                <span class="text-sm text-slate-500">Nombre de commandes</span>
                <span class="font-semibold">{{ $user->orders->count() }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-slate-500">Total dépensé</span>
                <span class="font-semibold">
                    {{ number_format($user->orders->whereIn('status', ['processing', 'shipped', 'completed'])->sum('total_price'), 0, ',', ' ') }} DA
                </span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-slate-500">Dernière commande</span>
                <span class="font-semibold">
                    {{ $user->orders->sortByDesc('created_at')->first()?->created_at->format('d/m/Y') ?? 'Aucune' }}
                </span>
            </div>
        </div>

        @if ($user->orders->isNotEmpty())
            <div class="border-t border-slate-100 pt-4">
                <h3 class="text-lg font-semibold mb-3">Commandes récentes</h3>
                <div class="space-y-2">
                    @foreach ($user->orders->sortByDesc('created_at')->take(5) as $order)
                        <div class="flex justify-between text-sm">
                            <span>#{{ $order->id }}</span>
                            <span>{{ number_format($order->total_price, 0, ',', ' ') }} DA</span>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('admin.commandes.index') }}?user_id={{ $user->id }}" class="text-indigo-600 text-sm font-semibold mt-3 inline-block">Voir toutes les commandes</a>
            </div>
        @endif
    </aside>
</div>
@endsection
