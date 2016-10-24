<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class SaleDetail extends Model
{
    protected $table = 'sale_details';

    /**
     * [insertNewDetailSale]
     * @param  [type] $sale_id [int]
     * @param  [type] $data    [array]
     * @return [type]          [array]
     */
    public function insertNewDetailSale($sale_id, $data)
    {
        $productData = array_filter($data['products']);
        $qtyData = array_filter($data['qtys']);

        foreach ($productData as $i => $prod_id) {
            $product = Product::find($prod_id);
            $products['sale_id'] = $sale_id;
            $products['product_id'] = $product->id;
            $products['price'] = $product->price;
            $products['qty'] = $qtyData[$i];
            $productx[] = $products;
        }

        foreach ($productx as $ii => $val) {
            $new = new SaleDetail;
            $new->sale_id = $val['sale_id'];
            $new->product_id = $val['product_id'];
            $new->price = $val['price'];
            $new->qty = $val['qty'];

            if ($new->save()) {
                $updateStock = Product::find($new->product_id);
                $updateStock->stock = $updateStock->stock - $new->qty;
                $updateStock->save();
            }
        }

        return 'success';
    }
}
