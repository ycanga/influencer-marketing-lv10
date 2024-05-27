<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserRoleControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is logged in and is an admin
        if (!$this->isAdmin($request)) {
            return redirect()->route('home')->with('error', 'You are not authorized to access this page.');
        }

        return $next($request);
    }

    /**
     * Check if the user is an admin.
     */
    private function isAdmin(Request $request): bool
    {
        $user = auth()->user();
        
        // Check if the user is logged in and has the role of 'admin'
        return $user && $user->role === 'admin';
    }
}
