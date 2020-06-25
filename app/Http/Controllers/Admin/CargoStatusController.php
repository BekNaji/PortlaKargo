<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CargoStatus;
use Auth;

class CargoStatusController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('checkact');
    }
    public function index()
    {
    	$statuses = CargoStatus::all();
 
    	return view('admin.cargoStatus.index',compact('statuses'));
    }

    public function store(Request $request)
    {
   
    	$status = new CargoStatus();
    	$status->name = $request->name;
    	$status->save();

    	return back()->with(['success'=>'Kaydedildi!']);
    }

    public function update(Request $request)
    {
    	$status = CargoStatus::find($request->id);
    	$status->name = $request->name;
    	$status->save();

    	return back()->with(['success'=>'Güncellendi!']);
    }

    public function delete(Request $request)
    {
    	$status = CargoStatus::find($request->id);
    	$status->name = $request->name;
    	$status->delete();

    	return back()->with(['success'=>'Silindi!']);
    }



   
}
