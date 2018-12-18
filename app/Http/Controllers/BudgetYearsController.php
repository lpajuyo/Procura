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
        //
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
        //
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
        //
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