<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

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
            ->select('sales.code','products.name','products.color','sale_details.price','sale_details.qty','customers.email')
            ->where('sale_details.sale_id',$id)
            ->get();
    }

    /**
     * [insertNewSale]
     * @param  [type] $data [array]
     * @return [type]       [array]
     */
    public function insertNewSale($data,$customer_id)
    {
        $productData = array_filter($data['products']);
        $qtyData = array_filter($data['qtys']);

        //get total price
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

        //set sender
        if ($data['sender'] == 1) {
            $sender = 'Kissproof.id';
        } else {
            $sender = $data['sender_other'];
        }

        $this->customer_id = $customer_id;
        $this->code = $this->generateSaleCode();
        $this->date = date('Y-m-d',strtotime($data['date']));
        $this->total = $grandTotal;
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
     * [generateSaleCode]
     * @param  integer $length [int]
     * @return [type]          [string]
     */
    public function generateSaleCode($length=6)
    {
        $str = "";
        $characters = array_merge(range('A','Z'), range('a','z'), range('1','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }

        return $str;
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
            ->select('sales.code','sales.date','sales.total','sales.address','sender','products.name as product','products.color','sale_details.price','sale_details.qty','customers.name as customer','customers.phone','customers.email')
            ->where('sale_details.sale_id',$id)
            ->get();
    }
}
