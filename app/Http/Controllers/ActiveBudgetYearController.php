<?php

namespace App\Http\Controllers;

use App\BudgetYear;
use Illuminate\Http\Request;

class ActiveBudgetYearController extends Controller
{
    public function __invoke(BudgetYear $budgetYear)
    {
        $this->authorize('activate', $budgetYear);

        $budgetYear->activate();

        BudgetYear::where('id', '!=', $budgetYear->id)->update(['is_active' => false]);

        return redirect()->route('budget_years.index');
    }
}
