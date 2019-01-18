<?php

namespace App\Http\Controllers;

use App\PurchaseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PurchaseRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchaseRequests = PurchaseRequest::all();

        return view('user_pr', compact('purchaseRequests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Auth::user()->projects;

        //create pr_number
        $now = new Carbon();
        $pr_year = $now->year;
        $pr_month = str_pad($now->month, 2, "0", STR_PAD_LEFT);
        $pr_serial = PurchaseRequest::whereYear('created_at', $pr_year)->count() + 1;
        $pr_number = $pr_year . '-' . $pr_month . '-' . str_pad($pr_serial, 4, "0", STR_PAD_LEFT);

        return view('create_purchase_request', compact('pr_number', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pr = PurchaseRequest::create(['project_id' => $request->project_id, 'pr_number' => $request->pr_number, 'purpose' => $request->purpose]);

        return redirect()->route('pr_items.create', ['purchase_request' => $pr->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseRequest $purchaseRequest)
    {
        return $purchaseRequest->load('items.project_item')->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseRequest $purchaseRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseRequest $purchaseRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseRequest $purchaseRequest)
    {
        //
    }
}
