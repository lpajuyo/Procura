<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $guarded = [];

    public function budgetYears(){
        return $this->belongsToMany('App\BudgetYear', 'sector_budgets')
                    ->using('App\SectorBudget')
                    ->withPivot('fund_101', 'fund_164')
                    ->withTimestamps();
    }

    public function allocated($budget_year_id){
        return $this->budgetYears->firstWhere('id', $budget_year_id);
    }

    public function unallocated($budget_year_id){
        return !($this->allocated($budget_year_id));
    }
}
