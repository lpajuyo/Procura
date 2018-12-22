<?php

namespace App\Http\Controllers;

use App\SectorBudget;
use Illuminate\Http\Request;

class SectorBudgetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectorBudgets = SectorBudget::all();

        return view('bo_budgetAlloc', compact('sectorBudgets'));
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
     * @param  \App\SectorBudget  $sectorBudget
     * @return \Illuminate\Http\Response
     */
    public function show(SectorBudget $sectorBudget)
    {
        //
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
