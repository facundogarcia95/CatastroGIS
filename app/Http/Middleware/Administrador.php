<?php

namespace App\Http\Middleware;

use Closure;

class Administrador
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
       
        $rol = \Auth::user()->idrol;

        if($rol == 1){

            return $next($request);
            
        }else{

            abort(403,"No posee permisos suficientes.");
        }

        return $next($request);
        
      
        
    }
}
