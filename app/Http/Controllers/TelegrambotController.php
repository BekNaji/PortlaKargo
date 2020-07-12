<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Api;

class TelegrambotController extends Controller
{
    public function index()
    {
    	$telegram = new Api('1327273177:AAGsQR9gbP3bzOs0wRmknzGXcsPxmP_U9wY');
    	$message_id = $telegram->getUpdates()[0]->message->chat->id;


    	$response = $telegram->sendMessage([
    		"chat_id" => $message_id,
    		"text" => "Hello World"
    	]);

    	

    	echo $response->getMessageId()." numarlari mesaj gonderildi";



    }
}
