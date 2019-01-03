<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BudgetProposal extends Model
{
    protected $fillable = ['for_year', 'proposal_name','amount', 'proposal_file','is_approved'];

    protected $attributes = [
        "is_approved" => null
    ];

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
