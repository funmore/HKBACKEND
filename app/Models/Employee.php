<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $table = "employees";
    protected $fillable = ['name'];
    public function department() {
        return $this->belongsTo('App\Models\Department','depart_id','id');
    }

    public function order(){
        return $this->hasMany('App\Models\Order','user_id','id');
    }
}
