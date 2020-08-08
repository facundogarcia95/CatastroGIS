<?php

namespace App\Http\Middleware;

use Closure;

class Vendedor
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
        if(\Auth::user()->idrol != 2){
            return redirect('/home');
        }
        return $next($request);
    }
}
