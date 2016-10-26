<?php

namespace App\Classes;

class Kissproof {

    /**
     * [Change to Format Rupiah (Rp.)]
     * @param  [type] $str [double]
     * @return [type]      [string]
     */
    public static function priceFormater($str)
    {
        $data = 'Rp. '.number_format($str,0,".",".").',00';
        return $data;
    }

    /**
     * [Change to fotmat Indonesian date]
     * @param  [type] $date [date]
     * @return [type]       [string]
     */
    public static function dateIndo($date)
    {
        $mIndo  = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

        $year   = substr($date, 0, 4);
        $month  = substr($date, 5, 2);
        $day    = substr($date, 8, 2);

        $result = $day . " " . $mIndo[(int)$month-1] . " ". $year;
        return($result);
    }

}

?>