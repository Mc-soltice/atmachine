<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ThrottleRequests
{
    protected $limit = 3; // Limite d'exemple
    protected $decayMinutes = 30; // En minutes

    public function handle(Request $request, Closure $next)
    {
        $userId = $request->user() ? $request->user()->id : 'guest';

        // Clés de cache
        $blockedKey = "blocked_{$userId}";
        $requestCountKey = "request_count_{$userId}";

        // Vérifier si l'utilisateur est bloqué
        if (cache()->has($blockedKey)) {
            return $this->tooManyRequestsResponse();
        }

        // Récupérer le nombre de tentatives de login
        $requestCount = cache()->get($requestCountKey, 0);
        $requestCount = cache()->increment($requestCountKey);

        $requestCount = cache()->increment($requestCountKey);

        // Bloquer l'utilisateur si la limite est atteinte
        if ($requestCount > $this->limit) {
            cache()->put($blockedKey, true, now()->addMinutes($this->decayMinutes));
            return $this->tooManyRequestsResponse();
        }

        return $next($request);
    }

    protected function tooManyRequestsResponse()
    {
        return response()->json(['message' => 'Trop de requêtes, veuillez réessayer plus tard. (30 min)'], Response::HTTP_TOO_MANY_REQUESTS);
    }
}
