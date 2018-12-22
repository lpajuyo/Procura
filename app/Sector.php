<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $guarded = [];

    public function budgets(){
        return $this->hasMany('App\SectorBudget');
    }

    public function hasBudget($budget_year_id){
        return $this->budgets()->where('budget_year_id', $budget_year_id)->first();
    }
}
