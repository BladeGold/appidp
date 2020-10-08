<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   $rol = User::findOrFail($request->user()->id)->tieneRol();

         if( $rol[0] !== 'Administrador'){
            return redirect('/users');
         }

        return $next($request);
    }
}
