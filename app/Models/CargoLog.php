<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CargoLog extends Model
{
    
	protected $table = 'cargo_logs';

    public function cargoStatus()
    {
    	return $this->belongsTo('App\Models\CargoStatus','cargo_status_id','id');
    }
}
