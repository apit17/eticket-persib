<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function customer()
    {
        return $this->belongsTo('\App\Models\Customer');
    }

    public function ticket()
    {
        return $this->belongsTo('\App\Models\Ticket');
    }
}
