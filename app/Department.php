<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BudgetYear;

class Department extends Model
{
    protected $guarded = [];

    public function sectorBudgets(){
        return $this->belongsToMany('App\SectorBudget', 'department_budgets', 'department_id', 'sector_budget_id')
                    ->using('App\DepartmentBudget')
                    ->as('budget')
                    ->withPivot('fund_101', 'fund_164')
                    ->withTimestamps();
    }

    public function head(){
        return $this->hasOne('App\DepartmentHead');
    }

    public function sector(){
        return $this->belongsTo('App\Sector');
    }

    public function isAllocated(BudgetYear $budgetYear){
        return $this->sectorBudgets->firstWhere('budget_year_id', $budgetYear->id);
    }

    public function isUnallocated(BudgetYear $budgetYear){
        return !($this->isAllocated($budgetYear));
    }
}
