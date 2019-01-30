<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            //Ruta a la que redirigir el usuario si no está autenticado
            //y accede a un lugar restringido
            //  >> por defecto
            ////return route('login');
            //  >> indicando que se redirija a una determinada vista
            ////return route('index');
            //---------------------------------------------------------------
            //  >> indicando que se redirija a una determinada vista
            //  y mostrando el MODAL de Login al intentar acceder a zona restringida
            //  sin previo inicio sesión
            ////return route('index', [
            ////    'intento_acceso_restringido' => 1,
            ////    'modal' => 'loginModal',
            ////]);
            session(['noAuth' => 'loginModal']);
            return route('index');
        }
    }
}
