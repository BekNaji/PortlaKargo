<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Upload;

class Web extends Model
{
    protected $table = 'web';

    protected $fillable = ['title','description','type'];
    
    public static function uploadImage($image)
    {
        if(empty($image))
        {
            return false;
        }
        return Upload::uploadImage($image,'web/img');
    }
}
