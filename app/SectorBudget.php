<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SectorBudget extends Pivot
{
    protected $guarded = [];

    protected $table = 'sector_budgets';

    protected $with = ['allocatedDepartments'];

    protected $appends = ['remaining_fund_101', 'remaining_fund_164'];

    public function allocatedDepartments(){
        return $this->belongsToMany('App\Department', 'department_budgets', 'sector_budget_id', 'department_id')
                    ->using('App\DepartmentBudget')
                    ->withPivot('fund_101', 'fund_164')
                    ->withTimestamps();
    }

    public function getRemainingFund101Attribute(){
        $allocatedDepts = $this->allocatedDepartments;

        $allocated = 0;
        foreach($allocatedDepts as $dept){
            $allocated = bcadd($allocated, $dept->pivot->fund_101);
        }

        return bcsub($this->fund_101, $allocated);
    }

    public function getRemainingFund164Attribute(){
        $allocatedDepts = $this->allocatedDepartments;

        $allocated = 0;
        foreach($allocatedDepts as $dept){
            $allocated = bcadd($allocated, $dept->pivot->fund_164);
        }

        return bcsub($this->fund_164, $allocated);
    }

    public function remaining(){
        return bcadd($this->remaining_fund_101, $this->remaining_fund_164);
    }

    public function total(){
        return bcadd($this->fund_101, $this->fund_164);
    }

    public function allocated(){
        return bcsub($this->total(), $this->remaining());
    }
}
