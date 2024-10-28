<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // gates [definindo Autorizações]
        Gate::define('user_is_admin', function(User $user){
            return $user->role === 'admin';
        });

        Gate::define('user_is_user', function(User $user){
            return $user->role === 'user';
        });
    }
}
