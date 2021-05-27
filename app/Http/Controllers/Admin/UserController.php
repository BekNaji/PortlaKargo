<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Helpers\Upload;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
use Illuminate\Validation\Rule;
use App\Models\Page;
use Permission;


class UserController extends Controller
{
   
    
    public function index()
    {
        if(!Permission::check('user-index'))
        {
            abort('419');
        }
        
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
        $validator = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
       
        
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
            $user->image = Upload::uploadImage($request->file('image'),'profile/');
        }

        $user->save();
        return back()->with(['success'=>'Kaydedildi!']);

    }

    // edit function
    public function edit(Request $request)
    {
    	$user = User::find(decrypt($request->id));
        $companies = Company::all();
    	return view('admin.user.edit',compact('user','companies'));
    }

    // update function
    public function update(Request $request)
    {
        $user = User::find($request->id);
        
        $validator = $request->
        validate(['name' => ['required', 'string', 'max:255']]);
        
        if($user->email != $request->email)
        {
            $request->
            validate(['email' => ['required', 'string', 'email', 'max:255','unique:users,email']]);
        }


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
            if(file_exists($user->image))
            {
                unlink($user->image);
            }
            $user->image = Upload::uploadImage($request->file('image'),'profile/');
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
            if(file_exists($user->image))
            {
                unlink($user->image);
            }
            $user->delete();
            $data['success'] = 'Kullanıcı Silindı!';
        }

        return back()->with($data);
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

    // permissions
    public function permission(Request $request)
    {
        $pages = Page::all();
        $user = User::find(decrypt($request->id));
        $user_permissions = explode(',', $user->permissions);
        
        return 
        view('admin.user.permission',
        compact('pages','user','user_permissions'));
    }

    public function permissionUpdate(Request $request)
    {
    
        $user = User::find($request->user_id);

        $user->permissions = $request->ids;
        $user->save();


        return back()->with(['success'=>'Güncellendi!']);
    }
}
