<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function schedule()
    {
        return $this->belongsTo('\App\Models\Schedule');
    }
}
