<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'web';

    protected $fillable = ['title','description','type','image'];
}
