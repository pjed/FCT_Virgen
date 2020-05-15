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
        if ($n != null) {
            foreach ($n as $u) {
                if ($u['rol'] == 1 || $u['rol'] == 0 || $rol1 == 1) {
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
