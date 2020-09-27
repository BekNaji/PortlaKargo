<?php 

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\Permission;

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
        if(!Permission::check('user-index') and Auth::user()->role != 'root')
        {
            return abort('419');
        }
        return $next($request);
    }
}
