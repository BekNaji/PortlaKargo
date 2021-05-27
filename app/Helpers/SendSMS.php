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
    static $loop = 0;

	public function __construct()
    {
        
        self::$company = Company::find(Auth::user()->company_id);
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
            return ['success' => true,'credit'=>explode(' ',$result)[1]];
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
    /**
     * This function is sending message
     * @param $sms string
     * @param $tel string
     * @return object
     */
    public function sendSmsUz($sms,$tel)
    {
        # post url
        $url = "notify.eskiz.uz/api/message/sms/send";

        # make array
        $body = array(
            'mobile_phone' => $tel,
            'message' => $sms,
            'from' => self::$company->sms_titleUZ
        );
        
        # send function
        $response = self::ESKIZ($url,$body);

        # convert json to array
        $res = json_decode($response);

        # error code
        $arr = ['403','500'];

        # check if has error then one time update token
        if(isset($res->status_code) && in_array($res->status_code,$arr) && self::$loop != 1)
        {
            # update token
            self::updateTokenUz();

            # run self function
            return self::getBalanceUZ();
        }
        # return array
        return $res;
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
        CURLOPT_HTTPHEADER => array( 'Authorization: Bearer '.$API_KEY.'12'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $res = json_decode($response);
        $arr = ['403','500'];
        if(in_array($res->status_code,$arr) && self::$loop != 1)
        {
            self::updateTokenUz();
            return self::getBalanceUZ();
        }
        return json_decode($response);
    }

    public static function updateTokenUz()
    {
        self::$loop = 1;
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'notify.eskiz.uz/api/auth/login',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('email' => auth()->user()->company->api_emailUZ,'password' => auth()->user()->company->api_keyUZ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }
   
    static function ESKIZ($Url,$body = null)
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