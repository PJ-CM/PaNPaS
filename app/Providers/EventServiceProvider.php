<?php

namespace App\Providers;

use Illuminate\Auth\Events\Login;
use App\Listeners\SuccessfulLogin;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        //Evento de escucha sobre Login Correcto
        //'Illuminate\Auth\Events\Login' => [
        //    'App\Listeners\SuccessfulLogin',
        //],
        Login::class => [
            SuccessfulLogin::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
