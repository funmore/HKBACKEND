<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Use_log extends Model
{
    //
    protected $table = "use_logs";

    public function order(){
        return $this->belongsTo('App\Models\Order','order_id','id');
    }
}
