<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::query();
        
        if ($search = $request->get('q')) {
            $search = trim($search);
            if (!empty($search)) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            }
        }

        if ($role = $request->get('role')) {
            $query->where('role', $role);
        }

        $users = $query->latest()->paginate(20)->withQueryString();
        
        return view('admin.users.index', [
            'users' => $users,
            'roles' => Role::allRoles(),
        ]);
    }

    public function create(): View
    {
        return view('admin.users.create', [
            'roles' => Role::allRoles(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:30'],
            'role' => ['required', 'in:' . implode(',', Role::allRoles())],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'wilaya' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $data['password'] = Hash::make($data['password']);
        
        User::create($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur ajouté avec succès.');
    }

    public function show(User $user): View
    {
        $user->load('orders');

        return view('admin.users.show', [
            'user' => $user,
        ]);
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => Role::allRoles(),
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:30'],
            'role' => ['required', 'in:' . implode(',', Role::allRoles())],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'wilaya' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur mis à jour.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        // Check if user has associated orders
        if ($user->orders()->exists()) {
            return back()->with('error', 'Cet utilisateur ne peut pas être supprimé car il a des commandes associées.');
        }

        $user->delete();

        return back()->with('success', 'Utilisateur supprimé.');
    }

    public function toggleStatus(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas désactiver votre propre compte.');
        }

        // Toggle user status by changing email to prevent login
        if (str_contains($user->email, '_disabled_')) {
            // Reactivate
            $user->update([
                'email' => str_replace('_disabled_', '', $user->email)
            ]);
            $message = 'Utilisateur réactivé.';
        } else {
            // Deactivate
            $user->update([
                'email' => str_replace('@', '_disabled_@', $user->email)
            ]);
            $message = 'Utilisateur désactivé.';
        }

        return back()->with('success', $message);
    }
}
