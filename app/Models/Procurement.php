<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Classes\Kissproof;

class Procurement extends Model
{
    protected $table = 'procurements';

    /**
     * [get all data procurements]
     * @return [type] [array]
     */
    public function getAllProcurements()
    {
        return $this->all();
    }

    /**
     * [get Detail Procurement]
     * @param  [type] $id [int]
     * @return [type]     [array]
     */
    public function getDetailProcurement($id)
    {
        return $this->join('procurement_details','procurements.id','=','procurement_details.procurement_id')
            ->join('products','procurement_details.product_id','=','products.id')
            ->select('procurements.code','products.name','products.color','procurement_details.price','procurement_details.qty')
            ->where('procurement_details.procurement_id',$id)
            ->get();
    }

    /**
     * [insert New Procurement]
     * @param  [type] $products [array]
     * @param  [type] $qtys     [array]
     * @param  [type] $prices   [array]
     * @return [type]           [int]
     */
    public function insertNewProcurement($date,$products,$qtys,$prices)
    {
        //get total price
        foreach ($prices as $ii => $price) {
            $tot = $price*$qtys[$ii];
            $total[] = $tot;
        }
        $grandTotal = 0;
        foreach ($total as $iii => $val) {
            $grandTotal += $val;
        }

        $this->code = Kissproof::generateRandomCode();
        $this->date = date('Y-m-d',strtotime($date));
        $this->total = $grandTotal;

        if ($this->save()) {
            return $this->id;
        } else {
            return false;
        }
    }

    /**
     * [getProcurementDataByPeriode]
     * @param  [type] $start [date]
     * @param  [type] $end   [date]
     * @return [type]        [array]
     */
    public function getProcurementDataByPeriode($start, $end)
    {
        if (!empty($start) && !empty($end)) {
            return \DB::table('procurements')
                ->selectRaw('date, sum(total) as amount')
                ->whereBetween('date', array($start.' 00:00:00', $end.' 23:59:59'))
                ->groupBy('date')
                ->lists('amount', 'date');
        } else {
            return \DB::table('procurements')
                ->selectRaw('date, sum(total) as amount')
                ->whereMonth('date','=',date('m'))
                ->groupBy('date')
                ->lists('amount', 'date');
        }
    }
}
