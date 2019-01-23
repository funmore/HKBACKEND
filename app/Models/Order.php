<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = "orders";
    protected $appends = ['selected', 'destination', 'origin', 'name', 'telephone','carLicense','carName','driverMobilephone',
                            'driverName','start_time','end_time','mileage','gq_fee','pause_fee','gs_fee','account','use_time_start',
                            'use_time_end','disapp_remark','app_leader','manager_name','is_van','van_type','is_leader','leaderinfo','company_name','order_numb','order_istake'];
    // add by fzq : to sovle massive assignment issue;
    protected $fillable = ['usetime', 'user_id', 'telephone', 'type', 'manager', 'passenger', 'mobilephone',
        'isweekend', 'isreturn', 'workers', 'state', 'remark','reason','isOld'];

    protected $hidden = ['created_at'];

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee', 'user_id', 'id');
    }

    public function otherInfoOfOrder(){
        return $this->hasOne('App\Models\OtherInfoOfOrder');
    }

    public function approvelog()
    {
        return $this->hasMany('App\Models\Approve_log');
    }

    public function uselog()
    {
        return $this->hasOne('App\Models\Use_log');
    }

    public function ordernum(){
        return $this->hasOne('App\Models\OrderNum');
    }

    public function orderistakeproduct(){
        return $this->hasOne('App\Models\OrderIsTakeProduct');
    }

    public function acceptlog()
    {
        return $this->hasOne('App\Models\Accept_log');
    }

    public function destinationoforders()
    {
        return $this->hasOne('App\Models\DestinationOfOrders');
    }

    public function performanceuse()
    {
        return $this->hasOne('App\Models\PerformanceUse');
    }

    public function getOrderNumbAttribute(){
        return ($this->ordernum)!=null ? $this->ordernum->order_numb:null;
    }

    public function getOrderIstakeAttribute(){
        return ($this->orderistakeproduct)!=null ? $this->orderistakeproduct->order_istake:null;
    }

    public function getCompanyNameAttribute(){
        if($this->state>=36||$this->state==1) {
            return ($this->acceptlog != null && $this->acceptlog->company != null) ? $this->acceptlog->company->name : null;
        }else if($this->state>20&&$this->state<35){
            return Company::find($this->state-20)->name;
        }else{
            return null;
        }
    }

    public function getSelectedAttribute()
    {
        return false;
    }

    public function getOriginAttribute()
    {
        return ($this->destinationoforders) != null ?json_decode($this->destinationoforders->origin) : '';
    }

    public function getDestinationAttribute()
    {
        return ($this->destinationoforders) != null ?json_decode ($this->destinationoforders->destination) : '';
    }

    public function getNameAttribute()
    {
        return $this->employee->name;
    }

    public function getIsVanAttribute(){
        return ($this->otherInfoOfOrder!=null) ? $this->otherInfoOfOrder->isVan:null;
    }
    public function getVanTypeAttribute(){
        return ($this->otherInfoOfOrder!=null) ? $this->otherInfoOfOrder->vanType:null;
    }
    public function getIsLeaderAttribute(){
        return ($this->otherInfoOfOrder!=null) ? $this->otherInfoOfOrder->isLeader:null;
    }
    public function getLeaderinfoAttribute(){
        return ($this->otherInfoOfOrder!=null) ? json_decode($this->otherInfoOfOrder->leaderInfo):null;
    }

    public function getTelephoneAttribute()
    {
        return $this->employee->mobilephone;
    }

    public function getCarLicenseAttribute()
    {
        return ($this->acceptlog!=null&&$this->acceptlog->c_id!=0)?Car::find($this->acceptlog->c_id)->license:null;
    }

    public function getCarNameAttribute()
    {
        return ($this->acceptlog!=null&&$this->acceptlog->c_id!=0)?Car::find($this->acceptlog->c_id)->name:null;
    }

    public function getDriverMobilephoneAttribute()
    {
        return  ($this->acceptlog!=null&&$this->acceptlog->d_id!=0) ?Driver::find($this->acceptlog->d_id)->mobilephone:null;
    }

    public function getDriverNameAttribute()
    {
        return ($this->acceptlog!=null&&$this->acceptlog->d_id!=0)?Driver::find($this->acceptlog->d_id)->name:null;
    }

    public function getStartTimeAttribute(){
        return $this->uselog!=null?$this->uselog->start_time:null;
    }
    public function getEndTimeAttribute(){
        return $this->uselog!=null?$this->uselog->end_time:null;
    }
    public function getMileageAttribute(){
        return $this->uselog!=null? $this->uselog->mileage:null;
    }
    public function getGqFeeAttribute(){
        return $this->uselog!=null? $this->uselog->gq_fee:null;
    }
    public function getPauseFeeAttribute(){
        return $this->uselog!=null? $this->uselog->pause_fee:null;
    }
    public function getGsFeeAttribute(){
        return $this->uselog!=null? $this->uselog->gs_fee:null;
    }
    public function getAccountAttribute(){
        return $this->uselog!=null? $this->uselog->account:null;
    }
    public function getUseTimeStartAttribute(){
        return $this->uselog!=null? $this->uselog->start_time:null;
    }
    public function getUseTimeEndAttribute(){
        return $this->uselog!=null? $this->uselog->end_time:null;
    }
    public function getDisappRemarkAttribute(){
        $remark=null;
        if($this->approvelog!=null){
            $appLogs=$this->approvelog()->get();
             foreach( $appLogs as $appLog){
                 if($appLog->approve_node>50){
                     $remark=$appLog->remark;
                 }
             }
        }
        return $remark;
    }
    public function getAppLeaderAttribute(){
        $appLeaders=null;
        $appLeaderXH=null;
        $appLeaderGL=null;
        if($this->approvelog!=null){
            $appLogs=$this->approvelog()->get();

            foreach( $appLogs as $appLog){
                if($appLog->approve_node==9||$appLog->approve_node==51){
                    if(Employee::find($appLog->u_id)!=null) {
                        $appLeaderXH = Employee::find($appLog->u_id)->name;
                    }
                }
                if($appLog->approve_node==20||$appLog->approve_node==52||$appLog->approve_node==53){
                    if(Employee::find($appLog->u_id)!=null) {
                        $appLeaderGL = Employee::find($appLog->u_id)->name;
                    }
                }
            }
            if($appLeaderXH!=null&&$appLeaderGL!=null) {
                $appLeaderArr =array($appLeaderXH,$appLeaderGL);
                    $appLeaders=implode('-',$appLeaderArr);
            }
            if($appLeaderXH==null&&$appLeaderGL!=null) {
                $appLeaders=$appLeaderGL;
            }
            if($appLeaderXH!=null&&$appLeaderGL==null) {
                $appLeaders=$appLeaderXH;
            }
        }
        //return $this->approvelog!=null ? (Employee::find($appLog->u_id)->name):null;
        return $appLeaders;
    }
    public function getManagerNameAttribute(){
        return ($this->type==1 && $this->manager!=0&&Employee::find($this->manager)!=null) ? (Employee::find($this->manager)->name) : null;
    }
}

