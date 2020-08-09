<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Helpers\Upload;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {
    	
    	return view('admin.profile.index');
    }

    public function store(Request $request)
    {
    	
    	// store code
    }

    // edit function
    public function edit(Request $request)
    {
    	
    	return view('admin.profile.edit');
    }

    // update function
    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);
        
        $validator = $request->
        validate(['name' => ['required', 'string', 'max:255']]);
        
        if($user->email != $request->email)
        {
            $request->
            validate(['email' => ['required', 'string', 'email', 'max:255','unique:users,email']]);
        }
    	$user = User::find($request->user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $upload = new  Upload();
        if($request->password != '')
        {
            $user->password = encrypt($request->password);        
        }
        if($request->file('image') != '')
        {
            $user->image = $upload->uploadImage($request->file('image'),'profile/');
        }
        $user->save();

        return back()->with(['success'=>'Güncellendi!']);
    }

    // delete function
    public function delete(Request $request)
    {
    	
    	// delete code
    }

    public function removeImage(Request $request)
    {
        
        $user = User::find(decrypt($request->id));

        if(file_exists($user->image))
        {
            unlink($user->image);
        }
        $user->image = '';
        $user->save();
        return back();
    }
}
