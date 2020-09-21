<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Cargo;

class TelegramController extends Controller
{
   

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
        $ids = array_filter($ids);
        foreach ($ids as $key => $id) 
        {
            $cargo = Cargo::find($id);
            
            
            # can send cargo info to sender
            if($request->status == 'yes')
            {
                $message .= '<b>Şirket adı:</b> '.$cargo->company->name.''.PHP_EOL;
                $message .= '<b>Kargo Durumu: </b>'.$cargo->cargoStatus->name.''.PHP_EOL;
                
            }
            # define cargo truck number
            $message .='<b>Kargo Takip No : </b>'.$cargo->number.''.PHP_EOL.PHP_EOL;
            $message .= '<b>Gönderici: </b>'.$cargo->sender->name ?? '-';
            $message .= PHP_EOL;
            $message .= '<b>Alıcı: </b>'.$cargo->receiver->name ?? '-';
            $message .= PHP_EOL;
            $message .= $sms;
            
           
            $url = $cargo->company->telegram_url;

            # has sender telegram id
            if($cargo->sender->telegram_id != '')
            {
                
                $response = Http::post($url.'sendMessage.php',
                [
                'id' => $cargo->sender->telegram_id,
                'message' => $message,
                ]);

            }

            # has sender telegram id
            if($cargo->receiver->telegram_id != '')
            {
                $response = Http::post($url.'sendMessage.php',
                [
                'id' => $cargo->receiver->telegram_id,
                'message' => $message,
                ]);
            }
           

            $message = '';
        }
        
        return back()->with(['success'=>'Mesajlar gönerildi!']);
        
    }

    public function getBalance()
    {
        $url = "http://api.v2.masgsm.com.tr/v2/get/balance";
        $response = $this->MASGSM($url);
        $result = json_decode($response);
        dd($result->response->balance);
    }

    public function getHeader()
    {
        $url = "http://api.v2.masgsm.com.tr/v2/get/originators";
        $response = $this->MASGSM($url);
        $result = json_decode($response);
        dd($result->response->originators[0]);
    }
    public function sendSMS()
    {
        $url = "http://api.v2.masgsm.com.tr/v2/sms/basic";
        $body = 
            [
                "originator"=>"MASGSMTEST",
                "message"=>"BU BIR TEST SMS BEKZOD",
                "to"=>['5550156185'],
                "encoding"=>"default"
            ];
        $response = $this->MASGSM($url,$body);
        $result = json_decode($response);
        dd($result->response);
    }

    function MASGSM($Url, $body = null)
    {
        $API_KEY = "vPiiqCCL6c1KkuHjAcLqnfrEApnQpN8d8Mtv1efqWgVx";

        $ch   = curl_init();
        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',"Authorization: Key {$API_KEY}"));
        if($body):
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
        endif;
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }


}
