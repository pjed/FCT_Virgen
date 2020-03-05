<?php

namespace App\Http\Middleware;

use Closure;

class general {

    /**
     * Handle an incoming request.
     * @author Marina
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $n = session()->get('usu');
        //comprobar si eres admin

        if ($n != null) {
            return $next($request);
        } else {
            abort(518);
            //return view('errors/518');
        }
    }

}
