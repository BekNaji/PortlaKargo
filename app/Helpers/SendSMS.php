<?php 
/**
 * 
 */
namespace App\Helpers;
use Auth;
use App\Models\Company;
use Log;

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

    public static function LogIt($result,$comment)
    {
        $html = '/--------------'.$comment.'-----------------/'.PHP_EOL;
        $html .= $result.PHP_EOL;
        $html .= date('d-m-Y h-i-s A').PHP_EOL;
        Log::info($html);
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
        self::LogIt($response,$tel);
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
        self::LogIt($response,$tel);
        $result = json_decode($response);
        return $result;
    }
    public function sendMultipleSmsUz($data)
    {
        $API_KEY = trim(self::$api_tokenUZ);

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "notify.eskiz.uz/api/message/sms/send",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $data,
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer ".$API_KEY
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        return json_decode($response);
    }

    static function getBalanceUZ()
    {
        $API_KEY = trim(self::$api_tokenUZ);
    
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://notify.eskiz.uz/api/user/get-limit',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array( 'Authorization: Bearer '.$API_KEY
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        
        return json_decode($response);
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
        $post = array('email' => self::$company->api_emailUZ,'password' => self::$company->api_keyUZ);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return json_decode($result);
    }



}