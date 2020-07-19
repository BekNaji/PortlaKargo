<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SmsController extends Controller
{

	protected $key;
	protected $hash;
	protected $orgin_name;
	protected $date;

	public function __construct()
	{
		$this->key 	= '8717964ad7bd253aa0a2668f499747e0';
		$hide_key 	= '$2y$12$BDVopkjen2sJNjjQWsjvRe8glh4qC6nKGGoJDCsrzwzsfNVLWralK';
		$this->hash = hash_hmac('sha256', $this->key, $hide_key);
		$this->orgin_name = 'APITEST';
		
	}

	

	public function sendSMS($text='',$phone='')
	{
		$authentication = array('key'=>$this->key,'hash'=>$this->hash);

		$number 		= array('5550156185');

		$receipents 	= array('number' =>	$number);

		$message		=array(
			'text'			=> 'Bu sms test qilish uchun yuborildi',
			'receipents'	=> $receipents);

		$order = array(
			'sender'		=> $this->orgin_name,
			'sendDateTime'	=> array(),
			'message'		=> $message);


		$all = array('authentication'=> $authentication,'order'=> $order);
		$array = array('request' => $all);
	
		$data = json_encode($array);

		
		$result = $this->sendRequest('http://api.iletimerkezi.com/v1/send-sms/json',$data,array('Content-Type: text/json'));

		$result = json_decode($result);

		dd($result);
		
	
	}

	public function getBalance()
	{
		


		$array = array('request'
					=>array('authentication' =>array('key'=>$this->key,'hash'=>$this->hash)));
		
		$data = json_encode($array);
		// return $data;

		$result = $this->sendRequest('https://api.iletimerkezi.com/v1/get-balance/json',
			$data,array('Content-Type: text/json'));
		$result = json_decode($result);
		return $result->response->balance->sms;
		
	}

	function sendRequest($site_name,$send_xml,$header_type) 
	{

    	
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL,$site_name);
    	curl_setopt($ch, CURLOPT_POST, 1);
    	curl_setopt($ch, CURLOPT_POSTFIELDS,$send_xml);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,0);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    	curl_setopt($ch, CURLOPT_HTTPHEADER,$header_type);
    	curl_setopt($ch, CURLOPT_HEADER, 0);
    	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    	curl_setopt($ch, CURLOPT_TIMEOUT, 120);

    	$result = curl_exec($ch);

    	return $result;
	}

	
}


