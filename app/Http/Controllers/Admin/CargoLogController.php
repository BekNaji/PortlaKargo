<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CargoLog;

class CargoLogController extends Controller
{
    public function store()
    {

    	$cargoLog = new CargoLog();
    	$cargoLog->cargo_id = session('cargoId');
    	$cargoLog->cargo_status_id = session('cargoStatus');

    	$cargoLog->save();

    	return redirect()->route('customer.create');

    }
}
