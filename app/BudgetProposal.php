<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BudgetProposal extends Model
{
    protected $fillable = ['is_approved'];

    public function budgetYear(){
        return $this->belongsTo('App\BudgetYear');
    }

    public function submitter(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function approve($approved = true){
        $this->update(["is_approved" => $approved]);
    }

    public function reject(){
        $this->approve(false);
    }
}
