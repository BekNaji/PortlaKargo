<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Cargo;
use App\Models\Customer;
use App\Models\Company;


class TelegramController extends Controller
{

    public function sendMessage(Request $request)
    {
        $message = '';
        $cargo = Cargo::find($request->id);

        $customer = Customer::find($cargo->sender_id);

        $company = Company::find($customer->company_id);

        $message .= '<b>Şirket adı:</b> '.$company->name.' '.PHP_EOL;
        $message .= '<b>Kargo Durumu: </b>'.$cargo->cargoStatus->name.' '.PHP_EOL;
        $message .='<b>Kargo Takip No : </b>'.$cargo->number.' '.PHP_EOL;
        if($company->telegram_url != '')
        {
            $url = $company->telegram_url;
            $response = Http::post($url.'sendMessage.php',
                [
                    'id' => $customer->telegram_id,
                    'message' => $message,
                ]);
        }
        else
        {
            $response = Http::post('https://beknaji.online/telegrambot/sendMessage.php',
                [
                    'id' => $customer->telegram_id,
                    'message' => $message,
                ]);
        }
        

        return back()->with(['success'=>'Kargo durmu müşteriye iletildi!']);
    }

    public function sendMultipleMessage(Request $request)
    {

        $message = '';

        $sms = '';

        $ids = explode(',', $request->ids);

        if($request->sms != '')
        {
            $sms .= '<b>Bildirim: </b>';
            $sms .= $request->sms;
        }

        foreach ($ids as $key => $id) 
        {
            $cargo = Cargo::find($id);

            $customer = Customer::find($cargo->sender_id);

            $company = Company::find($customer->company_id);

            if($customer->telegram_id != '')
            {
                
                if($request->status == 'yes')
                {
                    $message .= '<b>Şirket adı:</b> '.$company->name.''.PHP_EOL;
                    $message .= '<b>Kargo Durumu: </b>'.$cargo->cargoStatus->name.''.PHP_EOL;
                    
                }
                $message .='<b>Kargo Takip No : </b>'.$cargo->number.''.PHP_EOL.PHP_EOL;
                $message .= $sms;
                
                if($company->telegram_url != '')
                {
                    $url = $company->telegram_url;
                    $response = Http::post($url.'sendMessage.php',
                    [
                    'id' => $customer->telegram_id,
                    'message' => $message,
                    ]);
                }
            }

            $message = '';
        }
        
        return back()->with(['success'=>'Mesajlar gönerildi!']);
        

        
    }


}
