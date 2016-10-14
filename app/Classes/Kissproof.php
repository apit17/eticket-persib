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

}

?>