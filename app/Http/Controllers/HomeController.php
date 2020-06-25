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
        $settings = Company::find(1);
        return view('home',compact('settings'));
    }

    public function search(Request $request)
    {
        $settings = Company::find(1);
    	$key = strtoupper(trim($request->key));
        

    	if($key == '')
    	{
    		return redirect()->back()
    		->with(['warning'=>'Hata']);
    	}
    	
    	
    	$number = $key;

        $cargo = Cargo::where('number','=',$number)->get()->first();
        
        if($cargo->count() < 0)
        {
        	return redirect()->back()
    		->with(['warning'=>'Boyle bir kayit bulunamadı!']);
        }

        $cargoLogs = CargoLog::where('cargo_id',$cargo->id)->get();

        
        return view('result',compact('cargoLogs','settings'));
    }

    public function about()
    {
        $settings = Company::find(1);
        return view('about',compact('settings'));
    }

    public function contact()
    {
        $settings = Company::find(1);
        return view('contact',compact('settings'));
    }
}
