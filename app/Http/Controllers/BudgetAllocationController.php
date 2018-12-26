<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BudgetYear;
use App\SectorBudget;
use App\Sector;

class BudgetAllocationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request) //BudgetYear $budgetYear
    {
        $budgetYear = BudgetYear::where('budget_year', 2018)->firstOrFail();
        $sectorBudgets = SectorBudget::where('budget_year_id', $budgetYear->id)->get();
        $sectors = Sector::all();

        return view('bo_budgetAlloc', compact('sectorBudgets', 'budgetYear', 'sectors'));
    }
}
