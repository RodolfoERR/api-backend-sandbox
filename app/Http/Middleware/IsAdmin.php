<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Aquí se asume que el modelo User tiene un campo 'is_admin'
        // que es true para administradores.
        if (Auth::check() && Auth::user()->role_id==1) {
            return $next($request);
        }

        // Si no es admin, redirigir a la página de inicio o donde prefieras.
        return redirect('login');
    }
}
