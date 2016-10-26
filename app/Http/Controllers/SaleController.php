<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Classes\Kissproof;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Product;
use App\Models\Customer;
use View;
use PDF;
use Sentry;
use Datatables;
use Redirect;

class SaleController extends Controller
{
    public function __construct(Sale $sale, SaleDetail $detail, Product $product, Customer $customer)
    {
        $this->sale = $sale;
        $this->detail = $detail;
        $this->product = $product;
        $this->customer = $customer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('backend.sale.index');
    }

    /**
     * [datatables sale]
     * @return [type] [json]
     */
    public function datatables()
    {
        $results = $this->sale->getAllSales();
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
                    return '<a href="#" class="btn btn-small btn-success addresi" title="Input Resi Number"><i class="menu-icon icon-pencil"></i> </a>';
                }
            })
            ->editColumn('total', function ($results) {
                return Kissproof::priceFormater($results->total);
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
        $product = $this->product->getDropdown();
        return View::make('backend.sale.create')->withProduct($product);
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
        $saleData = array_slice($post, 0, 6);
        $custData = array_slice($post, 6);

        $insertCustomer = $this->customer->insertNewCustomer($custData);
        $insertSale = $this->sale->insertNewSale($saleData, $insertCustomer);
        $insertDetailSale = $this->detail->insertNewDetailSale($insertSale, $saleData);

        if ($insertDetailSale == 'success') {
            session()->flash('flash_message','Sale has been registered');
            return Redirect::to('admin/sale');
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
        $getDetail = $this->sale->getDetailSale($post['id']);
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
     * print invoice order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function printInvoice(Request $request)
    {
        $id = $request->get('id');
        $data = $this->sale->getDataInvoice($id);
        $date = Kissproof::dateIndo($data[0]->date);

        $pdf = PDF::loadView('backend.sale.print', array("data" => $data, "date" => $date))->setPaper('A4')->setOrientation('portrait');

        return $pdf->download('Invoice#'.$data[0]->code.'.pdf');
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
