<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cargo;
use App\Models\CargoStatus;
use App\Models\CargoLog;
use Auth;
use Illuminate\Support\Facades\Http;
use App\Helpers\sendSMS;
use App\Helpers\Upload;



class DeliveryController extends Controller
{
    public function index()
    {
    	return view('admin.delivery.index');
    }

    public function edit(Request $request)
    {
    	
        $request->validate(['number' => 'required']);

        $cargo = Cargo::where('number','like','%'.$request->number)->where('company_id','=',auth()->user()->company_id)->get()->first();

        $cargos = Cargo::where('sender_id','=',$cargo->sender_id)->where('status','=',$cargo->status)->get();

        $statuses = CargoStatus::where('company_id',auth()->user()->company_id)->where('type','kurye')->get();

        if(!$cargo) return back()->with(['error'=>'Kargo Takip numarasi bulunamadi!']);
        
        return view('admin.delivery.edit',compact('cargos','statuses'));
    	
    }
    /**
     * This function update cargo by cargo id
     * @param $request  array
     * @return response
     */
    public function store(Request $request)
    {
        $image = '';
        # loop by cargo numbers
        foreach($request->numbers as $item)
        {
            # find cargo
            $cargo = Cargo::findOrFail($item);
            
            # if $image is empty and  has request file then updload it (one time upload image)
            if($image == '' && $request->has('receiver_image') )
            {
                $image = Upload::uploadImage($request->file('receiver_image'),'');
            }
            # if $image doest not empty then
            if($image != ''){ $cargo->receiver_image = $image; }

            # receiver name
            $cargo->receiver_name = strtoupper($request->receiver);

            if($cargo->status != $request->status)
            {
                # cargo status
                $cargo->status = $request->status;

                $this->storeLog($cargo);
            } 
            # cargo save
            $cargo->save();
        }

        return redirect()->route('delivery.index')->with(['success'=>'Kargo Durumu Gümcellendi!']);

    }
    # store log
    public function storeLog($cargo)
    {
        $cargoLog = new CargoLog();
        $cargoLog->cargo_id = $cargo->id;
        $cargoLog->cargo_status_id = $cargo->status;
        $cargoLog->save();
    
        if($cargo->cargoStatus->send_phone == 'true')
        {
            $sms = new SendSMS();
            $sms->sendSms($cargo);

        }
        return session()->flash('sms_code',200);
    }
}
