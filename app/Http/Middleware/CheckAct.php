<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckAct
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
        if(Auth::user()->role != 'admin')
        {
            return abort('419');
        }
        return $next($request);
    }
}
