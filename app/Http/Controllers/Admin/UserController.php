<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Helpers\Upload;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkact');
    }
    
    public function index()
    {
        if(Auth::user()->role == 'root')
        {
            $users = User::all();
            
        }else
        {
            $users = User::where('company_id',Auth::user()->company->id)->get();
        }
        $companies = Company::all();

    	return view('admin.user.index',compact('users','companies'));
    }

    public function store(Request $request)
    {
        
    	$user = new User();
        if(Auth::user()->role == 'root')
        {
            $user->company_id = $request->company_id;
        }
        else
        {
            $user->company_id = Auth::user()->company_id;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
    
        if($request->file('image') != '')
        {
            $upload = new Upload;
            $user->image = $upload->uploadImage($request->file('image'),'profile/');
        }

        $user->save();
        return back()->with(['success'=>'Kaydedildi!']);

    }

    // edit function
    public function edit(Request $request)
    {
    	$user = User::find($request->id);
        $companies = Company::all();
    	return view('admin.user.edit',compact('user','companies'));
    }

    // update function
    public function update(Request $request)
    {
    	$user = User::find($request->id);
        if(Auth::user()->role == 'root')
        {
            $user->company_id = $request->company_id;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        if($request->password != '')
        {
            $user->password = Hash::make($request->password);
        }
        if($request->file('image') != '')
        {
            $upload = new Upload;
            $user->image = $upload->uploadImage($request->file('image'),'profile/');
        }

        $user->save();
        return redirect()->route('user.index')->with(['success'=>'Güncellendi!']);
    }

    // delete function
    public function delete(Request $request)
    {
    	if($request->id != '')
        {
            $user = User::find($request->id);
            $user->delete();
            $data['success'] = 'Kullanıcı Silindı!';
        }

        return back()->with($data);
    }
}
