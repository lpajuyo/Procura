<?php

namespace App\Http\Controllers;

use App\PurchaseRequest;
use Illuminate\Http\Request;

class SubmittedPurchaseRequestsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PurchaseRequest $purchaseRequest)
    {
        $this->authorize('submit', $purchaseRequest);

        $purchaseRequest->submit();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseRequest $purchaseRequest)
    {
        $this->authorize('unsubmit', $purchaseRequest);

        $purchaseRequest->unsubmit();

        return back();
    }
}
