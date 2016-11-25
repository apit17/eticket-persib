<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Jobs\SendPromotionJob;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Http\Requests;
use App\Models\Promotion;
use App\Models\Customer;
use App\Classes\Kissproof;
use View;
use Sentry;
use Datatables;
use Redirect;

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
        return View::make('backend.promotion.index');
    }

    /**
     * [datatables promotion]
     * @return [type] [json]
     */
    public function datatables()
    {
        $results = $this->model->getAllPromotion();
        return Datatables::of($results)
            ->editColumn('created_at', function ($results) {
                return date('d M Y H:i:s',strtotime($results->created_at));
            })
            ->editColumn('title', function ($results) {
                return ucwords($results->title);
            })
            ->editColumn('description', function ($results) {
                return strip_tags($results->description);
            })
            ->addColumn('action', function ($results) {
                return '<a class="btn btn-small btn-danger delete" data-id="'.$results->id.'" data-toggle="modal" data-target="#myModalDelete" title="Delete"><i class="menu-icon icon-remove"></i> </a>';
            })
        ->make(true);
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
        $post = $request->all();
        $promotion = $this->model->createNewPromotion($post)->toArray();
        $customer = $this->customer->getAllCustomers()->toArray();

        foreach ($customer as $i => $val) {
            $email[] = array(
                'name' => ucwords($val['name']),
                'email' => $val['email'],
                'title' => $promotion['title'],
                'description' => $promotion['description']
            );
        }

        if (!empty($promotion['id'])) {
            $job = (new SendPromotionJob($email))->delay(1); //make queue delayed 1sec.
            $this->dispatch($job);

            session()->flash('flash_message','Promotion has been sent');
            return Redirect::back();
        } else {
            session()->flash('flash_message_error','Sent promotion failed');
            return Redirect::back();
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
        //
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
            session()->flash('flash_message', 'Promotion has been deleted');
            return Redirect::back();
        } else {
            session()->flash('flash_message_error', 'Delete Promotion failed');
            return Redirect::back();
        }
    }
}
