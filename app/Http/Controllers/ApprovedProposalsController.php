<?php

namespace App\Http\Controllers;

use App\BudgetProposal;
use Illuminate\Http\Request;

class ApprovedProposalsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BudgetProposal $budgetProposal)
    {
        $this->authorize('approve', BudgetProposal::class);

        $budgetProposal->approve();

        return redirect('/budget_proposals');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BudgetProposal  $budgetProposal
     * @return \Illuminate\Http\Response
     */
    public function destroy(BudgetProposal $budgetProposal)
    {
        $this->authorize('approve', BudgetProposal::class);

        $budgetProposal->reject();

        return redirect('budget_proposals');
    }
}
