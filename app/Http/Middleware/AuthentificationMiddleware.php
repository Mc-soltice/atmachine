<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthentificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifie si l'utilisateur est authentifié
        if (!Auth::check()) {
            // Si l'utilisateur n'est pas connecté, on redirige vers la page de login
            return redirect()->route('sign')->withErrors(['auth' => 'Vous devez être connecté pour accéder à cette page.']);
        }

        return $next($request);
    }
}
