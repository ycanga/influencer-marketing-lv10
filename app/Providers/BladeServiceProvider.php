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

        Blade::if('user', function ($perm=null) {
            $user = auth()->user();

            if($perm) {
                return $user && $user->role === 'user' || $user->role === 'admin' || $user->role === 'merchant';
            }else{
                return $user && $user->role === 'user' || $user->role === 'merchant';
            }
        });

        Blade::if('merchant', function ($perm=null) {
            $user = auth()->user();

            if($perm) {
                return $user && $user->role === 'merchant' || $user->role === 'admin';
            }else{
                return $user && $user->role === 'merchant';
            }
        });

        Blade::if('influencer', function ($perm=null) {
            $user = auth()->user();

            if($perm) {
                return $user && $user->role === 'user' || $user->role === 'admin';
            }else{
                return $user && $user->role === 'user';
            }
        });
    }
}
