<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SectorBudget extends Pivot
{
    protected $guarded = [];

    protected $table = 'sector_budgets';

    public function allocatedDepartments(){
        return $this->belongsToMany('App\Department', 'department_budgets', 'sector_budget_id')
                    ->using('App\DepartmentBudget')
                    ->withPivot('fund_101', 'fund_164')
                    ->withTimestamps();
    }
}
