<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BudgetYear extends Model
{
    protected $fillable = ['budget_year', 'fund_101', 'fund_164']; //, 'is_active'];

    public function allocatedSectors(){
        return $this->belongsToMany('App\Sector', 'sector_budgets')
                    ->using('App\SectorBudget')
                    ->as('budget')
                    ->withPivot('id','fund_101', 'fund_164')
                    ->withTimestamps();
    }

    public function departmentBudgets(){
        return $this->hasManyThrough('App\DepartmentBudget', 'App\SectorBudget', 'budget_year_id', 'sector_budget_id');
    }

    public function remainingFund101(){
        $allocatedSectors = $this->allocatedSectors;

        $allocated = 0;
        foreach($allocatedSectors as $sector){
            $allocated = bcadd($allocated, $sector->budget->fund_101);
        }

        return bcsub($this->fund_101, $allocated);
    }

    public function remainingFund164(){
        $allocatedSectors = $this->allocatedSectors;

        $allocated = 0;
        foreach($allocatedSectors as $sector){
            $allocated = bcadd($allocated, $sector->budget->fund_164);
        }

        return bcsub($this->fund_164, $allocated);
    }

    public function remaining(){
        return bcadd($this->remainingFund101(), $this->remainingFund164());
    }

    public function total(){
        return bcadd($this->fund_101, $this->fund_164);
    }

    public function allocated(){
        return bcsub($this->total(), $this->remaining());
    }
}
