<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BudgetProposal extends Model
{
    public function budgetYear(){
        return $this->belongsTo('App\BudgetYear');
    }

    public function submitter(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
