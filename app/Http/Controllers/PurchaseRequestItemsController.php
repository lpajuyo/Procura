<?php

namespace App\Http\Controllers;

use App\PurchaseRequest;
use App\PurchaseRequestItem;
use Illuminate\Http\Request;
use App\ProjectItem;
use Illuminate\Support\Facades\Validator;

class PurchaseRequestItemsController extends Controller
{
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

        $validator = Validator::make($request->all(), [
            'project_item_id' => 'bail|required|exists:project_items,id',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator, 'create')
                        ->withInput();
        }

        $validator = Validator::make($request->all(), [
            'project_item_id' => 'bail|required|exists:project_items,id',
            'quantity' => 'bail|required_if:is_cse,1|nullable|numeric|between:1,'. ProjectItem::find(request()->project_item_id)->remaining_quantity,
            'specifications' => 'bail|required_if:is_cse,0|nullable|string',
            'total_cost' => 'required|numeric|between:1,'.$purchaseRequest->project->remaining_budget,
            // 'total_pr_cost' => 'required|numeric|between:'.$purchaseRequest->total_cost.','.
            // 'total_ppmp_budget' => 'required|numeric|between:'.$project->total_budget_with_contingency.','.$project->department_budget->remaining,
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator, 'create')
                        ->withInput();
        }
        
        $purchaseRequest->items()->create($validator->valid());

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
    public function edit(PurchaseRequest $purchaseRequest, PurchaseRequestItem $item)
    {
        return $item->load('project_item')->toJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurchaseRequestItem  $purchaseRequestItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseRequest $purchaseRequest, PurchaseRequestItem $item)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'bail|required_if:is_cse,1|nullable|numeric|between:1,'. bcadd($item->project_item->remaining_quantity, $item->quantity),
            'specifications' => 'bail|required_if:is_cse,0|nullable|string',
            'total_cost' => 'required|numeric|between:1,'.bcadd($purchaseRequest->project->remaining_budget, $item->total_cost),
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator, 'edit')
                        ->with('id', $item->id)
                        ->withInput();
        }

        $item->update($validator->valid());

        return back();
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
