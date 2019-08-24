<?php

namespace App\Http\Middleware;

use Closure;

class OneUserRegister
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if   (\App\User::count()<=0) {
            return $next($request);
        } else {
            return redirect('login');
        }        
    }
}
