<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerformanceUse extends Model
{
    //
    protected $table = "performance_use";
    protected $fillable = ['orderID','score_of_order','reviewText'];

    public function order(){
        return $this->belongsTo('App\Models\Order');
    }
}