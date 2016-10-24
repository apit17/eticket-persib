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
            ->orderBy('sales.date','DESC')
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
        foreach ($prices as $m => $p) {
            foreach ($qtyData as $n => $q) {
                $tot[] = $p*$q;
            }
            $total[] = $tot;
        }
        $grandTotal = 0;
        foreach ($total[0] as $ii => $val) {
            $grandTotal += $val;
        }

        //set sender
        if ($data['sender'] == 1) {
            $sender = 'Kisproof.id';
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
}
