<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Web;

/*
 *  This class is responsible for the settings of the website (Developer: Bekzod Najmiddinov)
 */
class WebController extends Controller
{
    /*
     *  Setting page
     *  @return response
     */
    public function header()
    {
        # get header settings
        $web = Web::where('type','=','header')->first();

        # response view page
        return view('admin.web.header',compact('web'));
    }

    /*
     *  Store header settings
     *  @param $request array
     *  @return redirect
     */
    public function headerStore(Request $request)
    {
        # validate request
        $request->validate(['title' => 'required|max:255','description'=>'required|max:255']);

        # get header settings. If has not settings then create new
        if(!Web::where('type','=','header')->first())
        {
            Web::create([
                'title'=>$request->title, 
                'description'=>$request->description,
                'type'=>'header']);
        }
        # header settings has then update it
        else
        {
            Web::where('type','=','header')->first()->update([
                'title'=>$request->title, 
                'description'=>$request->description]);
        }

        # return back with message
        return back()->with(['message'=>__('Successfully Saved')]);
    }

    /*
     *  Render about page
     *  @return response
     */
    public function about()
    {
        $web = Web::where('type','=','about')->first();
        return view('admin.web.about',compact('web'));
    }

    /*
     *  Store about settings
     *  @param $request array
     *  @return redirect
     */
    public function aboutStore(Request $request)
    {
        # validate action
        $request->validate(['description'=>'required|max:10000']);

        # create new if has not about 
        if(!Web::where('type','=','about')->first())
        {
            $image = '';

            if($request->has('image'))
            {   
                # upload image
                $image = Web::uploadImage($request->file('image'),'web');
            }
            

            # create action
            Web::create(['description'=>$request->description, 'image'=>$image, 'type'=>'about']);
        }
        # update action
        else
        {
            # get type = about 
            $web = Web::where('type','=','about')->first();

            # set description
            $web->description = $request->description;

            # if has image then upload and set path
            if($request->has('image'))
            {   
                # set path and upload image
                $web->image = Web::uploadImage($request->file('image'),'web');
            }

            # save actions
            $web->save(); 
        }
        # redirec back
        return back()->with(['message' => __('Successfully Saved')]);
    }
}
