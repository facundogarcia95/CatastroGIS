<?php

namespace App\Http\Middleware;

use App\Events\LoginLogout;
use App\User;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;

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
           //dd($request->cookie('usuario'));
            session(['urlAccedida' => $request->fullUrl()]);
            $user = User::where('usuario_id','=',$request->cookie('usuario'))->first();
            event(new LoginLogout($user,2,"Sesión Expirada"));
            return route('fromLogin');
        }
    }
}
