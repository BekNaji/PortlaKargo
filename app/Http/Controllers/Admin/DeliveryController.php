<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cargo;
use App\Models\CargoStatus;
use Auth;
use Illuminate\Support\Facades\Http;

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
        $cargo->receiver_name = $request->receiver;
        $cargo->status = $request->status ?? '';
        $cargo->save();

        $this->sendMessage($cargo->id);

        return redirect()->route('delivery.index')->with(['success'=>'Kargo Durumu Kaydedildi! Mesaj Gönderildi!']);

    }

    public function sendMessage($id)
    {
        $message = '';
        $cargo = Cargo::find($id);

        $message .= '<b>Şirket adı:</b> '.$cargo->company->name.' '.PHP_EOL;
        $message .= '<b>Kargo Durumu: </b>'.$cargo->cargoStatus->name.' '.PHP_EOL;
        $message .='<b>Kargo Takip No : </b>'.$cargo->number.' '.PHP_EOL;
        $message .= '<b>Teslim Alan: </b>'.$cargo->receiver_name ?? 'Teslim alinmadi'.' '.PHP_EOL;
        if($cargo->company->telegram_url != '')
        {
            $url = $company->telegram_url;
            $response = Http::post($url.'sendMessage.php',
                [
                    'id' => $cargo->sender->telegram_id,
                    'message' => $message,
                ]);
        }
        else
        {
            $response = Http::post('https://beknaji.online/telegrambot/sendMessage.php',
                [
                    'id' => $cargo->sender->telegram_id,
                    'message' => $message,
                ]);
        }
        

        return ;
    }
}
