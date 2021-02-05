<?php 

namespace App\Http\Middleware;

use App\Models\Page;
use Closure;
use Auth;
use Illuminate\Support\Facades\Config;

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

        $permissions = explode(',',Auth::user()->permissions);
        
        foreach(Page::all() as $page)
        {
            if(in_array($page->row,$permissions))
            {
                $data[$page->title] = "Y";
            }else
            {
                $data[$page->title] = "N";
            }
        }

        Config::set('permissions',$data);
       
        return $next($request);
    }
}
