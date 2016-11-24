<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Classes\Kissproof;
use App\Models\Sale;
use App\Models\Procurement;
use View;
use Sentry;
use Redirect;

class StatisticController extends Controller
{
    public function __construct(Sale $sale, Procurement $proc)
    {
        $this->income = $sale;
        $this->outcome = $proc;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('backend.statistic.index');
    }

    /**
     * Get data income from db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function income(Request $request)
    {
        $post = $request->all();
        $start = date('Y-m-d',strtotime($post['first_date']));
        $end = date('Y-m-d',strtotime($post['end_date']));

        $income = $this->income->getSaleDataByPeriode($start, $end);

        $date = array(); $total = array();
        foreach ($income as $key => $value) {
            $date[] = Kissproof::dateIndo($key);
            $total[] = $value;
        }

        $sent = array(
            'date' => $date,
            'total' => $total
        );

        return json_encode($sent);
        die();
    }

    /**
     * Get data outcome from db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function outcome(Request $request)
    {
        $post = $request->all();
        $start = date('Y-m-d',strtotime($post['first_date']));
        $end = date('Y-m-d',strtotime($post['end_date']));

        $outcome = $this->outcome->getProcurementDataByPeriode($start, $end);

        $date = array(); $total = array();
        foreach ($outcome as $key => $value) {
            $date[] = Kissproof::dateIndo($key);
            $total[] = $value;
        }

        $sent = array(
            'date' => $date,
            'total' => $total
        );

        return json_encode($sent);
        die();
    }

}
