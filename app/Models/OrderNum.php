<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderNum extends Model
{
    //
    protected $table = "order_num";
    protected $fillable=['order_id','order_numb'];
    public function order(){
        return $this->belongsTo('App\Models\Order','order_id','id');
    }
}
