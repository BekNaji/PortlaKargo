<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Helpers\Upload;
use Auth;
class UserController extends Controller
{
    
    public function index()
    {
        if(Auth::user()->role == 'root')
        {
            $users = User::all();
        }else
        {
            $users = User::where('company_id',Auth::user()->company->id);
        }
    	return view('admin.user.index',compact('users'));
    }

    public function store(Request $request)
    {
    	$user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = encrypt($request->password);
        
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
    	return view('admin.user.edit',compact('user'));
    }

    // update function
    public function update(Request $request)
    {
    	$user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password != '')
        {
            $user->password = encrypt($request->password);
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
