<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'promotions';
    protected $primaryKey ='id';

    /**
     * [getAllPromotion]
     * @return [type] [array]
     */
    public function getAllPromotion()
    {
        return $this->orderBy('created_at','DESC')->get();
    }

    public function getDetailPromotion($id)
    {
        return $this->find($id);
    }
    /**
     * [createNewPromotion]
     * @param  [type] $data [array]
     * @return [type]       [id]
     */
    // public function createNewPromotion($data)
    // {
    //     $this->title = $data['title'];
    //     $this->description = $data['description'];
    //     $this->date = $data['date'];
    //     $this->image1 = $data['image1'];

    //     if ($this->save()) {
    //         return $this;
    //     } else {
    //         return false;
    //     }
    // }
}
