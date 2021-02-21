<?php

namespace App\Http\Middleware;

use Closure;

class HasEtapa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $etapa_id)
    {
        if(!$request->user()->hasOneCargo($etapa_id)) {
            return redirect('/');
        }
        return $next($request);
    }
}