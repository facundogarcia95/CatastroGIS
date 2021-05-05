<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class Consulta
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
        
        $rol = Auth::user()->idrol;
      
        if($rol == 1 || $rol == 2 || $rol == 3 || $rol == 4 ){

            return $next($request);

        }else{

            abort(403,"No posee permisos suficientes.");
        }
        
    }
}
