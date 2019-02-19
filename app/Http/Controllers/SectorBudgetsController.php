<?php

namespace App\Http\Controllers;

use App\SectorBudget;
use App\BudgetYear;
use App\Sector;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SectorBudgetAllocated;

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

        $this->authorize('create', [SectorBudget::class, $budgetYear]);

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

        $sectorBudget = SectorBudget::create($validator->valid());

        if($budgetYear->is(BudgetYear::active()->first()))
            Notification::send($sectorBudget->sector->head->user, new SectorBudgetAllocated());

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
