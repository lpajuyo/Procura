<?php

namespace App\Http\Controllers;

use App\BudgetYear;
use Illuminate\Http\Request;

class BudgetYearsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $budgetYears = BudgetYear::all();
        
        return view("bo_budgetYear", compact('budgetYears'));
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
        BudgetYear::create($request->validate([
                "budget_year" => "required|digits:4|date_format:Y|unique:budget_years,budget_year",
                "fund_101" => "required|numeric",
                "fund_164" => "required|numeric",
                //"is_active" => "required|boolean"
            ])
        );

        //if set to "Active", set all other rows to "Inactive"

        return redirect('/budget_years');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BudgetYear  $budgetYear
     * @return \Illuminate\Http\Response
     */
    public function show(BudgetYear $budgetYear)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BudgetYear  $budgetYear
     * @return \Illuminate\Http\Response
     */
    public function edit(BudgetYear $budgetYear)
    {
        return $budgetYear;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BudgetYear  $budgetYear
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BudgetYear $budgetYear)
    {
        $budgetYear->update(request(['fund_101', 'fund_164']));

        return redirect('/budget_years');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BudgetYear  $budgetYear
     * @return \Illuminate\Http\Response
     */
    public function destroy(BudgetYear $budgetYear)
    {
        //
    }
}
