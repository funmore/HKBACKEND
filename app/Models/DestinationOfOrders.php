<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DestinationOfOrders extends Model
{
    //
    protected $table = "destinations_of_orders";
    protected $fillable = ['origin','destination','order_id'];

    protected $hidden = ['created_at','updated_at'];

    public function order(){
        return $this->belongsTo('App\Models\Order');
    }
}
