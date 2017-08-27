<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = ['email','password','customer_id'];

    public function customer()
    {
    	return $this->hasOne(Customer::class,'id','customer_id');
    }
    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function createUser($dataPopulate)
    {
    	$status = \DB::transaction(function() use($dataPopulate){
	    	$customerId  = Customer::create($dataPopulate['customer'])->id;
    	    $userId = $this->create(array_merge(['customer_id'=>$customerId],$dataPopulate['user']))->id;
	    	return $userId;
    	});
    	return $status;
    }
}
