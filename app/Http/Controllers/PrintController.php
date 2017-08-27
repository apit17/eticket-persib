<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Sale;
use App\Classes\Kissproof;
use View;
use PDF;
use Sentry;
use Datatables;
use Redirect;

class PrintController extends Controller
{
    public function __construct(Sale $customer)
    {
        $this->model = $customer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('backend.print_tiket.index');
    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function validatePrint(Request $req)
    {
    	$record = $this->model->whereNoResi($req->get('no_resi'))->first();
    	if (!is_null($record)) {
    		return \Response::json(["error"=>0, "data" => $record], 200);
    	} else {
    		return \Response::json(["error"=>1, "data" => $record], 200);
    	}
    }

    /**
     * [datatables customer]
     * @return [type] [json]
     */
    public function datatables()
    {
        $results = $this->model->getTicketPrinted();
        return Datatables::of($results)
	        ->editColumn('date', function ($results) {
                return date('d M Y',strtotime($results->date));
            })
            ->editColumn('customer', function ($results) {
                return ucwords($results->customer);
            })
            ->editColumn('no_resi', function ($results) {
                if (!empty($results->no_resi)) {
                    return strtoupper($results->no_resi);
                } else {
                    return '<a data-id="'.$results->id.'" data-toggle="modal" data-target="#myModalResi" class="btn btn-small btn-primary addResi" title="Input Resi Number"><i class="menu-icon icon-pencil"></i> </a>';
                }
            })
            ->editColumn('total', function ($results) {
                return Kissproof::priceFormater($results->total);
            })
            ->editColumn('status', function($results) {
            	switch ($results->status) {
            		case '0':
            			$res = 'Belum Dibayar';
            			break;
            		case '1':
            			$res = 'sudah Bayar, Belum diverifikasi';
            			break;
        			case '2':
            			$res = 'Sudah Dibayar dan terverifikasi';
            			break;
        			case '3':
            			$res = 'Sudah diprint';
            			break;
        			case '4':
            			$res = 'Cancel';
            			break;
            		default:
            			$res = ' ';
            			break;
            	}

            	return $res;
            })
            ->addColumn('action', function ($results) {
                return '<a data-id="'.$results->id.'" data-toggle="modal" data-target="#myModalDetail" class="btn btn-small btn-info detail" title="View Detail Transaction"><i class="menu-icon icon-table"></i> </a> <a href="/admin/sale/print?id='.$results->id.'" class="btn btn-small btn-danger print" title="Print Invoice"><i class="menu-icon icon-file"></i> </a>';
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$data['record'] = $this->model->join('customers', 'customers.id', '=', 'sales.customer_id')->join('sale_details', 'sale_details.sale_id', '=', 'sales.id')->join('products', 'products.id', '=', 'sale_details.product_id')->join('promotions', 'promotions.id', '=', 'sales.promotion_id')->where('sales.id',$id)->select('sales.*', 'customers.*', 'sale_details.*', 'products.*', 'promotions.*','customers.name as customer_name')->first();
    	if (!is_null($data['record'])) {
    		$this->model->whereId($id)->update(['status' => 3]);
    	return view('backend.print_tiket.print', $data);
    	} else {
    		return abort(404);
    	}
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
