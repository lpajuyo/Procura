<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DepartmentBudget extends Pivot
{
    protected $guarded = [];

    protected $table = 'department_budgets';
}
