@extends('layouts.app')

@section('title', 'Mon profil')

@section('content')
<div class="grid gap-8 lg:grid-cols-3">
    <section class="bg-white rounded-xl shadow-sm p-6 lg:col-span-2">
        <h2 class="text-xl font-semibold mb-4">Mes informations</h2>
        <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
            @csrf
            @method('PUT')
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-medium text-slate-600">Nom complet</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
                </div>
                <div>
                    <label class="text-sm font-medium text-slate-600">Téléphone</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                        class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
                </div>
            </div>
            <div>
                <label class="text-sm font-medium text-slate-600">Adresse</label>
                <input type="text" name="address" value="{{ old('address', $user->address) }}"
                    class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
            </div>
            <div class="grid md:grid-cols-3 gap-4">
                <div>
                    <label class="text-sm font-medium text-slate-600">Ville</label>
                    <input type="text" name="city" value="{{ old('city', $user->city) }}"
                        class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
                </div>
                <div>
                    <label class="text-sm font-medium text-slate-600">Wilaya</label>
                    <input type="text" name="wilaya" value="{{ old('wilaya', $user->wilaya) }}"
                        class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
                </div>
                <div>
                    <label class="text-sm font-medium text-slate-600">Code postal</label>
                    <input type="text" name="postal_code" value="{{ old('postal_code', $user->postal_code) }}"
                        class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
                </div>
            </div>
            <button class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg font-semibold">Mettre à jour</button>
        </form>
    </section>

    <section class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-xl font-semibold mb-4">Mot de passe</h2>
        <form method="POST" action="{{ route('profile.password') }}" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="text-sm text-slate-600">Mot de passe actuel</label>
                <input type="password" name="current_password" required class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
            </div>
            <div>
                <label class="text-sm text-slate-600">Nouveau mot de passe</label>
                <input type="password" name="password" required class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
            </div>
            <div>
                <label class="text-sm text-slate-600">Confirmation</label>
                <input type="password" name="password_confirmation" required class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
            </div>
            <button class="w-full bg-slate-800 text-white py-2 rounded-lg font-semibold">Modifier</button>
        </form>
    </section>
</div>

<section class="mt-10">
    <h2 class="text-xl font-semibold mb-4">Historique des commandes</h2>
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
                <tr>
                    <th class="text-left px-4 py-3">Commande</th>
                    <th class="text-left px-4 py-3">Date</th>
                    <th class="text-left px-4 py-3">Statut</th>
                    <th class="text-left px-4 py-3">Total</th>
                    <th class="text-right px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr class="border-t border-slate-100">
                        <td class="px-4 py-3 font-medium">#{{ $order->id }}</td>
                        <td class="px-4 py-3">{{ $order->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-3">
                            <span class="px-3 py-1 rounded-full text-xs bg-slate-100">{{ ucfirst($order->status) }}</span>
                        </td>
                        <td class="px-4 py-3 font-semibold">{{ number_format($order->total_price, 2, ',', ' ') }} DA</td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('orders.show', $order) }}" class="text-indigo-600 font-semibold">Voir</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-slate-500">Aucune commande pour le moment.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
