<?php

namespace App\Http\Middleware;

use Closure;

class tutor {

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
        //comprobar si eres tutor
        foreach ($n as $u) {
            if ($u['rol'] == 2 || $rol1 == 2) {
                return $next($request);
            } else {
                abort(518);
                //return view('errors/518');
            }
        }
    }

}
