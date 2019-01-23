<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    //
    protected $table = "drivers";
    protected $fillable = ['name','mobilephone','company_id'];

    public function company(){
    return $this->belongsTo('App\Models\Company','company_id','id');
}
}
