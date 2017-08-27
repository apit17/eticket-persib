<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function tickets()
    {
        return $this->hasMany('\App\Models\Ticket');
    }
}
