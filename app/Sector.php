<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $guarded = [];

    public function yearsAllocated()
    {
        return $this->belongsToMany('App\BudgetYear', 'sector_budgets')
            ->using('App\SectorBudget')
            ->as('budget')
            ->withPivot('id', 'fund_101', 'fund_164')
            ->withTimestamps();
    }

    public function departments()
    {
        return $this->hasMany('App\Department');
    }

    public function head()
    {
        return $this->hasOne('App\SectorHead');
    }

    public function isAllocated(BudgetYear $budgetYear)
    {
        return $this->yearsAllocated->firstWhere('id', $budgetYear->id);
    }

    public function isUnallocated(BudgetYear $budgetYear)
    {
        return !($this->isAllocated($budgetYear));
    }
}
