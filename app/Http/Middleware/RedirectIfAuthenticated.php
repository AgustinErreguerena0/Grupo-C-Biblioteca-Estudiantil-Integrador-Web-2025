<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Add this line for logging

class RedirectIfAuthenticated
{
    /**
     * Redirige al usuario autenticado según su guard.
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            // Temporarily log the authentication status for debugging
            Log::info("Checking guard: {$guard}, Authenticated: " . Auth::guard($guard)->check());

            if (Auth::guard($guard)->check()) {
                if ($guard === 'miembro') {
                    return redirect()->route('miembro.catalogo');
                }
                // Por defecto para el guard 'bibliotecario'
                return redirect()->route('bibliotecario.inicio');
            }
        }

        return $next($request);
    }
}