<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Add this line

class AuthenticateMiembro
{
    public function handle(Request $request, Closure $next)
    {
        Log::info("AuthenticateMiembro: Checking if miembro is authenticated."); // Add this line

        if (!Auth::guard('miembro')->check()) {
            Log::info("AuthenticateMiembro: Miembro not authenticated, redirecting to login."); // Add this line
            return redirect()->route('login');
        }

        return $next($request);
    }
}