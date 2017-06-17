<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\File;
use App\Jobs\SendPromotionJob;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Http\Requests;
use App\Models\Promotion;
use App\Models\Customer;
use App\Classes\Kissproof;
use View;
use Sentry;
use Datatables;
use Redirect;
use Image;
use Storage;

class PromotionController extends Controller
{
    public function __construct(Promotion $promotion, Customer $customer)
    {
        $this->model = $promotion;
        $this->customer = $customer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Promotion::all();
        return View::make('backend.promotion.index')->withPosts($posts);
    }

    /**
     * [datatables promotion]
     * @return [type] [json]
     */
    // public function datatables()
    // {
    //     $results = $this->model->getAllPromotion();
    //     return Datatables::of($results)
    //         ->editColumn('created_at', function ($results) {
    //             return date('d M Y H:i:s',strtotime($results->created_at));
    //         })
    //         ->editColumn('title', function ($results) {
    //             return ucwords($results->title);
    //         })
    //         ->editColumn('description', function ($results) {
    //             return strip_tags($results->description);
    //         })
    //         ->editColumn('date', function ($results) {
    //             return strip_tags($results->date);
    //         })
    //         ->addColumn('action', function ($results) {
    // return '<a href="/admin/admin='.$results->id.'/edit" class="btn btn-small btn-info edit" title="Edit"><i class="menu-icon icon-edit"></i> </a> <a class="btn btn-small btn-danger delete" data-id="'.$results->id.'" data-toggle="modal" data-target="#myModalDelete" title="Delete"><i class="menu-icon icon-remove"></i> </a> ';
    //         })
    //     ->make(true);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return View::make('backend.promotion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $post = $request->all();
        // $promotion = $this->model->createNewPromotion($post)->toArray();
        // $customer = $this->customer->getAllCustomers()->toArray();

        // foreach ($customer as $i => $val) {
        //     $email[] = array(
        //         'name' => ucwords($val['name']),
        //         'email' => $val['email'],
        //         'title' => $promotion['title'],
        //         'description' => $promotion['description'],
        //         'date' => $promotion['date'],
        //         // 'image1' => $promotion['image1']
        //         // 'image2' => $promotion['image2']
        //     );

        // }

        $post = New Promotion;

        $post->title = $request->title;
        $post->description = $request->description;
        $post->date = $request->date;

        if ($request->hasFile('image1')) {
            $image = $request->file('image1');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800, 400)->save($location);

            $post->image1 = $filename;
        }
        if ($request->hasFile('image2')) {
            $image1 = $request->file('image2');
            $filename1 = time() . '.' . $image1->getClientOriginalExtension();
            $location1 = public_path('images1/' . $filename1);
            Image::make($image1)->resize(800, 400)->save($location1);

            $post->image2 = $filename1;
        }

        $post->save();

        if (!empty($post->id)) {
            session()->flash('flash_message','Shedule has been sent');
            return Redirect::to('admin/promotion');
        } else {
            session()->flash('flash_message_error','Sent Shedule failed');
            return Redirect::to('admin/promotion');
        }

        // if (!empty($promotion['id'])) {

        //     dispatch(new SendPromotionJob($email));

        //     session()->flash('flash_message','Schedule information has been sent');
        //     return Redirect::to('admin/promotion');
        // } else {
        //     session()->flash('flash_message_error','Sent shedule information failed');
        //     return Redirect::to('admin/promotion');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $posts = Promotion::find($id);
    //     return view('backend.promotion.show')->withPosts($posts);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
         $post = Promotion::find($id);
         return view('backend.promotion.edit')->withPost($post);
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
        $post = Promotion::find($id);
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->date = $request->input('date');

        if ($request->hasFile('image1')) {
            // add the new image
            $image = $request->file('image1');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800, 400)->save($location);
            $oldfilename = $post->image1;
            // update the data base
            $post->image1 = $filename;
            // delete the old image
            Storage::delete($oldfilename);

        }
        if ($request->hasFile('image2')) {
            $image1 = $request->file('image2');
            $filename1 = time() . '.' . $image1->getClientOriginalExtension();
            $location1 = public_path('images1/' . $filename1);
            Image::make($image1)->resize(800, 400)->save($location1);
            $oldfilename1 = $post->image2;
            // update the data base
            $post->image2 = $filename1;
            // delete the old image
            Storage::delete($oldfilename1);
        }

        $post->save();
        

        // $post = $request->all();
        // $model = $this->model->getDetailPromotion($post['id']);
        // if (!empty($post['title'])) {
        //    $model->title = $post['title'];
        // }
        // if (!empty($post['description'])) {
        //     $model->description = $post['description'];
        // }
        // if (!empty($post['date'])) {
        //     $model->date = $post['date'];
        // }

        if ($post->update()) {
            session()->flash('flash_message','Data has been updated');
            return Redirect::to('admin/promotion');
        } else {
         session()->flash('flash_message_error','Update data failed');
            return Redirect::to('admin/promotion');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  object  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = $request->all();
        $model = $this->model->find($data['ID']);

        if ($model->forceDelete()) {
            session()->flash('flash_message', 'Schedule informatiom has been deleted');
            return Redirect::back();
        } else {
            session()->flash('flash_message_error', 'Delete shedule information failed');
            return Redirect::back();
        }
    }
}
