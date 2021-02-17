<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Receiver;
use App\Models\Cargo;
use Auth;
use App\Models\CargoStatus;
use Excel;
use App\Helpers\SendSMS;


class ReceiverController extends Controller
{
    public function index()
    {
    	$receivers  = Receiver::where('company_id',Auth::user()->company_id)->get();
    	return view('admin.receiver.index',compact('receivers'));
    }

    public function store(Request $request)
    {
        $receiver = Receiver::where('phone','=',$request->phone)
        ->where('company_id','=',Auth::user()->company_id)
        ->get()->first();
        
        if(!$receiver)
        {
            $receiver = new Receiver();
        }
        //$address = explode(' ', $request->address);

    	$receiver->company_id = Auth::user()->company_id;
        $receiver->name     = strtoupper($request->name);
        $receiver->passport = strtoupper($request->passport);
        $receiver->phone    = strtoupper($request->phone);
        $receiver->address  = strtoupper($request->address);
        $receiver->save();

        return back()->with(['success'=>'Kaydedildi']);

    }

    public function edit(Request $request)
    {
    	$receiver = Receiver::find(decrypt($request->id));
  
    	return view('admin.receiver.edit',compact('receiver'));
    }

    public function show(Request $request)
    {
        $receiver = Receiver::find(decrypt($request->id));
        $cargos = Cargo::where('receiver_id','=',decrypt($request->id))->orderBy('id','DESC')->get();
        $statuses = CargoStatus::where('company_id','=',Auth::user()->company_id)->get();
  
    	return view('admin.receiver.show',compact('receiver','cargos','statuses'));
    }

    public function showFilter(Request $request)
    {
        $cargos = Cargo::where('receiver_id','=',decrypt($request->id))->orderBy('id','DESC');
        
        if($request->from !='')
        {
            $from = Carbon::parse($request->from.' 00:00:00')->format('Y-m-d H:i:s');
            $cargos->where('created_at','>=',$from);
        }
        if($request->to !='')
        {
            $to   = Carbon::parse($request->to.' 23:59:59')->format('Y-m-d H:i:s');
            $cargos->where('created_at','<=',$to);

        }
        
        if($request->status != 'all')
        {
            $cargos->where('status','=',$request->status);
        }

        $cargos = $cargos->get();
        
        $receiver = Receiver::find(decrypt($request->id));
        
        $statuses = CargoStatus::where('company_id','=',Auth::user()->company_id)->get();
        
    	return view('admin.receiver.show',compact('receiver','cargos','statuses'));
       
    }

    public function createExcell(Request $request)
    {
        // id from to status
        $cargos = Cargo::where('receiver_id','=',$request->id)->orderBy('id','DESC');
        
        if($request->from !='')
        {
            $from = Carbon::parse($request->from.' 00:00:00')->format('Y-m-d H:i:s');
            $cargos->where('created_at','>=',$from);
        }
        if($request->to !='')
        {
            $to   = Carbon::parse($request->to.' 23:59:59')->format('Y-m-d H:i:s');
            $cargos->where('created_at','<=',$to);

        }
        
        if($request->status != 'all')
        {
            $cargos->where('status','=',$request->status);
        }

        $cargos = $cargos->get();
        
        // $receiver = Receiver::find(decrypt($request->id));
        
        $datas = [
            [ 'Invoice No','Name','Address','KG','Total Price','Payment','Phone','Other Phone','Sender'],
        ];

        $total_kg = 0;
        foreach($cargos as $cargo) 
        {
            $data = [
                $cargo->number ?? '',
                $cargo->receiver->name ?? '',
                $cargo->receiver->address ?? '',
                $cargo->total_kg ?? '',
                '',
                '',
                $cargo->receiver->phone ?? '',
                $cargo->other_phone ?? '',
                $cargo->sender->name ?? '',
            ];
            array_push($datas,$data);

            // calculate all kg
            $total_kg += $cargo->total_kg;
        }
        // get last data
        $last_data = count($datas)-1;
            
        // change value of last data index 4 = Total kg
        $datas[$last_data][4] = $total_kg;

        $date = date('d.m.Y');
        $filename = $date.'-dastafka.xlsx';
        return Excel::download(new \App\Exports\CargoExcel($datas), $filename);
       
    }


    public function update(Request $request)
    {
        $receiver = Receiver::find($request->id);
        
        $receiver->company_id = Auth::user()->company_id;
        $receiver->name     = strtoupper($request->name);
        $receiver->passport = strtoupper($request->passport);
        $receiver->phone    = strtoupper($request->phone);
        $receiver->address  = strtoupper($request->address);
        $receiver->save();
        return redirect()->route('receiver.index')->with(['success'=>'Güncellendi!']);

    }

    public function delete(Request $request)
    {

    	$receiver = Receiver::find($request->id); 
        $receiver->delete();
        return back()->with(['success'=>'Silindi!']);
    }

    public function sendSms(Request $request)
    {
        
        $ids = explode(',', $request->ids);
        
        foreach ($ids as $key => $id) 
        {
            $receiver = Receiver::find($id);

            if($receiver->phone !='')
            {
                
                $tel = $receiver->phone;

                if(strlen($tel) != 12)
                {
                    $tel = '998'.str_replace([' ',',','  '],'',$receiver->phone); 
                }
                $data["messages"][] = array(
                    "to" => $tel,
                    "text"=>$request->sms
                );
                
            } 

        }
        $sms = new SendSMS();
        $data["message"] = $sms->sendMultipleSmsUZ($data);
    
        return back()->with(['success'=>'SMS gönderildi!','message' => $data["message"]]);
    }

}
