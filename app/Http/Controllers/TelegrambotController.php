<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Telegram\Bot\Api;
use Telegram;
use Illuminate\Support\Facades\Http;
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
        
        // $telegram = new Telegram('1327273177:AAGsQR9gbP3bzOs0wRmknzGXcsPxmP_U9wY');

        // $updates = Telegram::getUpdates();

        // $chat_id = end($updates)->message->chat->id;
        
        // $text = end($updates)->message->chat->text;
        // if($text == '/test')
        // {
        //     $this->sendMessage($chat_id,"You wrote Test");
        // }
        // $this->sendMessage($chat_id,"Hello World");

        return response()->json(['test'=>'it is testing']);
        
    }

    public function sendMessage()
    {
        

        $response = Http::asForm()->post('http://telegrambot.test', [
            'name' => 'Steve',
            'role' => 'Network Administrator',
        ]);
        $data = $response->json();
        dd($data);
    }
}