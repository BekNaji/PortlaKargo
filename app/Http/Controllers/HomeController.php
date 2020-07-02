<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;
use App\Models\CargoLog;
use App\Models\CargoStatus;
use App\Models\Company;

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

    public function contact()
    {
       
        return view('contact');
    }
    
}
