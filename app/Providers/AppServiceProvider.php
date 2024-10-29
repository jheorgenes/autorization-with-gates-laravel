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

        // O usuário pode fazer inserts?
        Gate::define('user_can_insert', function (User $user){
            /* Validando se existe a propriedade insert dentro do array */
            /* Necessita converter o json que é retornado de $user->permissions */
            return in_array('insert', json_decode($user->permissions));
        });

        // O usuário pode fazer deletes?
        Gate::define('user_can_delete', function (User $user){
            /* Validando se existe a propriedade delete dentro do array */
            /* Necessita converter o json que é retornado de $user->permissions */
            return in_array('delete', json_decode($user->permissions));
        });

        // Recebe a definição da permissão como parametro e procura ela nas permissões do usuário
        Gate::define('user_can', function(User $user, string $permission){
            return in_array($permission, json_decode($user->permissions));
        });
    }
}
