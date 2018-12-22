<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BudgetYear extends Model
{
    protected $fillable = ['budget_year', 'fund_101', 'fund_164']; //, 'is_active'];

    function __construct(){
        bcscale(2);
    }

    public function sectorBudgets(){
        return $this->hasMany('App\SectorBudget');
    }

    public function remainingFund101(){
        $sectorBudgets = $this->sectorBudgets;

        $allocated = 0;
        foreach($sectorBudgets as $sectorBudget){
            $allocated = bcadd($allocated, $sectorBudget->fund_101);
        }

        return bcsub($this->fund_101, $allocated);
    }

    public function remainingFund164(){
        $sectorBudgets = $this->sectorBudgets;
;
        $allocated = 0;
        foreach($sectorBudgets as $sectorBudget){
            $allocated = bcadd($allocated, $sectorBudget->fund_164);
        }

        return bcsub($this->fund_164, $allocated);
    }

    public function remaining(){
        return bcadd($this->remainingFund101(), $this->remainingFund164());
    }

    public function total(){
        return bcadd($this->fund_101, $this->fund_164);
    }
}
