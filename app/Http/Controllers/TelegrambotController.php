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
        return (json_encode($updates));
        
    }
}