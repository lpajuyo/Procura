<?php

namespace App\Http\Controllers;

use App\PurchaseRequest;
use App\PurchaseRequestItem;
use Illuminate\Http\Request;

class PurchaseRequestItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd("test");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PurchaseRequest $purchaseRequest)
    {
        $this->authorize('create', PurchaseRequest::class);

        $projectItems = $purchaseRequest->project->items;

        return view('user_create_pr_item', compact('projectItems', 'purchaseRequest'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PurchaseRequest $purchaseRequest)
    {
        $this->authorize('create', PurchaseRequest::class);

        // dd($request->all());

        $attributes = $request->all();

        $purchaseRequest->items()->create($attributes);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PurchaseRequestItem  $purchaseRequestItem
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseRequestItem $purchaseRequestItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PurchaseRequestItem  $purchaseRequestItem
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseRequestItem $purchaseRequestItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurchaseRequestItem  $purchaseRequestItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseRequestItem $purchaseRequestItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PurchaseRequestItem  $purchaseRequestItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseRequest $purchaseRequest, PurchaseRequestItem $item)
    {
        // dd($item);

        $item->delete();

        return back();
    }
}
