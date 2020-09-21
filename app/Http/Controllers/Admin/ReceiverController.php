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
        $receiver = Receiver::where('phone','=',$request->phone)
        ->where('company_id','=',Auth::user()->company_id)
        ->get()->first();
        
        if(!$receiver)
        {
            $receiver = new Receiver();
        }
        //$address = explode(' ', $request->address);

    	$receiver->company_id = Auth::user()->company_id;
        $receiver->name     = strtoupper($request->name);
        $receiver->passport = strtoupper($request->passport);
        $receiver->phone    = strtoupper($request->phone);
        $receiver->address  = strtoupper($request->address);
        $receiver->save();

        return back()->with(['success'=>'Kaydedildi']);

    }

    public function edit(Request $request)
    {
    	$receiver = Receiver::find(decrypt($request->id));
  
    	return view('admin.receiver.edit',compact('receiver'));
    }


    public function update(Request $request)
    {
        $receiver = Receiver::find($request->id);
        
        $receiver->company_id = Auth::user()->company_id;
        $receiver->name     = strtoupper($request->name);
        $receiver->passport = strtoupper($request->passport);
        $receiver->phone    = strtoupper($request->phone);
        $receiver->address  = strtoupper($request->address);
        $receiver->save();
        return redirect()->route('receiver.index')->with(['success'=>'Güncellendi!']);

    }

    public function delete(Request $request)
    {

    	$receiver = Receiver::find($request->id); 
        $receiver->delete();
        return back()->with(['success'=>'Silindi!']);
    }

}
