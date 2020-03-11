<?php

namespace App\Http\Middleware;

use Closure;

class alumno {

    /**
     * Handle an incoming request.
     * @author Marina
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $n = session()->get('usu');
        //comprobar si eres alumno
        foreach ($n as $u) {
            if ($u['rol'] == 3) {
                return $next($request);
            } else {
                abort(518);
                //return view('errors/518');
            }
        }
    }

}
