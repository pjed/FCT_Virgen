<?php

namespace App\Http\Middleware;

use Closure;

class general {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $n = session()->get('usu');
        //comprobar si eres admin

        if ($n == 2) {
            return $next($request);
        } else {
            abort(518);
            //return view('errors/518');
        }
    }

}
