<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\BudgetYear;
use App\SectorBudget;
use App\Sector;
use App\Department;
use App\DepartmentBudget;

class BudgetAllocationController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(BudgetYear $budgetYear = null) //Request $request
    {
        $this->authorize('viewBudgetAlloc');

        bcscale(2);
        $currentYear = date('Y', strtotime('2020'));
        
        if($budgetYear==null) //if url does not have year, get current year. if current year is not found, get closest ascending year
            $budgetYear = BudgetYear::where('budget_year', '>=', $currentYear)
                                        ->orderBy('budget_year', 'asc')
                                        ->first();
        if($budgetYear==null)//if budgetYear is still null, get closest descending year. if not found, return 'page not found'
        $budgetYear = BudgetYear::where('budget_year', '<', $currentYear)
                                    ->orderBy('budget_year', 'desc')
                                    ->firstorFail();                                
            
        if(Auth::user()->type->name == "Sector Head"){
            $sectorBudgets = SectorBudget::where('budget_year_id', $budgetYear->id)
                                            ->where('sector_id', Auth::user()->userable->sector_id)
                                            ->get();
            $deptBudgets = $budgetYear->departmentBudgets;
            $sectors = Sector::where('id', Auth::user()->userable->sector_id)
                                ->get();
            $departments = Department::all(); //needed for commented view
        }    
        else{
            $sectorBudgets = SectorBudget::where('budget_year_id', $budgetYear->id)->get();
            $deptBudgets = $budgetYear->departmentBudgets;
            $sectors = Sector::all();
            $departments = Department::all();
        }

       

        return view('bo_budgetAlloc', compact('sectorBudgets', 'budgetYear', 'sectors', 'departments', 'deptBudgets'));
    }
}
