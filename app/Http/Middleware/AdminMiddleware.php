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
            return false . redirect('/users')->with('mensaje','No tienes permiso para ingresar a la ruta')->with('tipo','danger' );
         }

        return $next($request);
    }
}
