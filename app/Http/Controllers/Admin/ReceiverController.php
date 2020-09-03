<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Receiver;
use App\Models\Cargo;
use Auth;

class ReceiverController extends Controller
{
    public function index()
    {
    	$receivers  = Receiver::where('company_id',Auth::user()->company_id)->get();
    	return view('admin.receiver.index',compact('receivers'));
    }

    public function store(Request $request)
    {
        
        
        if($this->checkPassport($request->passport))
        {
            $receiver = Receiver::where('passport',$request->passport)->get()->first();
            
        }else
        {
            $receiver = new Receiver();
        }
    	$receiver->company_id = Auth::user()->company_id;
        $receiver->name     = strtoupper($request->name);
        $receiver->surname  = strtoupper($request->surname);
        $receiver->email    = strtolower($request->email);
        $receiver->country  = strtoupper($request->country);
        $receiver->city     = strtoupper($request->city);
        $receiver->passport = strtoupper($request->passport);
        $receiver->phone    = strtoupper($request->phone);
        $receiver->address  = strtoupper($request->address);
        if($request->passport_image != '')
        {
            $upload = new Upload();
            $receiver->passport_image  = 
            $upload->imageUpload($request->passport_image,'passport_images/');
        }

        $receiver->save();

       

        if($request->cargoId != '')
        {
            $cargo = Cargo::find($request->cargoId);
            $cargo->receiver_id = $receiver->id;
            $cargo->save();
            return redirect()->route('cargo.show',encrypt($cargo->id))
                             ->with(['success'=>'Kaydedildi']);
        }
        return back()->with(['success'=>'Kaydedildi']);

    }

    public function edit(Request $request)
    {
    	$receiver = Receiver::find(decrypt($request->id));
        $type = $request->type;
    	return view('admin.receiver.edit',compact('receiver','type'));
    }

    public function create(Request $request)
    {
        $type = $request->type;
        return view('admin.receiver.create',compact('cargoId'));
    }


    public function update(Request $request)
    {
    	$receiver = Receiver::find($request->id);
        $receiver->name     = strtoupper($request->name);
        $receiver->surname  = strtoupper($request->surname);
        $receiver->email    = strtolower($request->email);
        $receiver->country     = strtoupper($request->country);
        $receiver->city     = strtoupper($request->city);
        $receiver->passport = strtoupper($request->passport);
        $receiver->phone    = strtoupper($request->phone);
        $receiver->address  = strtoupper($request->address);
        if($receiver->passpoert_image != '')
        {
            $upload = new Upload();
            $receiver->passport_image  = 
            $upload->imageUpload($receiver->passpoert_image,'passport_images/');
        }
        $receiver->save();

        if($request->request_type != '')
        {
            return redirect()->route('cargo.show',encrypt($request->request_type))
            ->with(['success'=>'Güncellendi!']);
        }
        return redirect()->route('receiver.index')->with(['success'=>'Güncellendi!']);

    }

    public function delete(Request $request)
    {
    	$receiver = Receiver::find($request->id);
    	if(!$receiver->delete())
        {
            return back()->with(['warning'=>'Bilgileri silinemez. Silmek için Sistem yöneticisine başvurun']);
        }else
        {
            
            return back()->with(['success'=>'Silindi!']);
        }
    	
    	
    }

    public function get(Request $request)
    {
        $request = Receiver::where('passport',$request->data)->get()->first();

    
        return response()->json(array($request),200);
    }
    public function checkPassport($request)
    {
        $receiver = Receiver::where('passport',$request)->get();
        if($receiver->count() > 0)
        {
            return true;
        }else{
            return false;
        }
        
    }
}
