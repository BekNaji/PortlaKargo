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



class DeliveryController extends Controller
{
    public function index()
    {
    	return view('admin.delivery.index');
    }

    public function edit(Request $request)
    {
    	if($request->number != '')
    	{
    		$cargo = Cargo::where('number','=',$request->number)
    						->where('company_id','=',Auth::user()->company_id)->get()->first();

            $statuses = CargoStatus::where('company_id',Auth::user()->company_id)
                                ->where('type','kurye')->get();

    		if(!$cargo)
    		{

    			return back()->with(['error'=>'Kargo Takip numarasi bulunamadi!']);
    		}
            
    		
    		return view('admin.delivery.edit',compact('cargo','statuses'));
    	}
    }

    public function store(Request $request)
    {
        $cargo = Cargo::find($request->id);
        $cargo->receiver_name = strtoupper($request->receiver);

        if($cargo->status != $request->status)
        {
            $this->storeLog($cargo->id,$request->status);
        } 
        $cargo->status = $request->status ?? '';
        $cargo->save();
        


        return redirect()->route('delivery.index')->with(['success'=>'Kargo Durumu Gümcellendi!']);

    }
    # store log
    public function storeLog($id,$status)
    {

        $cargoLog = new CargoLog();
        $cargoLog->cargo_id = $id;
        $cargoLog->cargo_status_id = $status;
        $cargoLog->save();
        $status = CargoStatus::find($status);
        $this->sendMessage($id,$status->name);
        
        if($status->send_phone == 'true')
        {
            $sms_response = $this->sendPhone($id,$status->name);
            session()->flash('sms_code',$sms_response->status->code);
        }

    }

    public function sendPhone($id,$status)
    {
        $message = 'Sn. Müşterimiz ';
        $cargo = Cargo::find($id);
        $message .= $cargo->number;
        $message .= ' nolu gonderi hk bilgi!'.PHP_EOL;
        $message .= 'Status: '.$status.PHP_EOL;
        
        $sms = new SendSMS();
        
        return $sms->sendSms($message,$cargo->sender->phone);
        
    }

    public function sendMessage($id,$status)
    {
        $message = '';
        $cargo = Cargo::find($id);

        $message .= '<b>Şirket adı:</b> '.$cargo->company->name.' '.PHP_EOL;
        $message .= '<b>Kargo Durumu: </b>'.$status.' '.PHP_EOL;
        $message .='<b>Kargo Takip No : </b>'.$cargo->number.' '.PHP_EOL;
        $message .= '<b>Gönderici: </b>'.$cargo->sender->name ?? '-';
        $message .= PHP_EOL;
        $message .= '<b>Alıcı: </b>'.$cargo->receiver->name ?? '-';
        $message .= PHP_EOL.PHP_EOL;
        $message .= '<b>Teslim Alan: </b>'.$cargo->receiver_name ?? '-'.' '.PHP_EOL;
        if($cargo->company->telegram_url != '')
        {
            $url = $cargo->company->telegram_url;

            if($cargo->sender->telegram_id != '')
            {
                $response = Http::post($url.'sendMessage.php',
                [
                    'id' => $cargo->sender->telegram_id,
                    'message' => $message,
                ]);
            }

            if($cargo->receiver->telegram_id != '')
            {
                $response = Http::post($url.'sendMessage.php',
                [
                    'id' => $cargo->receiver->telegram_id,
                    'message' => $message,
                ]);
            }
            
        }
        
        

        return ;
    }
}
