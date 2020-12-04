<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Cargo;
use App\Models\CargoLog;
use App\Models\CargoStatus;
use App\Models\Company;
use App\Models\Follower;
use App\Models\Customer;
use App\Models\Receiver;

class HomeController extends Controller
{
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    
    public function search(Request $request)
    {

    	$key = strtoupper(trim($request->key));
        

    	if($key == '')
    	{
    		return redirect()->back()
    		->with(['warning'=>'Hata']);
    	}
    	
    	
    	$number = $key;

        $cargo = Cargo::where('number','=',$number)->get()->first();
        
        if(!$cargo)
        {
        	return redirect()->back()
    		->with(['warning'=>'Boyle bir kayit bulunamadı!']);
        }

        $cargoLogs = CargoLog::where('cargo_id',$cargo->id)->get();

        
        return view('result',compact('cargoLogs','cargo'));
    }

    public function about()
    {
        
        return view('about');
    }

    public function price()
    {
        
        return view('price');
    }

    public function contact()
    {
       
        return view('contact');
    }

    public function saveEmail(Request $request)
    {

        if($request->email != '')
        {
            $follower = new Follower();
            $follower->email = $request->email;
            $follower->save();
            return back()->with(['success'=>'Email Kaydedildi!']);
            
        }
        abort('419');
        
    }

    // show save Phone Form page
    public function savePhoneForm(Request $request)
    {

        if($request->auth != md5('19950430'))
        {
            abort('404');
        }
        $auth = $request->auth;
        $user_id = $request->user_id;
        return view('savePhoneFomr',compact('auth','user_id'));
    }

    public function savePhone(Request $request)
    {
        // this is condition check auth token 
        if($request->auth != md5('19950430'))
        {
            abort('404');
        }
        
        // if has request user id will run following code
        if($request->user_id != '')
        {
            $customer = Customer::where('phone','=',$request->phone)
            ->get();

            $receiver = Receiver::where('phone','=',$request->phone)
            ->get();

            if($customer->count() != 0)
            {
                // Here, a user can be a customer of 2 3 companies and each company
                // It has its own telegram bot. All at once
                // I used a loop to send sms

                foreach ($customer->telegram_id as $value) 
                {
                    // get company  
                    $company = Company::find($value->company_id);
                    $telegram_url = $company->telegram_url;

                    // save telegram id 
                    $value->telegram_id = $request->user_id;
                    $value->save();

                    // send message to telegram bot
                    $response = Http::post($telegram_url.'sendMessage.php',
                    [
                    'id' => $value->telegram_id,
                    'message' => '<b>Telefon numaraniz kaydedildi!</b>',
                    ]);
                }
                
            }

            if($receiver->count() != 0)
            {
                // Here, a user can be a customer of 2 3 companies and each company
                // It has its own telegram bot. All at once
                // I used a loop to send sms

                foreach ($receiver as $key => $value) {

                    // get company and get telegrambot url
                    $company = Company::find($value->company_id);
                    $telegram_url = $company->telegram_url;

                    // save telegram id
                    $value->telegram_id = $request->user_id;
                    $value->save();

                    // send message to telegram bot
                    $response = Http::post($telegram_url.'sendMessage.php',
                        [
                        'id' => $value->telegram_id,
                        'message' => '<b>Telefon numarniz kaydedildi!</b>',
                        ]);
                }

                
            }

            return redirect()->route('home')
            ->with(['success'=>'Telefon numara kaydedildi!']);
        }

        abort('419');
    }


    
}
