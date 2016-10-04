<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use View;
use Sentry;
use Datatables;
use Redirect;
use App\Models\Department;
use App\Models\Product;

class AdminController extends Controller
{
    /*
     * Dashboard page
     */
    public function index()
    {
        if (Sentry::check()) {
            return View::make('backend.dashboard');
        } else {
            return View::make('backend.login');
        }
    }

    /*
     * Departement - Show Index
     */
    public function department_show()
    {
        if (Sentry::check()) {
            return View::make('backend.department');
        } else {
            return View::make('backend.login');
        }
    }

    /*
     * Departement - DataTables Serverside
     */
    public function department_data()
    {
        $results = Department::all();
        return Datatables::of($results)
            ->addColumn('action', function ($results) {
                if (Sentry::check()) {
                    return '<a class="btn btn-small btn-info edit" data-id="'.$results->id.'" data-toggle="modal" data-target="#myModalAdd" title="Edit"><i class="menu-icon icon-edit"></i> </a> <a class="btn btn-small btn-danger delete" data-id="'.$results->id.'" data-toggle="modal" data-target="#myModalDelete" title="Delete"><i class="menu-icon icon-remove"></i> </a>';
                } else {
                    return '';
                }
            })
        ->make(true);
    }

    /*
     * Departement - Store
     */
    public function department_store(Request $request)
    {
        if (Sentry::check()) {
            $data = $request->all();
            $check_name = Department::where('name','ilike','%'.$data['name'])->get();
            $check_address = Department::where('address','ilike','%'.$data['address'])->get();
            if (count($check_name) > 0 && count($check_address) > 0) {
                session()->flash('flash_message_error','You can not entry this data again');
                return Redirect::back();
            } else {
                $model = new Department;
                $model->name = $data['name'];
                $model->address = $data['address'];
                if ($model->save()) {
                    session()->flash('flash_message','Data has been registered');
                    return Redirect::back();
                } else {
                    session()->flash('flash_message_error','Register data failed');
                    return Redirect::back();
                }
            }
        } else {
            return Redirect::to('/');
        }
    }

    /*
     * Departement - Update
     */
    public function department_update(Request $request)
    {
        $data = $request->all();
        $model = Department::find($data['id']);
        $model->name = $data['name'];
        $model->address = $data['address'];
        if ($model->update()) {
            session()->flash('flash_message','Data has been updated');
            return Redirect::back();
        } else {
            session()->flash('flash_message_error','Update data failed');
            return Redirect::back();
        }
    }

    /*
     * Departement - Detail
     */
    public function department_detail(Request $request)
    {
        $data = $request->all();
        $model = new Department;
        $getData = $model->get_detail_data($data['id']);

        return json_encode($getData);
        die();
    }

    /*
     * Departement - Destroy
     */
    public function department_destroy(Request $request)
    {
        $data = $request->all();
        $model = Department::find($data['ID']);

        if($model->forceDelete()) {
            session()->flash('flash_message', 'Data has been deleted');
            return Redirect::back();
        } else {
            session()->flash('flash_message_error', 'Delete data failed');
            return Redirect::back();
        }
    }

    /*
     * Product - show index
     */
    public function product_show()
    {
        if (Sentry::check()) {
            $department = Department::all();
            return View::make('backend.product')->with('department',$department);
        } else {
            return View::make('backend.login');
        }
    }

    /*
     * Product - DataTables Serverside
     */
    public function product_data()
    {
        $results = Product::join('departments','products.department_id','=','departments.id')
            ->select('products.*','departments.name as department_name','departments.address as location')
            ->get();
        return Datatables::of($results)
            ->addColumn('action', function ($results) {
                if (Sentry::check()) {
                    return '<a class="btn btn-small btn-info edit" data-id="'.$results->id.'" data-toggle="modal" data-target="#myModalAdd" title="Edit"><i class="menu-icon icon-edit"></i> </a> <a class="btn btn-small btn-danger delete" data-id="'.$results->id.'" data-toggle="modal" data-target="#myModalDelete" title="Delete"><i class="menu-icon icon-remove"></i> </a>';
                } else {
                    return '';
                }
            })
        ->make(true);
    }

    /*
     * Product - Store
     */
    public function product_store(Request $request)
    {
        if (Sentry::check()) {
            $data = $request->all();
            $model = new Product;
            $model->name = $data['name'];
            if (!empty($data['qty'])) {
                $model->qty = $data['qty'];
            } else {
                $model->qty = 0;
            }
            $model->department_id = $data['department_id'];
            if ($model->save()) {
                session()->flash('flash_message','Data has been registered');
                return Redirect::back();
            } else {
                session()->flash('flash_message_error','Register data failed');
                return Redirect::back();
            }
        } else {
            return Redirect::to('/');
        }
    }

    /*
     * Product - Update
     */
    public function product_update(Request $request)
    {
        $data = $request->all();
        $model = Product::find($data['id']);
        $model->name = $data['name'];
        if (!empty($data['qty'])) {
            $model->qty = $data['qty'];
        } else {
            $model->qty = 0;
        }
        $model->department_id = $data['department_id'];
        if ($model->update()) {
            session()->flash('flash_message','Data has been updated');
            return Redirect::back();
        } else {
            session()->flash('flash_message_error','Update data failed');
            return Redirect::back();
        }
    }

    /*
     * Product - Detail
     */
    public function product_detail(Request $request)
    {
        $data = $request->all();
        $model = new Product;
        $getData = $model->get_detail_data($data['id']);

        return json_encode($getData);
        die();
    }

    /*
     * Product - Destroy
     */
    public function product_destroy(Request $request)
    {
        $data = $request->all();
        $model = Product::find($data['ID']);

        if($model->forceDelete()) {
            session()->flash('flash_message', 'Data has been deleted');
            return Redirect::back();
        } else {
            session()->flash('flash_message_error', 'Delete data failed');
            return Redirect::back();
        }
    }

}


?>