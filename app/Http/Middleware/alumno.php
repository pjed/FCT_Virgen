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
        if ($n != null) {
            foreach ($n as $u) {
                if ($u['rol'] == 3) {
                    return $next($request);
                } else {
                    abort(404);
                    //return view('errors/518');
                }
            }
        } else {
            abort(404);
        }
    }

}
