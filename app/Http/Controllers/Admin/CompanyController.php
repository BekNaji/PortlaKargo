<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\User;
use Auth;

class CompanyController extends Controller
{

    public function index()
    {
        $companies = Company::all();
        return view('admin.company.index',compact('companies'));
    }
    public function edit(Request $request)
    {
        $company = Company::find(decrypt($request->id));
        return view('admin.company.edit',compact('company'));
    }
	public function register()
    {
        return view('admin.company.register');
    }

    public function status()
    {
        return view('admin.company.status');
    }

    public function apply(Request $request)
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

        return redirect()->route('company.index')->with(['message'=>'Eklendi']);
        
    }

    public function update(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|max:255',
            'email'=> 'required|max:255',
            'phone'=> 'required|max:255'
        ]);

        $company = Company::find($request->id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->phone = $request->phone;
        $company->status = $request->status;

        $company->save();
    
        return redirect()->route('company.index')->with(['success'=>'Güncellendi!']);
        
    }

    public function delete(Request $request)
    {
        
        $company = Company::find($request->id);
        $company->delete();
    
        return redirect()->route('company.index')->with(['success'=>'Silindi!']);
        
    }
}
