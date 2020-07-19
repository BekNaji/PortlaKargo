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
        $this->telegram = new Api(env('1327273177:AAGsQR9gbP3bzOs0wRmknzGXcsPxmP_U9wY'));
    }

    public function index(Request $request)
    {
        
    
        $this->chat_id = $request['message']['chat']['id'];
        $this->username = $request['message']['from']['username'];
        $this->text = $request['message']['text'];
 
        switch ($this->text) {
            case '/start':
                 $sendMessage = $this->telegram::sendMessage([
                    'chat_id' => $this->chat_id, 
                    'text' => 'Salom'
                ]);
                break;
            default:
                $sendMessage = $this->telegram::sendMessage([
                    'chat_id' => $this->chat_id, 
                    'text' => 'Tushinmadim!'
                ]);
        }
   
        // $telegram = new Telegram('1327273177:AAGsQR9gbP3bzOs0wRmknzGXcsPxmP_U9wY');
        // $response = $telegram::getUpdates();
        // $lastMessage = end($response);

        // $chatId = $lastMessage->message->chat->id;
        // $lastMessageText = $lastMessage->message->text;
         
        // if($lastMessageText == '/start')
        // {
        //     $content array('chat_id'=>)
        // }
        // $sendMessage = $telegram::sendMessage([
        //     'chat_id' => $chatId, 
        //     'text' => 'Salom'
        // ]);

        
    }
}