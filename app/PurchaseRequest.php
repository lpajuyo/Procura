<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    protected $guarded = [];

    public function project(){
        return $this->belongsTo('App\Project');
    }

    public function items(){
        return $this->hasMany('App\PurchaseRequestItem');
    }

    public function getApproverAttribute(){
        return $this->project->approver;
    }

    public function getDepartmentAttribute(){
        return $this->project->department;
    }

    public function approve($approved = true){ //public function approve($remarks, $approved = true){
        $this->update(["is_approved" => $approved]);
        // $this->addRemarks($remarks);
    }

    public function reject(){ //    public function reject($remarks){
        // $this->approve($remarks, false);
        $this->approve(false);
    }

    // public function addRemarks($remarks){
    //     $this->update(compact("remarks"));
    // }
}
