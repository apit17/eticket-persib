<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ClassementRequest as MyRequest;
use App\Models\Classement;
use App\Classes\Kissproof;
use View;
use Sentry;
use Datatables;
use Redirect;
use Image;
use Storage;
use App\File;

class ClassementController extends Controller
{
    public function __construct(Classement $classement)
    {
        $this->model = $classement;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Classement::all();
        return View::make('backend.classement.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = New Classement;

        // add image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800, 400)->save($location);

            $post->image = $filename;
        }

        if ($request->hasFile('topscore')) {
            $image1 = $request->file('topscore');
            $filename1 = time() . '.' . $image1->getClientOriginalExtension();
            $location1 = public_path('images1/' . $filename1);
            Image::make($image1)->resize(800, 400)->save($location1);

            $post->topscore = $filename1;
        }

        $post->save();

        if (!empty($post->id)) {
            session()->flash('flash_message','Classement has been sent');
            return Redirect::to('admin/classement');
        } else {
            session()->flash('flash_message_error','Sent classement failed');
            return Redirect::to('admin/classement');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Classement::find($id);

        if ($request->hasFile('image')) {
            // add the new image
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800, 400)->save($location);
            $oldfilename = $post->image;
            // update the data base
            $post->image = $filename;
            // delete the old image
            Storage::delete($oldfilename);

        }
        if ($request->hasFile('topscore')) {
            $image1 = $request->file('topscore');
            $filename1 = time() . '.' . $image1->getClientOriginalExtension();
            $location1 = public_path('images1/' . $filename1);
            Image::make($image1)->resize(800, 400)->save($location1);
            $oldfilename1 = $post->topscore;
            // update the data base
            $post->topscore = $filename1;
            // delete the old image
            Storage::delete($oldfilename1);
        }

        $post->save();

        if ($post->update()) {
            session()->flash('flash_message','Data has been updated');
            return Redirect::to('admin/classement');
        } else {
         session()->flash('flash_message_error','Update data failed');
            return Redirect::to('admin/classement');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
