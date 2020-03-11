<?php

namespace App\Http\Middleware;

use Closure;

class admin {

    /**
     * Handle an incoming request.
     * @author Marina
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $n = session()->get('usu');
        $rol1 = session()->get('rol1');
        //comprobar si eres admin
        foreach ($n as $u) {
            if ($u['rol'] == 1 || $rol1 == 1) {
                return $next($request);
            } else {
                abort(518);
                //return view('errors/518');
            }
        }
    }

}
