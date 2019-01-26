<?php

namespace App\Http\Controllers;

use App\DepartmentBudget;
use App\BudgetYear;
use Illuminate\Http\Request;
use Validator;

class DepartmentBudgetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $budgetYear = BudgetYear::find($request->budget_year_id);
        $validator = Validator::make($request->all(), [
            "fund_101" => "required|numeric|between:0," . $budgetYear->allocatedSectors->firstWhere('id', $request->sector_id)->budget->remaining_fund_101,
            "fund_164" => "required|numeric|between:0," . $budgetYear->allocatedSectors->firstWhere('id', $request->sector_id)->budget->remaining_fund_164,
            //"is_active" => "required|boolean"
        ]);

        if($validator->fails()){
            return back()
                    ->withErrors($validator, 'dept_budget')
                    ->withInput();
        }

        $validated = $validator->valid();
        $budgetYear->allocatedSectors->firstWhere('id', $validated["sector_id"])->budget
                    ->allocatedDepartments()
                    ->attach($validated["department_id"], 
                            ["fund_101" => $validated["fund_101"], "fund_164" => $validated["fund_164"]]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DepartmentBudget  $departmentBudget
     * @return \Illuminate\Http\Response
     */
    public function show(DepartmentBudget $departmentBudget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DepartmentBudget  $departmentBudget
     * @return \Illuminate\Http\Response
     */
    public function edit(DepartmentBudget $departmentBudget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DepartmentBudget  $departmentBudget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DepartmentBudget $departmentBudget)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DepartmentBudget  $departmentBudget
     * @return \Illuminate\Http\Response
     */
    public function destroy(DepartmentBudget $departmentBudget)
    {
        //
    }
}
