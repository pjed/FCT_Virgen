<?php

namespace App\Http\Middleware;

use Closure;

class tutorAdmin {

    /**
     * Handle an incoming request.
     * @author Marina
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $rol1 = session()->get('rol1');
        $rol2 = session()->get('rol');
        //comprobar si eres tutor-admin
        if (($rol2 == 4 && $rol1 == 1) || ($rol2 == 4 && $rol1 == 2)) {
            return $next($request);
        } else {
            abort(404);
            //return view('errors/518');
        }
    }

}
