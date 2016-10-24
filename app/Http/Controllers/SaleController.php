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
            ->editColumn('customer', function ($results) {
                    return ucwords($results->customer);
            })
            ->editColumn('no_resi', function ($results) {
                    return strtoupper($results->no_resi);
            })
            ->editColumn('total', function ($results) {
                    return Kissproof::priceFormater($results->total);
            })
            ->addColumn('action', function ($results) {
                return '<a href="admin/sale/detail?id='.$results->id.'" class="btn btn-small btn-info" title="View Detail Transaction"><i class="menu-icon icon-edit"></i> </a>';
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
