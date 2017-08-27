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
use Validator;

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
		$ticket = Product::select('id as ticket_id', 'name as category_tribun', 'color as match', 'price as price', 'stock as stock')->get();
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
		// DB::beginTransaction();
		try {
			// return Response::json(['message'=> 'naon we lah'], 205);
			$post = $request->all();
			$promotion = Promotion::find($request->promotion_id);
			\Log::info(["HASIIL.       "=>$post]);
			// dd(Sale::wherePromotionId($request->promotion_id))
			$data = $request->all();
			$rules = [
			'date' => 'required',
			'products' => 'required',
			'qtys' => 'required',
			'address' => 'required',
			'sender' => 'required',
			'name' => 'required',
			'noid' => 'required',
			'phone' => 'required',
			'city' => 'required',
			'user_id' => 'required',
			'promotion_id' => 'required'
			];

			$validation = Validator::make($data, $rules);

			If($validation->fails()) {
			return Response::json(['message'=>'Ada yg belum di isi']);
			} else {
			// Kodingan nu ayeuna 
				if (Sale::wherePromotionId($request->promotion_id)->whereCustomerId($request->user_id)->count() != 0) {
				\Log::info(["1.       "]);
			return Response::json(['message'=> 'Udah']);
			} elseif (date("Y-m-d") >= $promotion->start_date) {
			// \Log::debug($post);
				\Log::info(["2       "]);
		    $saleData = array_slice($post, 0, 11);
		    $custData = array_slice($post, 6);
		    // $insertCustomer = $this->customer->insertNewCustomer($custData);
		    $insertSale = $this->sale->insertNewSale($saleData, $request->user_id, $request->promotion_id, true);
		    $insertDetailSale = $this->detail->insertNewDetailSale($insertSale, $saleData, true);

			return Response::json(['message'=> 'Berhasil']);
			}  else {
				\Log::info(["3.       "]);
			return Response::json(['message'=> 'Belum']);
			}
			}
		} catch (\Exception $e) {
			\Log::error(['message'=>$e->getMessage(), 'line'=>$e->getLine(), 'file'=>$e->getFile()]);
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
		$schedule = Promotion::latest()->get();
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
		return Response::json(['data'=>['message'=>'Success', 'all'=>$classement], 200]);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function insertImageTransaction(Request $request)
	{
		$sales = new Sale;
		$salesSave = $sales->find($request->id);
		$salesSave->status = 1;
		// \Log::debug([$request->file('image')]);
		// return Response::json(['data'=> $request->file('image')], 200);
		// if ($request->hasFile('image')) {
  //           $image = $request->file('image');
            // $filename = time() . '.' . $image->getClientOriginalExtension();
            // $location = public_path('images/' . $filename);
  //           \Image::make($image)->resize(800, 400)->save($location);

  //           $salesSave->image = $filename;

  //       }
		if (!empty($request->get('image'))) {
			\Log::info($request->all());
			$baseImage = base64_decode($request->get('image'));
			$filename = date("Y-m-d") . ".jpg";
            $location = public_path('images/' . $filename);
            \Image::make($baseImage)->save($location);
    	    $salesSave->image = $filename;
		}
        $salesSave->save();
        return Response::json(['data'=> "Sukses"], 200);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function getTransaction(Request $request)
	{
		$transaction = Sale::whereCustomerId($request->get('user_id'))->with('promotion')->latest()->get();
		return Response::json(['data'=> $transaction], 200);
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
            return response()->json(['data'=>['message'=>'Success', 'user'=>$userData]]);
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

            \Log::info(["HASIIL.       "=>$status]);
            if($status)
            	return response()->json(['data'=>['message'=>'Success', 'user'=>$status], 200]);
            else
            	return response()->json(['data'=>'User salah']);
        } catch (\Exception $e) {
            \Log::error(['message'=>$e->getMessage(), 'line'=>$e->getLine(), 'file'=>$e->getFile()]);
            return response()->json(['data'=>'Error']);
        }
    }
}
