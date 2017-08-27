<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ProductRequest as MyRequest;
use App\Models\Product;
use App\Classes\Kissproof;
use View;
use Sentry;
use Datatables;
use Redirect;

class ProductController extends Controller
{
    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('backend.product.index');
    }

    /**
     * [datatables product]
     * @return [type] [json]
     */
    public function datatables()
    {
        $results = $this->model->getAllProduct();
        return Datatables::of($results)
            ->editColumn('name', function ($results) {
                    return ucwords($results->name);
            })
            // ->editColumn('color', function ($results) {
            //         return ucwords($results->color);
            // })
            ->editColumn('price', function ($results) {
                    return Kissproof::priceFormater($results->price);
            })
            ->addColumn('action', function ($results) {
                return '<a class="btn btn-small btn-info edit" data-id="'.$results->id.'" data-toggle="modal" data-target="#myModalAdd" title="Edit"><i class="menu-icon icon-edit"></i> </a> <a class="btn btn-small btn-danger delete" data-id="'.$results->id.'" data-toggle="modal" data-target="#myModalDelete" title="Delete"><i class="menu-icon icon-remove"></i> </a>';
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
        $insert = $this->model->createNewProduct($post);
        if (!empty($insert->id)) {
            session()->flash('flash_message','Ticket has been sent');
            return Redirect::back();
        } else {
            session()->flash('flash_message_error','Sent Ticket failed');
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
    public function edit(Request $request)
    {
        $post = $request->all();
        $data = $this->model->getDetailProduct($post['id']);
        return json_encode($data);
        exit;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $post = $request->all();
        $model = $this->model->getDetailProduct($post['id']);
        if (!empty($post['name'])) {
            $model->name = $post['name'];
        }
        // if (!empty($post['color'])) {
        //     $model->color = $post['color'];
        // }
        if (!empty($post['price'])) {
            $model->price = $post['price'];
        }
        if (!empty($post['stock'])) {
            $model->stock = $post['stock'];
        }

        if ($model->update()) {
            session()->flash('flash_message','Data has been updated');
            return Redirect::back();
        } else {
            session()->flash('flash_message_error','Update data failed');
            return Redirect::back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = $request->all();
        $model = $this->model->find($data['ID']);

        if ($model->forceDelete()) {
            session()->flash('flash_message', 'Ticket has been deleted');
            return Redirect::back();
        } else {
            session()->flash('flash_message_error', 'Delete Ticket failed');
            return Redirect::back();
        }
    }
}
