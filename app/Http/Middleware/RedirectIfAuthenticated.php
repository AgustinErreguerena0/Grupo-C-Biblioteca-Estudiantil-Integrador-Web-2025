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
    public function handle($request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // determinar ruta según guard
                if ($guard === 'miembro') {
                    return redirect()->route('miembro.catalogo');
                }
                return redirect()->route('bibliotecario.inicio');
            }
        }

        return $next($request);
    }
}
