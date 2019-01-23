<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    //
    protected $table = "cars";
    protected   $fillable = ['name','license','company_id'];

    public function company(){
    return $this->belongsTo('App\Models\Company','company_id','id');
}
}
