<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $guarded = [];

    public function sectorBudgets(){
        return $this->belongsToMany('App\Department', 'department_budgets', 'sector_budget_id')
                    ->using('App\DepartmentBudget')
                    //->withPivot('fund_101', 'fund_164')
                    ->withTimestamps();
    }
}
