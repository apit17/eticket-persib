<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Classes\Kissproof;

class Sale extends Model
{
    protected $table = 'sales';

    /**
     * [get all data sales]
     * @return [type] [array]
     */
    public function getAllSales()
    {
        return $this->join('customers','sales.customer_id','=','customers.id')
            ->select('sales.*','customers.name as customer')
            ->get();
    }

    /**
     * [getDetailSale]
     * @param  [type] $id [int]
     * @return [type]     [array]
     */
    public function getDetailSale($id)
    {
        return $this->join('sale_details','sales.id','=','sale_details.sale_id')
            ->join('products','sale_details.product_id','=','products.id')
            ->join('customers','sales.customer_id','=','customers.id')
            ->select('sales.code','products.name','products.color','sale_details.price','sale_details.qty','customers.email', 'customers.noid')
            ->where('sale_details.sale_id',$id)
            ->get();
    }

    /**
     * [insertNewSale]
     * @param  [type] $data [array]
     * @return [type]       [array]
     */
    public function insertNewSale($data,$customer_id, $android = false)
    {
        

        //get total price
        if ($android) {
            $grandTotal = Product::find($data['products'])->price;
        } else {
            $productData = array_filter($data['products']);
        $qtyData = array_filter($data['qtys']);
            foreach ($productData as $i => $prod_id) {
            $product = Product::find($prod_id);
            $prices[] = $product->price;
        }
        foreach ($prices as $ii => $p) {
            $tot = $p*$qtyData[$ii];
            $total[] = $tot;
        }
        $grandTotal = 0;
        foreach ($total as $iii => $val) {
            $grandTotal += $val;
        }
        }

        //set sender
        if ($data['sender'] == 1) {
            $sender = 'E-Ticket';
        } else {
            $sender = $data['sender_other'];
        }

        $this->customer_id = $customer_id;
        $this->code = Kissproof::generateRandomCode();
        $this->date = date('Y-m-d',strtotime($data['date']));
        $this->total = $grandTotal;
        // $this->noid = $data['noid'];
        $this->address = $data['address'];
        $this->no_resi = '';
        $this->sender = $sender;

        if ($this->save()) {
            return $this->id;
        } else {
            return false;
        }
    }

    /**
     * [getDataInvoice]
     * @param  [type] $id [int]
     * @return [type]     [array]
     */
    public function getDataInvoice($id)
    {
        return $this->join('sale_details','sales.id','=','sale_details.sale_id')
            ->join('products','sale_details.product_id','=','products.id')
            ->join('customers','sales.customer_id','=','customers.id')
            ->select('sales.code','sales.date','sales.total','sales.address','sender','products.name as product','products.color','sale_details.price','sale_details.qty','customers.name as customer','customers.noid','customers.phone','customers.email')
            ->where('sale_details.sale_id',$id)
            ->get();
    }

    /**
     * [getSaleDateByPeriode]
     * @param  [type] $start [date]
     * @param  [type] $end   [date]
     * @return [type]        [array]
     */
    public function getSaleDataByPeriode($start, $end)
    {
        if (!empty($start) && !empty($end)) {
            return \DB::table('sales')
                ->selectRaw('date, sum(total) as amount')
                ->whereBetween('date', array($start.' 00:00:00', $end.' 23:59:59'))
                ->groupBy('date')
                ->lists('amount', 'date');
        } else {
            return \DB::table('sales')
                ->selectRaw('date, sum(total) as amount')
                ->whereMonth('date','=',date('m'))
                ->groupBy('date')
                ->lists('amount', 'date');
        }
    }
}
