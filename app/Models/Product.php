<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    /**
     * [get all data products]
     * @return [type] [array]
     */
    public function getAllProduct()
    {
        return static::select('id', 'name', 'color', 'price', 'stock')->get();
    }

    /**
     * [Insert new data product]
     * @param  [type] $data [array]
     * @return [type]       [array]
     */
    public function createNewProduct($data)
    {
        $this->name = $data['name'];
        $this->color = $data['color'];
        $this->price = $data['price'];
        $this->stock = $data['stock'];

        if ($this->save()) {
            return $this;
        } else {
            return false;
        }
    }

    /**
     * [get data product by id]
     * @param  [type] $id [int]
     * @return [type]     [array]
     */
    public function getDetailProduct($id)
    {
        return $this->find($id);
    }

    /**
     * [getDropdown]
     * @return [type] [array]
     */
    public function getDropdown()
    {
        return static::select('id','name', 'color', 'stock')
            ->where('stock','<>',0)
            ->orderBy('name','ASC')->get();
    }
}
