<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Helpers\Upload;

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
}
