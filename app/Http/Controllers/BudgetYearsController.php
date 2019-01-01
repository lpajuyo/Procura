<?php

namespace App\Http\Controllers;

use App\BudgetYear;
use Illuminate\Http\Request;
use Validator;
//use App\Http\Requests\StoreBudgetYear;

class BudgetYearsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        bcscale(2);
    }

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
        $validator = Validator::make($request->all(), [
            "budget_year" => "bail|required|numeric|digits:4|min:".date('Y', strtotime("this year"))."|date_format:Y|unique:budget_years,budget_year",
            "fund_101" => "required|numeric|min:0",
            "fund_164" => "required|numeric|min:0",
            //"is_active" => "required|boolean"
        ]);

        if($validator->fails()){
            return redirect('/budget_years')->withErrors($validator, 'create')->withInput();
        }

        //if set to "Active", set all other rows to "Inactive"

        // BudgetYear::create($request->validated());
        BudgetYear::create($validator->valid());

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
        return $budgetYear->load('allocatedSectors')->toJson();
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
        $validator = Validator::make($request->all(), [
            "fund_101" => "required|numeric|min:0",
            "fund_164" => "required|numeric|min:0",
            //"is_active" => "required|boolean"
        ]);

        if($validator->fails()){
            return redirect('/budget_years')
                            ->withErrors($validator, 'edit')
                            ->withInput()
                            ->with('id', $budgetYear->id)
                            ->with('year', $budgetYear->budget_year);
        }

        $budgetYear->update($validator->valid());

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
        $budgetYear->delete();

        return redirect('/budget_years');
    }
}
