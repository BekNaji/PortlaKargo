<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Telegram\Bot\Api;
use Telegram;
class TelegrambotController extends Controller
{
    public function index()
    {
        $telegram = new Api('1327273177:AAGsQR9gbP3bzOs0wRmknzGXcsPxmP_U9wY');
        $response = $telegram->getUpdates();
        $lastMessage = end($response);

        $chatId = $lastMessage->message->chat->id;
        $lastMessageText = $lastMessage->message->text;
         
        
        $sendMessage = $telegram->sendMessage([
            'chat_id' => $chatId, 
            'text' => $lastMessageText
        ]);

        return $sendMessage;
        // dd($lastMessageText);
    }
}