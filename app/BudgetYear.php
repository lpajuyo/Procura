<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BudgetYear extends Model
{
    protected $fillable = ['budget_year', 'fund_101', 'fund_164']; //, 'is_active'];
}
