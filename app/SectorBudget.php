<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SectorBudget extends Pivot
{
    protected $guarded = [];

    protected $table = 'sector_budgets';
}
