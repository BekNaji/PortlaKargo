<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Cargo;
use Auth;
use App\Helpers\SendSMS;

use Response;


class CustomerController extends Controller
{
    public function index()
    {
    	$customers  = Customer::where('company_id',Auth::user()->company_id)->get();
    	return view('admin.customer.index',compact('customers'));
    }

    public function store(Request $request)
    {
        $customer = Customer::where('phone','=',$request->phone)->get()->first();
        if(!$request->phone)
        {
            $customer = new Customer();
        }
    	$customer->company_id = Auth::user()->company_id;
        $customer->name     = strtoupper($request->name);
        $customer->phone    = strtoupper($request->phone);
        $customer->save();

        return redirect()->route('customer.index')->with(['success'=>'Kaydedildi']);
        

    }

    // edit function
    public function edit(Request $request)
    {
        
    	$customer = Customer::find(decrypt($request->id));
    	return view('admin.customer.edit',compact('customer'));
    }

    // update function
    public function update(Request $request)
    {
        
        $customer = Customer::find($request->id);
       
        $customer->name     = strtoupper($request->name);
        $customer->phone    = strtoupper($request->phone);
        $customer->save();

        return redirect()->route('customer.index')->with(['success'=>'Güncellendi!']);
    }

    // delete function
    public function delete(Request $request)
    {
    	
    	$customer = Customer::find($request->id);
        $customer->delete();
        return back()->with(['success'=>'Silindi!']);
    }

    public function sendSms(Request $request)
    {
        
        $ids = explode(',', $request->ids);
        
        foreach ($ids as $key => $id) 
        {
            $sender = Customer::find($id);

            if($sender->phone !='')
            {
                $sms = new SendSMS();
        
                $sms->sendSms($request->sms,$sender->phone);
            } 

        }
        return back()->with(['success'=>'SMS gönderildi!']);
    }
    

 

}
