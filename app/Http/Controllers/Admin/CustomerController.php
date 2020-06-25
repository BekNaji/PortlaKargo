<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Cargo;
use App\Helpers\Upload;

use Response;


class CustomerController extends Controller
{
    public function index()
    {
    	$customers  = Customer::all();
    	return view('admin.customer.index',compact('customers'));
    }

    public function store(Request $request)
    {
        
        if($this->checkPassport($request->passport))
        {

            $customer = Customer::where('passport',$request->passport)->get()->first();
            
        }else
        {
            $customer = new Customer();
        }
    	
        $customer->name     = strtoupper($request->name);
        $customer->surname  = strtoupper($request->surname);
        $customer->email    = strtolower($request->email);
        $customer->country     = strtoupper($request->country);
        $customer->city     = strtoupper($request->city);
        $customer->passport = strtoupper($request->passport);
        $customer->phone    = strtoupper($request->phone);
        $customer->address  = strtoupper($request->address);
        if($customer->passport_image != '')
        {
            $upload = new Upload();
            $customer->passpoert_image  = 
            $upload->imageUpload($customer->passpoert_image,'passport_images/');
        }
        $customer->save();

        
        
        if($request->cargoId != '')
        {
            $cargo = Cargo::find($request->cargoId);
            $cargo->sender_id = $customer->id;
            $cargo->save();
            return redirect()->route('cargo.show',encrypt($request->cargoId))
                             ->with(['success'=>'Kaydedildi']);
            
        }
            return redirect()->route('customer.index')->with(['success'=>'Kaydedildi']);
        

    }

    // edit function
    public function edit(Request $request)
    {
    	$customer = Customer::find(decrypt($request->id));
        $type = $request->type;
    	return view('admin.customer.edit',compact('customer','type'));
    }

    // edit function
    public function create(Request $request)
    {
        $cargoId = decrypt($request->id);
        return view('admin.customer.create',compact('cargoId'));
    }

    // update function
    public function update(Request $request)
    {
    	$customer = Customer::find($request->id);
        $customer->name     = strtoupper($request->name);
        $customer->surname  = strtoupper($request->surname);
        $customer->email    = strtolower($request->email);
        $customer->country  = strtoupper($request->country);
        $customer->city     = strtoupper($request->city);
        $customer->passport = strtoupper($request->passport);
        $customer->identity = strtoupper($request->identity);
        $customer->phone    = strtoupper($request->phone);
        $customer->address  = strtoupper($request->address);
        if($customer->passport_image != '')
        {
            $upload = new Upload();
            $customer->passport_image  = 
            $upload->imageUpload($customer->passport_image,'passport_images/');
        }
        
        $customer->save();

        if($request->request_type != '')
        {
            return redirect()
            ->route('cargo.edit',encrypt($request->request_type))
            ->with(['success'=>'Güncellendi!']);
            
        }

        return redirect()->route('customer.index')->with(['success'=>'Güncellendi!']);
    }

    // delete function
    public function delete(Request $request)
    {
    	
    	$customer = Customer::find($request->id);
        $customer->delete();
        return back()->with(['success'=>'Silindi!']);
    }

    public function get(Request $request)
    {

        $request = Customer::where('passport',$request->data)->get()->first();

    
        return response()->json(array($request),200);
    }

    public function checkPassport($request)
    {
        $sender = Customer::where('passport',$request)->get();
        if($sender->count() > 0)
        {
            return true;
           
        }else
        {
            return false;
        }
        
    }
}
