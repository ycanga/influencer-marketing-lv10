<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class ApiTokenControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$this->hasBearerToken($request)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $next($request);
    }

    /**
     * Determine if the request has a bearer token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    private function hasBearerToken(Request $request): bool
    {
        $bearerToken = $request->bearerToken;
        if (!$bearerToken) {
            return false;
        }

        $user = User::where('bearer_token', $bearerToken)->pluck('bearer_token')->first();
        if (!$user) {
            return false;
        }
        return true;
    }
}
