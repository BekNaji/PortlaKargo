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
    	$statuses = CargoStatus::where('company_id',Auth::user()->company_id)->get();
 
    	return view('admin.cargoStatus.index',compact('statuses'));
    }

    public function store(Request $request)
    {
   
    	$status = new CargoStatus();
        $status->company_id = Auth::user()->company_id;
    	$status->name = $request->name;
        $status->type = $request->type;
    	$status->save();

    	return back()->with(['success'=>'Kaydedildi!']);
    }

    public function update(Request $request)
    {
    	$status = CargoStatus::find($request->id);
    	$status->name = $request->name;
        $status->type = $request->type;
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
