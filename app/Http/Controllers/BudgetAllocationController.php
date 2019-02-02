<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\BudgetYear;
use App\SectorBudget;
use App\Sector;
use App\Department;
use App\DepartmentBudget;
use Carbon\Carbon;

class BudgetAllocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, BudgetYear $budgetYear = null) //Request $request
    {
        $this->authorize('viewBudgetAlloc');

        bcscale(2);
        $sectors = Sector::all();
        $currentYear = Carbon::now()->year;
        
        if ($budgetYear == null){ //if url does not have year id, get active year
            $budgetYear = BudgetYear::active()->first();
            if($budgetYear)
                $request->session()->flash('active_year');
        }
        if(Auth::user()->type->name != "Sector Head"){
            if($budgetYear==null){ //if url does not have year, get current year. if current year is not found, get closest ascending year
                $budgetYear = BudgetYear::where('budget_year', '>', $currentYear)
                                            ->orderBy('budget_year', 'asc')
                                            ->first();
                if($budgetYear)
                    $request->session()->flash('active_year_error', 'There is no Active Budget Year set. Showing closest incoming budget year.');
            }
        }
        try {
            if($budgetYear==null){ //if budgetYear is still null, get closest descending year. if not found, return 'page not found'
                $budgetYear = BudgetYear::where('budget_year', '<=', $currentYear)
                                        ->orderBy('budget_year', 'desc')
                                        ->firstorFail();
                if($budgetYear)
                    $request->session()->flash('active_year_error', 'There is no Active Budget Year set. Showing current/closest past budget year.');
            }
        } catch (ModelNotFoundException $e) {
            abort(497, 'There are no Budget Years in the database. Please create one first.');
        }                             

        return view('bo_budgetAlloc', compact('budgetYear', 'sectors'));
    }
}
