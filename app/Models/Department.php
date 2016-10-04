<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

    public function get_detail_data($id){
        $result = Department::find($id);

        return $result;
    }
}
