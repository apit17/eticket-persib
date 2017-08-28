<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Classes\Kissproof;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Customer;
use View;
use PDF;
use Sentry;
use Datatables;
use Redirect;
use Mail;

class SaleController extends Controller
{
    public function __construct(Customer $customer, Transaction $transaction)
    {
        $this->customer = $customer;
        $this->transaction = $transaction;
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
        return Datatables::of($this->transaction->all())
            ->editColumn('created_at', function ($results) {
                return date('d M Y',strtotime($results->created_at));
            })
            ->editColumn('customer_id', function ($results) {
                return ucwords(strtolower($results->customer->customer_name));
            })
            ->editColumn('transaction_resi_number', function ($results) {
                if (empty($results->transaction_proof_image)) {
                    return 'Belum Upload Image';
                } elseif (!empty($results->transaction_resi_number)) {
                    return strtoupper($results->transaction_resi_number);
                } else {
                    return '<a data-id="'.$results->id.'" data-toggle="modal" data-target="#myModalResi" class="btn btn-small btn-primary addResi" title="Input Resi Number"><i class="menu-icon icon-pencil"></i> </a>';
                }
            })
            ->editColumn('transaction_price', function ($results) {
                return Kissproof::priceFormater($results->transaction_price);
            })
            ->editColumn('transaction_resi_status', function($results) {
                switch ($results->transaction_resi_status) {
                    case '0':
                        $res = 'Belum Dibayar';
                        break;
                    case '1':
                        $res = 'Sudah Bayar, Belum diverifikasi';
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
            ->addColumn('address', function($q){
                return $q->customer->customer_address;
            })
            ->addColumn('action', function ($results) {
                $html= '<a data-id="'.$results->id.'" class="btn btn-small btn-info detail" title="View Detail Transaction"><i class="menu-icon icon-table"></i> </a>';
                if ($results->transaction_resi_status == 2) {
                    $html .= '<a href="/admin/sale/print?id='.$results->id.'" class="btn btn-small btn-danger print" title="Print Invoice"><i class="menu-icon icon-file"></i> </a>';
                }
                return $html;
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
        $product = $this->product->getDropdownSale();
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
        // dd($post);
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
        $getDetail = Transaction::find($request->id);
        $header = '<table class="table table-striped table-bordered table-condensed">
            <tr>
                <th>Category Ticket</th>
                <th>Price</th>
            </tr>';
        $ticketDetail = $getDetail->ticket;
        $body = '<tr><td>' . $ticketDetail->ticket_name . '</td><td>Rp. ' . number_format($getDetail->transaction_price) . '</td></tr>';

        $footer = '</table>';
        // $record = $this->sale->find($post['id']);

        if (!empty($getDetail->transaction_proof_image)) {
            $footer .= '<br><center><h2>Bukti Pembayaran</h2><img src="' . asset('images') . '/'. $getDetail->transaction_proof_image . '" width="50%"></center>';
        }

        $table = $header.$body.$footer;

        $sent = (object) array(
            'order' => $getDetail->transaction_code,
            'table' => $table
        );

        return json_encode($sent);
        die();
    }

    /**
     * print invoice order.
     *
     * @param  array  $request
     * @return \Illuminate\Http\Response
     */
    public function printInvoice(Request $request)
    {
        $id = $request->get('id');
        // $data = $this->sale->getDataInvoice($id);
        $data = Transaction::find($id);
        $date = Kissproof::dateIndo($data->transaction_date);
        $pdf = PDF::loadView('backend.sale.print', array("data" => $data, "date" => $date))->setPaper('A4')->setOrientation('portrait');

        return $pdf->download('Invoice#'.$data->transaction_code.'.pdf');
    }

    /**
     * update resi number in sale's data.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function addResiNumber(Request $request)
    {
        $post = $request->all();
        $sale = Transaction::find($post['saleID']);
        $sale->transaction_resi_number = $post['no_resi'];
        $sale->transaction_resi_status = 2;
        $sale->save();

        $ticket = Ticket::find($sale->ticket_id);
        $ticket->ticket_stock = $ticket->ticket_stock - 1;
        $ticket->save();

        if (!empty($post['is_send_email'])) {
            $customer = $this->customer->find($sale->customer_id);
            // dd($customer);
            $insert = array (
                'email' => $customer->customer_email,
                'name'  => $customer->customer_name,
                'resi'  => strtoupper($sale->transaction_resi_number)
            );
            Mail::send('email.sendResiNumber', $insert, function ($message) use ($insert) {
                $message->subject("E-Ticket Persib - Informasi Nomor Resi [Anda tidak perlu membalas email ini]");
                $message->from('apitgilang1994@gmail.com', 'E-Ticket Persib');
                $message->to($insert['email']);
            });
        }
        session()->flash('flash_message','Resi Number has been registered');
        return Redirect::to('admin/sale');
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
