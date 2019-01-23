<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/7
 * Time: 15:28
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtherInfoOfOrder extends Model
{
    //
    protected $table = "otherinfo_of_order";
    protected $fillable = ['orderID','isLeader','leaderInfo','isVan','vanType','carType'];
    protected $hidden = ['created_at', 'updated_at'];

    public function order(){
        return $this->belongsTo('App\Models\Order','order_id','id');
    }
}