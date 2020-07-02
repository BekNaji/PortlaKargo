<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cargo;
use App\Models\Customer;
use App\Models\Receiver;
use App\User;
use Carbon\Carbon;
use Auth;

class DashboardController extends Controller
{
    

    public function index()
    {	
    	$cargoCount =Cargo::where('company_id',Auth::user()->company_id)->count();

    	$userCount = User::where('company_id',Auth::user()->company_id)->count();

    	$senderCount = Customer::where('company_id',Auth::user()->company_id)->count();
    	$receiverCount = Receiver::where('company_id',Auth::user()->company_id)->count();

    	return view('admin.dashboard.index',compact('cargoCount','userCount','senderCount','receiverCount'));
    }

    
}
