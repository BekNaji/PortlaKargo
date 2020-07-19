<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Telegram\Bot\Api;
use Telegram;
class TelegrambotController extends Controller
{
    protected $telegram;
    protected $chat_id;
    protected $username;
    protected $text;

    public function __construct()
    {
        $this->telegram = new Telegram('1327273177:AAGsQR9gbP3bzOs0wRmknzGXcsPxmP_U9wY');
    }

    public function index(Request $request)
    {
        
        $telegram = new Telegram('1327273177:AAGsQR9gbP3bzOs0wRmknzGXcsPxmP_U9wY');

        $updates = Telegram::getUpdates();

        $chat_id = end($updates)->message->chat->id;
        
        return $this->sendMessage($chat_id,"Hello World");
        
    }

    public function sendMessage($id,$message)
    {
        Telegram::sendMessage([
            'chat_id' => $id,
            'text' => $message
        ]);
        return;
    }
}