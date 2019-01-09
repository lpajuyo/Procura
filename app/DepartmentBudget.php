<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DepartmentBudget extends Pivot
{
    protected $guarded = [];

    protected $table = 'department_budgets';

    public function department(){
        return $this->belongsTo('App\Department');
    }
}
