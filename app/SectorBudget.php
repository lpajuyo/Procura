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

    public function remainingFund101(){
        $allocatedDepts = $this->allocatedDepartments;

        $allocated = 0;
        foreach($allocatedDepts as $dept){
            $allocated = bcadd($allocated, $dept->pivot->fund_101);
        }

        return bcsub($this->fund_101, $allocated);
    }

    public function remainingFund164(){
        $allocatedDepts = $this->allocatedDepartments;

        $allocated = 0;
        foreach($allocatedDepts as $dept){
            $allocated = bcadd($allocated, $dept->pivot->fund_164);
        }

        return bcsub($this->fund_101, $allocated);
    }
}
