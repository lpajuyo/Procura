<?php

namespace App\Http\Controllers;

use App\BudgetProposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BudgetProposalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $budgetProposals = BudgetProposal::all();

        return view('bo_budgetProposals', compact('budgetProposals'));
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
     * @param  \App\BudgetProposal  $budgetProposal
     * @return \Illuminate\Http\Response
     */
    public function show(BudgetProposal $budgetProposal)
    {
        $file = $budgetProposal->proposal_file;

        return Storage::download('/proposal_files/' . $file);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BudgetProposal  $budgetProposal
     * @return \Illuminate\Http\Response
     */
    public function edit(BudgetProposal $budgetProposal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BudgetProposal  $budgetProposal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BudgetProposal $budgetProposal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BudgetProposal  $budgetProposal
     * @return \Illuminate\Http\Response
     */
    public function destroy(BudgetProposal $budgetProposal)
    {
        //
    }
}
