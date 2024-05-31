<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MerchantControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is logged in and is an admin
        if (!$this->isMerchant($request)) {
            return redirect()->route('home')->with('error', 'You are not authorized to access this page.');
        }

        return $next($request);
    }

    /**
     * Check if the user is an admin.
     */
    private function isMerchant(Request $request): bool
    {
        $user = auth()->user();

        // Check if the user is logged in and has the role of 'merchant'
        return $user && $user->role === 'merchant' || $user->role === 'admin';
    }
}
