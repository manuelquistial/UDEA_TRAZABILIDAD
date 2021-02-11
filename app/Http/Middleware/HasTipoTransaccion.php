<?php

namespace App\Http\Middleware;

use Closure;

class HasTipoTransaccion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if(!$request->user()->hasTipoTransaccion() & !$request->user()->hasOneRole("Administrador")) {
            return redirect('/transacciones/usuario');
        }
        return $next($request);
    }
}
