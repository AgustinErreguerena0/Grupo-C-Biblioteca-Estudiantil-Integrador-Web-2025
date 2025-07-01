<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bibliotecario; 
use App\Models\Miembro; 

class BibliotecarioLoginController extends Controller
{

    public function showLoginForm()
    {
        return view('index'); 
    }

   
    public function login(Request $request)
    {
        $request->validate([
            'usuario' => 'required|string',
            'contrasena' => 'required|string',
        ]);

        // Definir las credenciales para el intento de autenticación
        $credentials = [
            'usuario' => $request->usuario,
            'password' => $request->contrasena,
        ];

         
        if (Auth::guard('bibliotecario')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('bibliotecario.inicio'));
        }

        
        if (Auth::guard('miembro')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('miembro.catalogo'));
        }
        
         // Si la autenticación falla para ambos, redirige explícitamente a la página de inicio de sesión
    return redirect()->route('login')->withErrors([
            'loginError' => 'Se ha ingresado incorrectamente el usuario o la contraseña.',
        ])->onlyInput('usuario');
    }

    public function logout(Request $request)
    {
        Auth::guard('bibliotecario')->logout();
        Auth::guard('miembro')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');  // Redirigir a la página principal de login
    }
}