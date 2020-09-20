<?php

//include (__DIR__ . '/vendor/irazasyed/telegram-bot-sdk/src/Api.php');

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;


class TelegrambotController extends Controller
{
    // 617396608

    public function index(Request $request)
    {
        //$id = $request->message['chat']['id'];
        $id = 1;
        // $text = $request->message['text'];
        // $token = '1189155685:AAGljmd5avC5vBqTxCzlbp6AngNUl97GTSU';
        // //$url = 'https://api.telegram.org/bot'.$token.'/sendMessage';
        $url = 'https://bek.requestcatcher.com/';
        
        $buttons = [
            ['text' => 'Selam']
        ];
        
        
        $response = Http::post($url,
            [
                'chat_id' => $id,
                'text' => 'Selam Gardes',
                'reply_markup'=>$buttons,
            ]);
     

     

    }


    


}