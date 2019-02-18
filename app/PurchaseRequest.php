<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PurchaseRequest extends Model
{
    protected $guarded = [];

    public function project(){
        return $this->belongsTo('App\Project');
    }

    public function items(){
        return $this->hasMany('App\PurchaseRequestItem');
    }

    public function getRequestorAttribute(){
        return $this->project->user;
    }

    public function getApproverAttribute(){
        return $this->project->approver;
    }

    public function getDepartmentAttribute(){
        return $this->project->department;
    }

    public function approve($remarks, $approved = true){
        $this->update(["is_approved" => $approved, "remarks" => $remarks]);
    }

    public function reject($remarks){
        $this->approve($remarks, false);
    }

    public function submit(){
        $this->update(['submitted_at' => Carbon::now()]);
    }

    public function unsubmit(){
        $this->update(['submitted_at' => null]);
    }
}
