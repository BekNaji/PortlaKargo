<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Artisan;

class ClearController extends Controller
{
    public function index()
    {
        $exitCode = Artisan::call('cache:clear');
        $exitCode = Artisan::call('optimize');
        $exitCode = Artisan::call('route:cache');
        $exitCode = Artisan::call('route:clear');
        $exitCode = Artisan::call('view:clear');
        $exitCode = Artisan::call('config:cache');
        return back();
    }
}
