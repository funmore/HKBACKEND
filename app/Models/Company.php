<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $table = "companys";
    public function acceptlog(){
        return $this->hasMany('App\Models\Accept_log','u_id','id');
    }

    public function drivers(){
        return $this->hasMany('App\Models\Driver','company_id','id');
    }

    public  function cars(){
        return $this->hasMany('App\Models\Car','company_id','id');
    }
}
