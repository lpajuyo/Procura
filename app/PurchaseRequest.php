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
}
