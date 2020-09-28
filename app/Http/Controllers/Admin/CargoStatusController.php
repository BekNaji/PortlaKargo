<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CargoStatus;
use Auth;
use Permission;
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

    public function store(Request $request)
    {
        if(!Permission::check('cargo-status-create'))
        {
            abort('419');
        }
    	$status = new CargoStatus();
        $status->company_id = Auth::user()->company_id;
    	$status->name = $request->name;
        $status->type = $request->type;
        $status->send_phone = $request->send_phone;
    	$status->save();

    	return back()->with(['success'=>'Kaydedildi!']);
    }

    public function update(Request $request)
    {
        if(!Permission::check('cargo-status-create'))
        {
            abort('419');
        }
    	$status = CargoStatus::find($request->id);
    	$status->name = $request->name;
        $status->type = $request->type;
        $status->send_phone = $request->send_phone;
    	$status->save();

    	return back()->with(['success'=>'Güncellendi!']);
    }

    public function delete(Request $request)
    {
        if(!Permission::check('cargo-status-delete'))
        {
            abort('419');
        }
    	$status = CargoStatus::find($request->id);
    	$status->name = $request->name;
    	$status->delete();

    	return back()->with(['success'=>'Silindi!']);
    }



   
}
