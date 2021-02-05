<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\Config;

class Permission
{
    
    static function check($title)
    {
        $permissions = Config::get('permissions');
        if(isset($permissions[$title]) && $permissions[$title] != 'Y')
        {
            return false;
        }
        return true;


    }
	
}