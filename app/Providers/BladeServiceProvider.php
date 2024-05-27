<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Models\User;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::if('admin', function () {
            $user = auth()->user();
            return $user && $user->role === 'admin';
        });

        Blade::if('user', function () {
            $user = auth()->user();
            return $user && $user->role === 'user' || $user->role === 'merchant';
        });
    }
}
