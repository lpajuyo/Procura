<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BudgetProposal extends Model
{
    protected $fillable = ['for_year', 'proposal_name','amount', 'proposal_file','is_approved','remarks'];

    protected $attributes = [
        "is_approved" => null
    ];

    public function submitter(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function approve($remarks, $approved = true){
        $this->update(["is_approved" => $approved]);
        $this->addRemarks($remarks);
    }

    public function reject($remarks){
        $this->approve($remarks, false);
    }

    public function addRemarks($remarks){
        $this->update(compact("remarks"));
    }
}
