<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'promotions';

    /**
     * [getAllPromotion]
     * @return [type] [array]
     */
    public function getAllPromotion()
    {
        return $this->orderBy('created_at','DESC')->get();
    }

    /**
     * [createNewPromotion]
     * @param  [type] $data [array]
     * @return [type]       [id]
     */
    public function createNewPromotion($data)
    {
        $this->title = $data['title'];
        $this->description = $data['description'];

        if ($this->save()) {
            return $this;
        } else {
            return false;
        }
    }
}
