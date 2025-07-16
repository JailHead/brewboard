<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Verificar que tenga empleado asociado
        if (!$user->employee) {
            auth()->logout();
            return redirect()->route('login')->withErrors([
                'email' => 'Tu cuenta no tiene un perfil de empleado asociado.'
            ]);
        }

        // Verificar que sea administrador
        if ($user->employee->role->name !== 'Administrador') {
            auth()->logout();
            return redirect()->route('login')->withErrors([
                'email' => 'No tienes permisos para acceder al panel administrativo.'
            ]);
        }

        return $next($request);
    }
}