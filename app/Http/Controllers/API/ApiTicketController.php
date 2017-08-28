<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Transaction;
use App\Models\Schedule;
use App\Models\Ticket;
use App\Models\SaleDetail;
use App\Classes\Kissproof;
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

			if($validation->fails()) {
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
		$schedule = Schedule::where('schedule_date_match', '>=', date("Y-m-d"))->latest()->get();
		return Response::json(['data'=> $schedule], 200);
	}

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function getDetailSchedule(Request $req)
    {
        $data = $req->all();
        if (isset($data['id'])) {
            $data = Schedule::find($data['id']);
            if (!is_null($data)) {
                if (count($data->tickets) != 0) {
                    return response()->json(['data'=>['message'=>'Berhasil Ambil Data', 'schedule_detail'=>$data]], 200);
                } else {
                    return response()->json(['data'=>['message'=>'belum ada data detail', 'schedule_detail' => $data]], 200);
                }
            } else {
                return response()->json(['data'=>['message'=>'tidak ada data']], 400);
            }
        } else {
            return response()->json(['data'=>['message'=>'tidak ada data']], 400);
        }
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
		return Response::json(['data'=>['message'=>'Success', 'all'=>$classement]], 200);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function insertImageTransaction(Request $request)
	{
        $validation = Validator::make($request->all(),['id'=>'required','image'=>'required']);
        if ($validation->fails()) {
            return response()->json(['data'=>['message' => $validation->errors()->first()]]);
        } else {
    		// $sales = new Sale;
    		$salesSave = Transaction::find($request->id);
            if (!is_null($salesSave)) {
        		$salesSave->transaction_resi_status = 1;
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
            	    $salesSave->transaction_proof_image = $filename;
        		}
                $salesSave->save();
                return Response::json(['data'=> "Sukses"], 200);
            } else {
                return Response::json(['data'=> "Gagal"], 400);
            }
            
        }
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function getTransaction(Request $request)
	{
		$transaction = Transaction::whereCustomerId($request->get('user_id'))->with('ticket')->latest()->get();
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
        $rules = [
            'email' => 'required|unique:customers,customer_email',
            'name' => 'required',
            'ktp' => 'required|unique:customers,customer_ktp|min:16|max:16',
            'phone' => 'required',
            'password' => 'required|min:6',
            'city' => 'required',
            'address' => 'required',
        ];

        $validation = Validator::make($req->all(), $rules);
        try {
            if ($validation->fails()) {
                return response()->json(['data'=>['message' => $validation->errors()->first()]], 400);
            } else {
                $id = (new Customer)->insertNewCustomer($req->all());
                // $data = $this->mappingInsert($req->toArray());
             //    $userData = (new User)->createUser($data);
                return response()->json(['data'=>['message'=>'Success', 'user'=>Customer::find($id)]]);
            }
        } catch (\Exception $e) {
            \Log::error(['message'=>$e->getMessage(), 'line'=>$e->getLine(), 'file'=>$e->getFile()]);
            return response()->json(['data'=>'Error']);
        }
    }

    public function customerLogin(Request $req) {
        \Log::info($req->toArray());
    	try {
            $user = new Customer;
            $status = $user->checkingLogin($req->email,$req->password);

            \Log::info(["HASIIL.       "=>$status]);
            if($status)
            	return response()->json(['data'=>['message'=>'Success', 'user'=>$status, 'user_data' => $user->whereCustomerEmail($req->email)->first()]], 200);
            else
            	return response()->json(['data'=>'User salah'], 400);
        } catch (\Exception $e) {
            \Log::error(['message'=>$e->getMessage(), 'line'=>$e->getLine(), 'file'=>$e->getFile()]);
            return response()->json(['data'=>'Error']);
        }
    }

    public function bookingSchedule(Request $req)
    {
        $data = $req->all();
        $validation = Validator::make($data, ['user_id'=>'required','ticket_id'=>'required']);
        if ($validation->fails()) {
            return response()->json(['data'=>['message' => $validation->errors()->first()]]);
        } else {
            $customer = Customer::find($data['user_id']);
            $ticket = Ticket::find($data['ticket_id']);
            if (!is_null($customer) && !is_null($ticket)) {
                if (date("Y-m-d") < date("Y-m-d", strtotime($ticket->schedule->schedule_start_date))) {
                    return response()->json(['data' => ['message' => 'Tiket Belum Tersedia']]);
                } else {
                    $transactionExist = Transaction::whereCustomerId($data['user_id'])->whereScheduleId($ticket->schedule_id)->first();
                    if (!is_null($transactionExist)) {
                        return response()->json(['data' => ['message' => 'Anda telah memesan tiket Pertandingan ini']]);
                    } else {
                        $transaction = new Transaction;
                        $transaction->customer_id = $data['user_id'];
                        $transaction->ticket_id = $data['ticket_id'];
                        $transaction->schedule_id = $ticket->schedule_id;
                        $transaction->transaction_code = Kissproof::generateRandomCode();
                        $transaction->transaction_date = date("Y-m-d H:i:s");
                        $transaction->transaction_price = $ticket->ticket_price+5000;
                        $transaction->save();
                        return response()->json(['data' => ['message' => 'Berhasil Book Ticket, Segara lakukan pembayaran karena kami tidak akan mengkeep ticket yang anda book sebelum dibayar']]);
                    }
                }
            } else {
                return response()->json(['data' => ['message' => 'data tidak ditemukan']], 400);
            }
        }
    }
}
