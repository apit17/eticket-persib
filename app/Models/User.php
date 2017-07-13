<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = ['email','password','customer_id'];

    public function customer()
    {
    	$this->belongsTo(Customer::class,'customer_id','id');
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
    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function scopeGetLogin($query,$email,$password)
    {
    	return $query->where('email',$email)->where('password',$password);
    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function getStatusLogin($email,$password)
    {
    	$result = $this->GetLogin($email, $password)->first();
    	return $result;
    }
}
