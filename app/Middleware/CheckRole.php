<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next)
    {
        // Permite acceso si el usuario es administrador
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Restringe acceso a cualquier ruta diferente a videojuegos
        if ($request->is('videojuegos/*') || $request->is('videojuegos')) {
            return $next($request);
        }

        return redirect()->route('home')->with('error', 'Acceso restringido.');
    }
}

