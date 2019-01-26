<?php

namespace App\Http\Controllers;

use App\SectorBudget;
use App\BudgetYear;
use App\Sector;
use Illuminate\Http\Request;
use Validator;

class SectorBudgetsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $budgetYear = BudgetYear::where('budget_year', 2018)->firstOrFail();
        $sectorBudgets = SectorBudget::where('budget_year_id', $budgetYear->id)->get();
        $sectors = Sector::all();

        return view('bo_budgetAlloc', compact('sectorBudgets', 'budgetYear', 'sectors'));
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
            "fund_101" => "required|numeric|between:0," . $budgetYear->remainingFund101(),
            "fund_164" => "required|numeric|between:0," . $budgetYear->remainingFund164(),
            //"is_active" => "required|boolean"
        ]);

        if($validator->fails()){
            return back()
                    ->withErrors($validator, 'sector_budget')
                    ->withInput();
        }

        SectorBudget::create($validator->valid());

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SectorBudget  $sectorBudget
     * @return \Illuminate\Http\Response
     */
    public function show(SectorBudget $sectorBudget)
    {
        return $sectorBudget->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SectorBudget  $sectorBudget
     * @return \Illuminate\Http\Response
     */
    public function edit(SectorBudget $sectorBudget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SectorBudget  $sectorBudget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SectorBudget $sectorBudget)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SectorBudget  $sectorBudget
     * @return \Illuminate\Http\Response
     */
    public function destroy(SectorBudget $sectorBudget)
    {
        //
    }
}
