<?php

namespace App\Http\Middleware;

use Closure;

class HasTipoTransaccionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if(!$request->user()->tiposTransaccion($tipo_transaccion)) {
            return redirect('/');
        }
        return $next($request);
    }
}
