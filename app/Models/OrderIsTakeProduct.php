<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderIsTakeProduct extends Model
{
    //
    protected $table = "order_istakeproduct";
    protected $fillable=['order_id','order_istake'];
    public function order(){
        return $this->belongsTo('App\Models\Order','order_id','id');
    }
}
