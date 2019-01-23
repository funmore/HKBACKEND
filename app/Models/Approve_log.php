<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approve_log extends Model
{
    //
    protected $table = "approve_logs";
    protected $fillable = ['order_id','approve_node','u_id','opinion','remark'];
    public function order(){
        return $this->belongsTo('App\Models\Order','order_id','id');
    }

}
