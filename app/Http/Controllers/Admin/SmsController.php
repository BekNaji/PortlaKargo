<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Company;
use App\Helpers\SendSMS;

class SmsController extends Controller
{

	
	public function index()
	{
		$company = Company::find(Auth::user()->company_id);
		$sms = new SendSMS();
		$balance = $sms->getBalance();
		$sms_title = $sms->getTitle();

		return view('admin.sms.index',compact('company','balance','sms_title'));
	}

	public function update(Request $request)
	{
		$company = Company::find(Auth::user()->company_id);
		$company->api_key = $request->api_key;
		$company->sms_title = $request->sms_title;
		$company->save();

		return back()->with(['success'=>'Güncellendi!']);
	}


	
}


