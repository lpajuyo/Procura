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
        $currentYear = Carbon::now()->year;
        
        if($budgetYear==null) //if url does not have year, get current year. if current year is not found, get closest ascending year
            $budgetYear = BudgetYear::where('budget_year', '>=', $currentYear)
                                        ->orderBy('budget_year', 'asc')
                                        ->first();
        try {
        if($budgetYear==null)//if budgetYear is still null, get closest descending year. if not found, return 'page not found'
        $budgetYear = BudgetYear::where('budget_year', '<', $currentYear)
                                    ->orderBy('budget_year', 'desc')
                                    ->firstorFail();   
        } catch (ModelNotFoundException $e) {
            abort(497, 'There are no Budget Years in the database. Please create one first.');
        }                             
            
        // if(Auth::user()->type->name == "Sector Head"){
        //     $sectorBudgets = SectorBudget::where('budget_year_id', $budgetYear->id)
        //                                     ->where('sector_id', Auth::user()->userable->sector_id)
        //                                     ->get();
        //     $deptBudgets = $budgetYear->departmentBudgets;
        //     $sectors = Sector::where('id', Auth::user()->userable->sector_id)
        //                         ->get();
        // }    
        // else{
            $sectors = Sector::all();
        // }

        // // past budget allocation code
        // if ($budgetYear == null){ //if url does not have year id, get active year
        //     $budgetYear = BudgetYear::active()->first();
            
        //     if(Auth::user()->type->name == "Sector Head" && $budgetYear != null){
        //         if($budgetYear->allocatedSectors->firstWhere('sector_id', Auth::user()->userable->sector_id) == null){
        //             $request->session()->flash('active_year_error', 'Your sector is not yet allocated in the active budget year. Showing closest past budget year instead.');
        //             $budgetYear = null;
        //         }
        //     }
        //     else
        //         $request->session()->flash('active_year');
        // }

        // if (Auth::user()->type->name != "Sector Head") {
        //     if ($budgetYear == null) { //if there is no active year, get current year. if current year is not found, get closest ascending year
        //         $budgetYear = BudgetYear::where('budget_year', '>=', $currentYear)
        //             ->orderBy('budget_year', 'asc')
        //             ->first();
        //         $request->session()->flash('active_year_error', 'There is no Active Budget Year set. Showing current/closest incoming budget year.');
        //     }
        // }
        // if ($budgetYear == null) { //if current/closest ascending year is not found, get closest descending year. if not found, return 'page not found'
        //     $budgetYear = BudgetYear::where('budget_year', '<=', $currentYear)
        //         ->orderBy('budget_year', 'desc')
        //         ->firstorFail(); //fire no budget year found error
        //     if(!$request->session()->has('active_year_error'))
        //         $request->session()->flash('active_year_error', 'There is no Active Budget Year set. Showing current/closest past budget year.');
        // }

        // //if user is sector head, only get budget allocation for his/her sector and departments under it                            
        // if (Auth::user()->type->name == "Sector Head") {
        //     $sectorBudgets = SectorBudget::where('budget_year_id', $budgetYear->id)
        //         ->where('sector_id', Auth::user()->userable->sector_id)
        //         ->get();
        //     $deptBudgets = $budgetYear->departmentBudgets;
        //     $sectors = Sector::where('id', Auth::user()->userable->sector_id)
        //         ->get();
        //     $departments = Department::all(); //needed for commented view

        //     if($sectorBudgets->count() == 0) //if sector is not allocated for the year, throw exception
        //         abort(401);
        // } else {
        //     $sectorBudgets = SectorBudget::where('budget_year_id', $budgetYear->id)->get();
        //     $deptBudgets = $budgetYear->departmentBudgets;
        //     $sectors = Sector::all();
        //     $departments = Department::all();
        // }

        return view('bo_budgetAlloc', compact('sectorBudgets', 'budgetYear', 'sectors', 'departments', 'deptBudgets'));
    }
}
