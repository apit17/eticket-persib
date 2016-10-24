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
            return $check->id;
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
}
