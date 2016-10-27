<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProcurementDetail extends Model
{
    /**
     * [insertNewDetailProcurement]
     * @param  [type] $sale_id [int]
     * @param  [type] $data    [array]
     * @return [type]          [array]
     */
    public function insertNewDetailProcurement($proc_id,$products,$qtys,$prices)
    {
        foreach ($products as $i => $prod_id) {
            $products['procurement_id'] = $proc_id;
            $products['product_id'] = $prod_id;
            $products['price'] = $prices[$i];
            $products['qty'] = $qtys[$i];
            $productx[] = $products;
        }

        foreach ($productx as $ii => $val) {
            $new = new ProcurementDetail;
            $new->procurement_id = $val['procurement_id'];
            $new->product_id = $val['product_id'];
            $new->price = $val['price'];
            $new->qty = $val['qty'];

            if ($new->save()) {
                $updateStock = Product::find($new->product_id);
                $updateStock->stock = $updateStock->stock + $new->qty;
                $updateStock->save();
            }
        }

        return 'success';
    }
}
