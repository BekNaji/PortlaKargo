<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cargo;
use App\Models\Customer;
use App\Models\Receiver;
use App\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    

    public function index()
    {	
    	$cargoCount =Cargo::all()->count();

    	$userCount = User::all()->count();

    	$senderCount = Customer::all()->count();
    	$receiverCount = Receiver::all()->count();

    	return view('admin.dashboard.index',compact('cargoCount','userCount','senderCount','receiverCount'));
    }

    
}
