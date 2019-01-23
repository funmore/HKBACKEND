<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accept_log extends Model
{
    //
    protected $table = "accept_logs";
    protected $fillable=['order_id','u_id','c_id','d_id','remark'];
    public function order(){
        return $this->belongsTo('App\Models\Order','order_id','id');
    }
    public function company(){
        return $this->belongsTo('App\Models\Company','u_id','id');
    }
}
