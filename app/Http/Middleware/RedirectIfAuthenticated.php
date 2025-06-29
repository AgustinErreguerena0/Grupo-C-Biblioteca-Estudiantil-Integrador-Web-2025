<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Redirige al usuario autenticado según su guard.
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                switch ($guard) {
                    case 'bibliotecario':
                        return redirect()->route('bibliotecario.inicio');
                    case 'miembro':
                        return redirect()->route('miembro.inicio');
                    default:
                        return redirect('/home'); // ruta genérica o de fallback
                }
            }
        }

        return $next($request);
    }
}
