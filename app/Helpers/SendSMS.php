<?php 
/**
 * 
 */
namespace App\Helpers;
use Auth;
use App\Models\Company;

class SendSMS
{
	static $api_key;
    static $company;

	public function __construct()
    {
        self::$company = Company::find(Auth::user()->company_id);

        self::$api_key = self::$company->api_key;
    }
    static function getBalance()
    {
        $url = "http://api.v2.masgsm.com.tr/v2/get/balance";
        $response = self::MASGSM($url);
        $result = json_decode($response);
        return $result;
    }

    public function getTitle()
    {
        $url = "http://api.v2.masgsm.com.tr/v2/get/originators";
        $response = self::MASGSM($url);
        $result = json_decode($response);
        return $result;
    }

    public function sendSms($sms,$tel)
    {
      
        $url = "http://api.v2.masgsm.com.tr/v2/sms/basic";
        $body = 
            [
                "originator"=>self::$company->sms_title,
                "message"=>$sms,
                "to"=>[$tel],
                "encoding"=>"default"
            ];
        dd($body);
        $response = self::MASGSM($url,$body);
        $result = json_decode($response);
        return $result;
    }

    static function MASGSM($Url, $body = null)
    {
        $API_KEY = self::$api_key;

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