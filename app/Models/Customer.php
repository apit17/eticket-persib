<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = ['customers_name','customer_ktp','customer_handphone','customer_email','customer_city','customer_address'];
    /**
     * [insertNewCustomer]
     * @return [type] [array]
     */
    public function insertNewCustomer($data)
    {
        // $check = $this->where('customer_email','=',$data['customer_email'])->first();

        // if (count($check) > 0) {
        //     $check->name = $data['name'];
        //     $check->customer_handphone = $data['customer_handphone'];
        //     $check->customer_city = $data['customer_city'];

        //     if ($check->save()) {
        //         return $check->id;
        //     } else {
        //         return false;
        //     }
        // } else {
            $this->customer_name = $data['name'];
            $this->customer_ktp= $data['ktp'];
            $this->customer_handphone = $data['phone'];
            $this->customer_email = $data['email'];
            $this->customer_city = $data['city'];
            $this->customer_address = $data['address'];
            $this->customer_password = \Hash::make($data['password']);

            if ($this->save()) {
                return $this->id;
            } else {
                return false;
            }
        // }
    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function getUserData($id)
    {
        $userData = $this->select('customers.customer_ktp','customers.customer_phone','customers.customer_email', $id)->get();
        return $userData;
    }

    /**
     * [get all data from customers table]
     * @return [type] [array]
     */
    public function getAllCustomers()
    {
        return $this->all();
    }

    public function checkingLogin($email, $password)
    {
        $result = false;
        $data = $this->whereCustomerEmail($email)->first();
        if (!is_null($data)) {
            if (\Hash::check($password, $data->customer_password)) {
                $result=true;
            }
        }

        return $result;
    }

}
