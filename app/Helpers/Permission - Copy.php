<?php 

namespace App\Helpers;
use App\Models\Page;
use Auth;

class Permission
{
     


     
    static function check($title)
    {
        $page = Page::where('title','=',$title)->get()->first();
        if($page)
        {
            $permissions = Auth::user()->permissions;

            $permissions = explode(',', $permissions);

            foreach ($permissions as $permission) 
            {
                if($page->row == $permission)
                {
                    return true;
                }
            }
        }

        return false;


    }
	
}