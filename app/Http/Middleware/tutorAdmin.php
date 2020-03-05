<?php

namespace App\Http\Middleware;

use Closure;

class tutorAdmin {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $n = session()->get('usu');
        $rol1 = session()->get('rol1');
        //comprobar si eres admin
        foreach ($n as $u) {
            $rol = $u['rol'];
        }
        if (($rol == 4 && $rol1 == 1) || ($rol == 4 && $rol1 == 2) ) {
            return $next($request);
        } else {
            abort(518);
            //return view('errors/518');
        }
    }

}
