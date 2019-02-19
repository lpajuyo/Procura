<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchaseRequest;

class ApprovedPurchaseRequestsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PurchaseRequest $purchaseRequest)
    {
        $this->authorize('approve', $purchaseRequest);

        $purchaseRequest->approve($request->remarks);
        // $purchaseRequest->approve();

        return redirect()->route('purchase_requests.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BudgetProposal  $budgetProposal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PurchaseRequest $purchaseRequest)
    {
        $this->authorize('approve', $purchaseRequest);

        $purchaseRequest->reject($request->remarks);
        // $purchaseRequest->reject();

        return redirect()->route('purchase_requests.index');
    }
}
