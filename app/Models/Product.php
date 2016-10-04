<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function get_detail_data($id){
        $result = Product::join('departments','products.department_id','=','departments.id')
            ->select('products.*','departments.name as department_name','departments.address as location')
            ->where('products.id',$id)
            ->first();

        return $result;
    }
}
