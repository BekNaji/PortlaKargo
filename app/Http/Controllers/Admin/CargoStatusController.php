<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CargoStatus;
use Auth;
use Permission;
use App\Models\Cargo;

class CargoStatusController extends Controller
{
    
    
    public function index()
    {
         if(!Permission::check('cargo-status-index'))
        {
            abort('419');
        }
    	$statuses = CargoStatus::where('company_id',Auth::user()->company_id)->get();
 
    	return view('admin.cargoStatus.index',compact('statuses'));
    }

    // store category
    public function store(Request $request)
    {
    	$status                             = new CargoStatus();
        $status->company_id                 = Auth::user()->company_id;
    	$status->name                       = $request->name;
    	$status->sms_message                = $request->sms_message;
        $status->public_status              = $request->public_status;
        $status->type                       = $request->type;
        $status->send_phone                 = $request->send_phone;
    	$status->save();

    	return back()->with(['success'=>'Kaydedildi!']);
    }

    // update category
    public function update(Request $request)
    {
    	$status = CargoStatus::find($request->id);

        if($request->public_status != $status->public_status)
        {
            $cargos = Cargo::where('status','=',$status->id)->get();
            foreach ($cargos as $cargo) 
            {
               $cargo->public_status = $request->public_status;
               $cargo->save();
            }  
        }
        $status->public_status      = $request->public_status;
    	$status->name               = $request->name;
        $status->sms_message        = $request->sms_message;
        $status->type               = $request->type;
        $status->send_phone         = $request->send_phone;
    	$status->save();

    	return back()->with(['success'=>'Güncellendi!']);
    }

    // delete category
    public function delete(Request $request)
    {
       
    	$status = CargoStatus::find($request->id);
    	$status->name = $request->name;
    	$status->delete();

    	return back()->with(['success'=>'Silindi!']);
    }



   
}
