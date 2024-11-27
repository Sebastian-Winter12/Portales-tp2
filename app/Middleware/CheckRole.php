<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        if ($request->is('videojuegos/*') || $request->is('videojuegos')) {
            return $next($request);
        }

        return redirect()->route('home')->with('error', 'Acceso restringido.');
    }
}

