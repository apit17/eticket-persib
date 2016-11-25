<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    /**
     * [insertNewCustomer]
     * @return [type] [array]
     */
    public function insertNewCustomer($data)
    {
        $check = $this->where('email','=',$data['email'])->first();

        if (count($check) > 0) {
            $check->name = $data['name'];
            $check->phone = $data['phone'];
            $check->city = $data['city'];

            if ($check->save()) {
                return $check->id;
            } else {
                return false;
            }
        } else {
            $this->name = $data['name'];
            $this->phone = $data['phone'];
            $this->email = $data['email'];
            $this->city = $data['city'];

            if ($this->save()) {
                return $this->id;
            } else {
                return false;
            }
        }
    }

    /**
     * [get all data from customers table]
     * @return [type] [array]
     */
    public function getAllCustomers()
    {
        return $this->all();
    }
}
