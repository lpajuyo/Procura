<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $guarded = [];

    public function yearsAllocated(){
        return $this->belongsToMany('App\BudgetYear', 'sector_budgets')
                    ->using('App\SectorBudget')
                    ->withPivot('fund_101', 'fund_164')
                    ->withTimestamps();
    }

    public function departments(){
        return $this->hasMany('App\Department');
    }

    public function head(){
        return $this->hasOne('App\SectorHead');
    }

    public function allocated($budget_year_id){
        return $this->yearsAllocated->firstWhere('id', $budget_year_id);
    }

    public function unallocated($budget_year_id){
        return !($this->allocated($budget_year_id));
    }
}
