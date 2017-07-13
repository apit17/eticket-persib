<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Customer;
use App\Models\Promotion;
use App\Models\User;
use App\Models\Classement;
use Response;
use Input;
use DB;

class ApiTicketController extends Controller
{
	public function __construct(Sale $sale, SaleDetail $detail, Product $product, Customer $customer)
    {
        $this->sale = $sale;
        $this->detail = $detail;
        $this->product = $product;
        $this->customer = $customer;
        
    }
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function getTicket()
	{
		$ticket = Product::select('id as ticket_id', 'name as category_tribun', 'color as match', 'price as price')->get();
		return Response::json(['data'=> $ticket], 200);

	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function bookingTicket(Request $request)
	{
		DB::beginTransaction();
		try {
			$post = $request->all();
		    $saleData = array_slice($post, 0, 6);
		    $custData = array_slice($post, 6);
		    // $insertCustomer = $this->customer->insertNewCustomer($custData);
		    $insertSale = $this->sale->insertNewSale($saleData, $request->userId, true);
		    $insertDetailSale = $this->detail->insertNewDetailSale($insertSale, $saleData, true);
			DB::commit();
			return Response::json(['message'=> 'Hore, Berhasil'], 200);
		} catch (\Exception $e) {
			\Log::info("ERROR :: " . $e->getMessage() . " \n THISINI " . $e->getLine());
			DB::rollBack();
			return Response::json(['message'=> 'Hore, Gagal'], 400);
		}
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function getSchedule()
	{
		$schedule = Promotion::all();
		return Response::json(['data'=> $schedule], 200);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function getClassement()
	{
		$classement = Classement::all();
		return Response::json(['data'=> $classement], 200);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function getUserData(Request $request)
	{
		// $id = $request->get('id');
  //       $data = $this->customer->getUserData($id);
		// return Response::json(['data'=> $user], 200);
		$userId = $request->input(24);
		$result = DB::select('select * from customers where id = 24');
		return Response::json(['data'=> $result], 200);
	}

	public function mappingInsert($data)
	{
		$result['customer'] = $data;
		$result['user'] = ['email' => $data['email'],'password'=>($data['password'])];
		unset($result['customer']['password']);
		return ($result);
	}

	public function customerSignUp(Request $req)
    {
        try {
        	$data = $this->mappingInsert($req->toArray());
            $userData = (new User)->createUser($data);
            return response()->json(['data'=>['message'=>'Success', 'user_id'=>$userData]]);
        } catch (\Exception $e) {
            \Log::error(['message'=>$e->getMessage(), 'line'=>$e->getLine(), 'file'=>$e->getFile()]);
            return response()->json(['data'=>'Error']);
        }
    }

    public function customerLogin(Request $req) {
    	            \Log::info($req->toArray());

    	try {
            $user = new User;
            $status = $user->getStatusLogin($req->email,$req->password);

            if($status)
            	return response()->json(['data'=>['message'=>'Success', 'user_id'=>$status]]);
            else
            	return response()->json(['data'=>'User salah']);
        } catch (\Exception $e) {
            \Log::error(['message'=>$e->getMessage(), 'line'=>$e->getLine(), 'file'=>$e->getFile()]);
            return response()->json(['data'=>'Error']);
        }
    }
}
