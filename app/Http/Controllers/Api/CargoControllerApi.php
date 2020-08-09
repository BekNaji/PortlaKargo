<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cargo;
use App\Models\CargoLog;


class CargoControllerApi extends Controller
{
    public function index(Request $request)
    {
    	if($request->n == '')
    	{
    		array('message' => 'Are you trying to hack?');
    	}
    	$cargo = Cargo::where('number','=',$request->n)->get()->first();
    	if(!$cargo)
    	{
    		$array = array('message'=>'Boyle bir kayit bulunmadi! Tekrar Deneyiniz!');

    	}else
    	{
    		$cargoLogs = CargoLog::where('cargo_id',$cargo->id)->get()->last();

    		$array = array(
    			'company'=> $cargo->company->name,
    			'number' => $cargo->number,
    			'current_status' => $cargo->cargoStatus->name,
    			'date' => $cargoLogs->created_at,
    		);
    		
    		
    	}
        return json_encode($array);
    	
    }
}
