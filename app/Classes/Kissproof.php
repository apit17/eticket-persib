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

    /**
     * [Generate Random Code]
     * @param  integer $length [int]
     * @return [type]          [string]
     */
    public static function generateRandomCode($length=6)
    {
        $str = "";
        $characters = array_merge(range('A','Z'), range('a','z'), range('1','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }

        return $str;
    }

}

?>