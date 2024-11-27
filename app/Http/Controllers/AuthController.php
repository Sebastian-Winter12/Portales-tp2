<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login-form');
    }

    public function loginProcess(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if(!auth()->attempt($credentials)){
            return redirect()
            ->back(fallback: route('login'))
            ->withInput()
            ->with('feedback.message', 'Las credenciales ingresadas no coinciden con nuestros registros');
        }

        return redirect()
            ->route('games.index')
            ->with('feedback.message', 'Inicio de sesión Exiroso ¡Bienvenido!');
    }

    public function logoutProcess(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('feedback.message', 'Cierre de sesion exitodo, vuelva pronto');
    }
}
