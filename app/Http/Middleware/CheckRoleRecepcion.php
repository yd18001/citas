<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRoleRecepcion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user() && auth()->user()->role == 'recepcion') {
            if ($request->route()->getName() == 'dashboard' || $request->route()->getName() == 'citas') {
                return $next($request);
            }
            abort(403, 'No está autorizado para acceder a esta página.');
        }
    
        return $next($request);
    }
}
