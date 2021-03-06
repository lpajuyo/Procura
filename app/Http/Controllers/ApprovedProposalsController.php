<?php

namespace App\Http\Controllers;

use App\BudgetProposal;
use Illuminate\Http\Request;
use App\Notifications\BudgetProposalApproved;
use App\Notifications\BudgetProposalRejected;

class ApprovedProposalsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, BudgetProposal $budgetProposal)
    {
        $this->authorize('approve', $budgetProposal);

        $budgetProposal->approve($request->remarks);

        $budgetProposal->submitter->notify(new BudgetProposalApproved);

        return redirect('/budget_proposals');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BudgetProposal  $budgetProposal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, BudgetProposal $budgetProposal)
    {
        $this->authorize('approve',$budgetProposal);

        $budgetProposal->reject($request->remarks);

        $budgetProposal->submitter->notify(new BudgetProposalRejected);

        return redirect('budget_proposals');
    }
}
