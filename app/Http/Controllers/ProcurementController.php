<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Classes\Kissproof;
use App\Models\Procurement;
use App\Models\ProcurementDetail;
use App\Models\Product;
use View;
use PDF;
use Sentry;
use Datatables;
use Redirect;
use Mail;

class ProcurementController extends Controller
{
    public function __construct(Procurement $model, ProcurementDetail $detail, Product $product)
    {
        $this->model = $model;
        $this->detail = $detail;
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('backend.procurement.index');
    }

    /**
     * [datatables procurement]
     * @return [type] [json]
     */
    public function datatables()
    {
        $results = $this->model->getAllProcurements();
        return Datatables::of($results)
            ->editColumn('date', function ($results) {
                return date('d M Y',strtotime($results->date));
            })
            ->editColumn('total', function ($results) {
                return Kissproof::priceFormater($results->total);
            })
            ->addColumn('action', function ($results) {
                return '<a data-id="'.$results->id.'" data-toggle="modal" data-target="#myModalDetail" class="btn btn-small btn-info detail" title="View Detail Transaction"><i class="menu-icon icon-table"></i>';
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
        $product = $this->product->getDropdownProcurement();
        return View::make('backend.procurement.create')->withProduct($product);
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
        $date = $post['date'];
        $products = array_filter($post['products']);
        $qtys = array_filter($post['qtys']);
        $prices = array_filter($post['prices']);

        $insertProcurement = $this->model->insertNewProcurement($date,$products,$qtys,$prices);
        $insertDetailProcurement = $this->detail->insertNewDetailProcurement($insertProcurement,$products,$qtys,$prices);

        if ($insertDetailProcurement == 'success') {
            session()->flash('flash_message','Procurement has been registered');
            return Redirect::to('admin/procurement');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $post = $request->all();
        $getDetail = $this->model->getDetailProcurement($post['id']);
        $header = '<table class="table table-striped table-bordered table-condensed">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>';

        $body = '';
        foreach ($getDetail as $i => $val) {
            $body .= '<tr><td>'.ucwords($val->name.' - '.$val->color).'</td><td>'.Kissproof::priceFormater($val->price).'</td><td>'.$val->qty.'</td></tr>';
        }

        $footer = '</table>';

        $table = $header.$body.$footer;

        $sent = (object) array(
            'order' => $getDetail[0]->code,
            'table' => $table
        );

        return json_encode($sent);
        die();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
