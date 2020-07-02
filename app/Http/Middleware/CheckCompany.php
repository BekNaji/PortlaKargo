<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckCompany
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

        if(Auth::user()->role != 'root')
        {
            if(Auth::user()->company_id == ' ')
            {
                return redirect()->route('company.register');
            }
            if(Auth::user()->company->status == 0)
            {
                return redirect()->route('company.status');
            }
           
        }
        return $next($request);
    }
}
