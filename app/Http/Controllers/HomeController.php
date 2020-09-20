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
        if($request->auth != md5('19950430'))
        {
            abort('404');
        }
        // dd($request);
        if($request->user_id != '')
        {
            $customer = Customer::where('phone','=',$request->phone)
            ->get();

            $receiver = Receiver::where('phone','=',$request->phone)
            ->get();

           

            if($customer->count() == 0)
            {
                
                if($receiver->count() == 0)
                {
                  return redirect()
                    ->route('save.phone.form',[$request->auth,$request->user_id])
                    ->with(['warning'=>'Telefon nunamara bulunamadi!']);  
                }else
                {   
                    foreach ($receiver->telegram_id as $value) 
                    {
                        $value->telegram_id = $request->user_id;
                        $value->save();
                    }
                    

                    $response = Http::post('https://beknaji.online/telegrambot/sendMessage.php',
                    [
                    'id' => $receiver[0]->telegram_id,
                    'message' => '<b>Telefon numaraniz kaydedildi!</b>',
                    ]);
                }
                
            }else
            {
                
                foreach ($customer as $key => $value) {

                    $value->telegram_id = $request->user_id;
                    $value->save();
                }
                // $customer->telegram_id = $request->user_id;
                // $customer->save();

                $response = Http::post('https://beknaji.online/telegrambot/sendMessage.php',
                [
                'id' => $customer[0]->telegram_id,
                'message' => '<b>Telefon numarniz kaydedildi!</b>',
                ]);
            }
            
            return redirect()->route('home')
            ->with(['success'=>'Telefon numara kaydedildi!']);
        }

        abort('419');
    }


    
}
