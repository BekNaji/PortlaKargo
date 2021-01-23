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
	static $api_keyUZ;
    static $company;
    static $api_tokenUZ;

	public function __construct()
    {
        self::$company = Company::find(Auth::user()->company_id);

        self::$api_key = self::$company->api_key;
        self::$api_keyUZ = self::$company->api_keyUZ;
        self::$api_tokenUZ = self::$company->api_tokenUZ;
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

/* ------------------------------ UZ SMS ------------------------- */
    public function sendSmsUz($sms,$tel)
    {
        $url = "notify.eskiz.uz/api/message/sms/send";
        $body = array(
            'mobile_phone' => $tel,
            'message' => $sms,
            'from' => self::$company->sms_titleUZ
        );
        
        $response = self::ESKIZ($url,$body);
        $result = json_decode($response);
        return $result;
    }

    static function getBalanceUZ()
    {
        $API_KEY = trim(self::$api_tokenUZ);
    
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'http://notify.eskiz.uz/api/user/get-limit');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        
        
        $headers = array();
        $headers[] = 'Authorization: Bearer '.$API_KEY;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return json_decode($result);
    }

   
    static function ESKIZ($Url,$body = nul)
    {
        $API_KEY = self::$api_tokenUZ;
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

        $headers = array();
        $headers[] = 'Authorization: Bearer '.$API_KEY;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return $result;
    }

    static function login()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'notify.eskiz.uz/api/auth/login');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        $post = array(
            'email' => self::$company->api_emailUZ,
            'password' => self::$company->api_keyUZ
        );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return json_decode($result);
    }



}