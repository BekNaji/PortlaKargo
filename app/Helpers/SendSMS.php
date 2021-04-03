<?php 
/**
 * 
 */
namespace App\Helpers;
use Auth;
use App\Models\Company;
use Log; 
use Illuminate\Support\Facades\Http;
use SimpleXMLElement;

class SendSMS
{
	static $api_key;
	static $api_keyUZ;
    static $company;
    static $api_tokenUZ;

	public function __construct()
    {
        
        self::$company = Company::find(Auth::user()->company_id);
        //dd(self::$company);
        self::$api_key = self::$company->api_key;
        self::$api_keyUZ = self::$company->api_keyUZ;
        self::$api_tokenUZ = self::$company->api_tokenUZ;
    }
    static function getBalance()
    {
        $url = "http://178.157.12.155:8080/api/credit/v1?";
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url.'username='.self::$company->sms_title.'&password='.self::$company->api_key);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
    
        if($result != 87)
        {
            return ['succuss' => true,'credit'=>explode(' ',$result)[1]];
        }
        return ['success'=> false] ;
    }

    public function getTitle()
    {
        $url = "http://178.157.12.155:8080/api/originator/v1?";
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url.'username='.self::$company->sms_title.'&password='.self::$company->api_key);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        if($result != 87)
        {
            return ['success' => true,'title'=>explode(' ',$result)[1]];
        }
        return ['success'=> false];

    }
    public function sendSms($sms,$tel)
    {
        $xml = '
        <sms>
        <username>'.self::$company->sms_title.'</username>
        <password>'.self::$company->api_key.'</password>
        <header>ZOLOTOY</header>
        <validity>2880</validity>
            <messages>
                <mb><no>'.$tel.'</no><msg>'.$sms.'</msg></mb>
            </messages>
        </sms>';

        $url = "http://178.157.12.155:8080/api/smspost/v1";
    
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>$xml,
            CURLOPT_HTTPHEADER => array(
            'Content-Type: application/xml'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
    }

    public static function array_to_xml(array $arr, SimpleXMLElement $xml)
    {
        foreach ($arr as $k => $v) {
            is_array($v)
                ? self::array_to_xml($v, $xml->addChild($k))
                : $xml->addChild($k, $v);
        }
        return $xml;
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