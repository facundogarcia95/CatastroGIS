<?php

namespace App\Http\Middleware;

use App\Evento;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class Query
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
    
       $evento = Evento::where('usuario_id','=',Auth::user()->usuario_id)->first();
         if(!$evento){
               $evento = new Evento();
               $evento->fecha = now();
               $evento->ruta = URL::current();
               $evento->usuario_id = Auth::user()->usuario_id;
               $evento->save();
         }else{
               $evento->fecha = now();
               $evento->ruta = URL::current();
               $evento->usuario_id = Auth::user()->usuario_id;
               $evento->save();
         }
         
        return $next($request);

    }
}
