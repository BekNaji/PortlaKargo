<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function index()
    {
    	$pages = Page::all();

    	return view('admin.page.index',compact('pages'));
    }

    public function edit(Request $request)
    {
    	$page = Page::find(decrypt($request->id));

    	return view('admin.page.edit',compact('page'));
    }

    public function store(Request $request)
    {
    	$page = new Page();
    	$page->name = $request->name;
    	$page->title = $request->title;
    	$page->save();
    	return back()->with(['success'=>'Kaydedildi!']);
    }

    public function update(Request $request)
    {
    	$page = Page::find($request->id);
    	$page->name = $request->name;
    	$page->title = $request->title;
    	$page->save();
    	return redirect()->route('page.index')->with(['success'=>'Güncellendi!']);
    }

    public function delete(Request $request)
    {
    	$page = Page::find($request->id);
    	
    	$page->delete();

    	return back()->with(['success'=>'Silindi!']);
    }
}
