<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Company;
use App\Helpers\SendSMS;
use Storage;
use Log;
class SmsController extends Controller
{
	public static function LogIt($result,$comment)
    {
        $html = '/--------------'.$comment.'-----------------/'.PHP_EOL;
        $html .= $result.PHP_EOL;
        $html .= date('d-m-Y h-i-s A').PHP_EOL;
        return Log::info($html);
    }
	
	public function index()
	{
		
		$company = Company::find(Auth::user()->company_id);
		$sms = new SendSMS();
		$balance = $sms->getBalance();
		
		$sms_title = $sms->getTitle();
		
		$balanceUZ = (!isset($sms->getBalanceUZ()->status_code)) ? $sms->getBalanceUZ() : '0'; 
		if(isset($balanceUZ->data->balance) && !empty($balanceUZ->data->balance))
		{
			$balanceUZ = number_format($balanceUZ->data->balance);
			
		}
		
		return view('admin.sms.index',compact('company','balance','sms_title','balanceUZ'));
	}

	public function update(Request $request)
	{
		$company = Company::find(Auth::user()->company_id);
		if($request->countryId == 'tr')
		{
			$company->api_key 	= $request->api_key;
			$company->sms_title = $request->sms_title;
		}
		if($request->countryId == 'uz')
		{
			$sms = new SendSMS();
			$company->sms_titleUZ 	= $request->sms_titleUZ;
			$company->api_emailUZ 	= $request->api_emailUZ;
			$company->api_keyUZ 	= $request->api_keyUZ;
		}
		
		$company->save();

		

		return back()->with(['success'=>'Güncellendi!']);
	}
	
	
	


	
}


