<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (! $user || $user->role !== Role::ADMIN) {
            if ($request->expectsJson()) {
                abort(403, 'Accès réservé aux administrateurs.');
            }

            return redirect()->route('login')
                ->with('error', 'Vous devez être administrateur pour accéder à cette page.');
        }

        return $next($request);
    }
}
