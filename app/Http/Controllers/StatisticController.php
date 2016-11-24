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
        $start = @$post['first_date'] ? date('Y-m-d',strtotime($post['first_date'])) : "";
        $end = @$post['end_date'] ? date('Y-m-d',strtotime($post['end_date'])) : "";

        $income = $this->income->getSaleDataByPeriode($start, $end);

        if ($post['type'] == 'graphic') {

            $date = array(); $total = array();
            foreach ($income as $key => $value) {
                $date[] = Kissproof::dateIndo($key);
                $total[] = $value;
            }

            $sent = array(
                'type' => 'graphic',
                'date' => $date,
                'total' => $total
            );

        } else {

            $header = '<table class="table table-striped table-bordered table-condensed">
            <tr>
                <th>Date</th>
                <th>Total</th>
            </tr>';

            $body = ''; $sum = 0;
            foreach ($income as $i => $val) {
                $body .= '<tr><td>'.Kissproof::dateIndo($i).'</td><td>'.Kissproof::priceFormater($val).'</td></tr>';
                $sum += $val;
            }

            $footer = '<tr><td><b>Total Income</b></td><td><b>'.Kissproof::priceFormater($sum).'</b></td></tr></table>';

            $table = $header.$body.$footer;

            $sent = array(
                'type' => 'table',
                'table' => $table
            );
        }

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
        $start = @$post['first_date'] ? date('Y-m-d',strtotime($post['first_date'])) : "";
        $end = @$post['end_date'] ? date('Y-m-d',strtotime($post['end_date'])) : "";

        $outcome = $this->outcome->getProcurementDataByPeriode($start, $end);

        if ($post['type'] == 'graphic') {

            $date = array(); $total = array();
            foreach ($outcome as $key => $value) {
                $date[] = Kissproof::dateIndo($key);
                $total[] = $value;
            }

            $sent = array(
                'type' => 'graphic',
                'date' => $date,
                'total' => $total
            );

        } else {

            $header = '<table class="table table-striped table-bordered table-condensed">
            <tr>
                <th>Date</th>
                <th>Total</th>
            </tr>';

            $body = ''; $sum = 0;
            foreach ($outcome as $i => $val) {
                $body .= '<tr><td>'.Kissproof::dateIndo($i).'</td><td>'.Kissproof::priceFormater($val).'</td></tr>';
                $sum += $val;
            }

            $footer = '<tr><td><b>Total Outcome</b></td><td><b>'.Kissproof::priceFormater($sum).'</b></td></tr></table>';

            $table = $header.$body.$footer;

            $sent = array(
                'type' => 'table',
                'table' => $table
            );

        }

        return json_encode($sent);
        die();
    }

}
