<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\User;
use Auth;

class CompanyController extends Controller
{
    
	public function register()
    {
        return view('admin.company.register');
    }

    public function status()
    {
        return view('admin.company.status');
    }

    public function store(Request $request)
    {
    	$validate = $request->validate([
    		'name' => 'required|max:255',
    		'email'=> 'required|max:255',
    		'phone'=> 'required|max:255'
    	]);

    	$company = new Company();
    	$company->name = $request->name;
    	$company->email = $request->email;
    	$company->phone = $request->phone;
    	$company->status = 0;

    	$company->save();
    	$user = User::find(Auth::user()->id);
    	$user->company_id = $company->id;
    	$user->save();

    	return redirect()->route('company.status')->with(['message'=>'Bizi tercih ettiğiniz için teşekkür ederiz! Kaydınız daha etkinleşmedi kısa sürede sizinde iletişime geçilecektir!']);
        
    }
}
