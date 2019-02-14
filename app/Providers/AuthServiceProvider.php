<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        //Llamando a la definición de otras políticas
        //para recursos específicos
        //-----------------------------------------------------------
        //  >> referido a sección ADMIN
        $this->registerAdminPolicies();
    }

    /**
     * Políticas de acceso para la sección de ADMIN
     *
     * @return void
     */
    public function registerAdminPolicies()
    {
        //Definiendo una regla de nombre 'isAdmin' que verifica
        //si el $user actualmente autenticado tiene un perfil
        //de tipo administrador, devolviendo true/false
        Gate::define('isAdmin', function ($user) {
            return $user->perfil_id == 1;
        });
    }
}
