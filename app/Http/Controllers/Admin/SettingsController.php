<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use Auth;
use App\Http\Requests\CheckCompanySettings;
use App\Helpers\Upload;

class SettingsController extends Controller
{
    
    
    public function index()
    {
    	return view('admin.settings.index',compact('company'));
    }

    public function store(Request $request)
    {
    	
    	// store code
    }

    // edit function
    public function edit(Request $request)
    {
    	
    	
    }

    // update function
    public function update(Request $request)
    {
    	$company = Company::find(Auth::user()->company_id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->instagram = $request->instagram;
        $company->phone = $request->phone;
        $company->second_phone = $request->second_phone;
        $company->cargo_letter = trim(strtoupper($request->cargo_letter));
        $company->about = $request->about;
        $company->contact = $request->contact;
        $company->address = $request->address;
        $company->other_address = $request->other_address;
        $company->bot_info = $request->bot_info;
        $company->cargo_row = $request->cargo_row;
        $options['socials'] = [
            'instagram' => $request->instagram,
            'facebook' => $request->facebook,
            'telegram' => $request->telegram, 
            'youtube' => $request->youtube, 
            'twitter' => $request->twitter, 
            'whatsapp' => $request->whatsapp];
        $company->options = json_encode($options);
        if($request->logo != '')
        {
            $company->logo  = Upload::uploadImage($request->logo,'logo/');
        }
        $company->save();

        return back()->with(['success'=>'Güncellendi!']);

    }

    // delete function
    public function delete(Request $request)
    {
    	
    	// delete code
    }
}
