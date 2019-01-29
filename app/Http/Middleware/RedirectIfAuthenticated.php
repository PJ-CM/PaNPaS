<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            //Por defecto
            ////return redirect('/home');
            //ACTUALMENTE
            // Check user role
            switch (Auth::user()->perfil_id) {
                case 1:
                        return redirect('/admin/dashboard');
                    break;
                case 2:
                        $url = '/users/'.Auth::user()->username;
                        return redirect($url);
                    break;
                default:
                        return redirect('/');
                    break;
            }
        }

        return $next($request);
    }
}
