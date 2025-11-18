@extends('layouts.admin')

@section('title', 'Utilisateurs v2')
@section('header', 'Gestion des utilisateurs')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Utilisateurs</h1>
    <a href="{{ route('admin.users.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-semibold">Ajouter</a>
</div>

<!-- Search and Filter -->
<div class="bg-white rounded-xl shadow-sm p-4 mb-6">
    <form method="GET" class="flex flex-wrap gap-4">
        <input type="text" name="q" placeholder="Rechercher par nom ou email" 
               value="{{ request('q') }}" class="flex-1 min-w-[200px] rounded border border-slate-200 px-3 py-2">
        <select name="role" class="rounded border border-slate-200 px-3 py-2">
            <option value="">Tous les rôles</option>
            @foreach (App\Models\Role::allRoles() as $role)
                <option value="{{ $role }}" @selected(request('role') == $role)>{{ ucfirst($role) }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-slate-600 text-white px-4 py-2 rounded">Filtrer</button>
        <a href="{{ route('admin.users.index') }}" class="text-slate-600 hover:text-slate-800">Réinitialiser</a>
    </form>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
            <tr>
                <th class="text-left px-4 py-3">Nom</th>
                <th class="text-left px-4 py-3">Email</th>
                <th class="text-left px-4 py-3">Téléphone</th>
                <th class="text-left px-4 py-3">Rôle</th>
                <th class="text-left px-4 py-3">Statut</th>
                <th class="text-right px-4 py-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr class="border-t border-slate-100">
                    <td class="px-4 py-3 font-medium">{{ $user->name }}</td>
                    <td class="px-4 py-3">
                        {{ $user->email }}
                        @if (str_contains($user->email, '_disabled_'))
                            <span class="text-xs text-red-500 ml-2">(Désactivé)</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">{{ $user->phone ?? '—' }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 text-xs rounded-full {{ $user->role === 'admin' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        @if (str_contains($user->email, '_disabled_'))
                            <span class="text-red-500 font-medium">Inactif</span>
                        @else
                            <span class="text-green-500 font-medium">Actif</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-right space-x-3">
                        <a href="{{ route('admin.users.show', $user) }}" class="text-indigo-600 font-semibold">Voir</a>
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-indigo-600 font-semibold">Modifier</a>
                        @if ($user->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline">
                                @csrf @method('DELETE')
                                <button class="text-red-500" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</button>
                            </form>
                            <form method="POST" action="{{ route('admin.users.toggle', $user) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-orange-500">
                                        {{ str_contains($user->email, '_disabled_') ? 'Réactiver' : 'Désactiver' }}
                                    </button>
                                </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-slate-500">Aucun utilisateur pour le moment.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $users->links() }}
</div>
@endsection
