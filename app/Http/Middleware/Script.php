<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class Script
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        return $next($request);

        /*$rol = Auth::user()->idrol;
      
        if($rol == 1 || $rol == 4 ){

            return $next($request);

        }else{

            abort(403,"No posee permisos suficientes.");
        }*/
        
    }
}