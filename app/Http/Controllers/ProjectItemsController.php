<?php

namespace App\Http\Controllers;

use App\ProjectItem;
use App\Project;
use App\CommonUseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use App\ItemType;

class ProjectItemsController extends Controller
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
    public function create(Project $project)
    {
        $this->authorize('create', Project::class);
        $this->authorize('update', $project);

        $cseItems = CommonUseItem::all();
        $itemTypes = ItemType::all();

        return view('add_project_item', compact('project', 'cseItems', 'itemTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        $this->authorize('create', Project::class);

        // dd($request->all());
        // $attributes = $request->all();
        $attributes = $request->validate([
            'item_type_id' => 'required|exists:item_types,id',
            'code' => 'nullable|string',
            'description' => 'required|string',
            'quantity' => 'bail|required|numeric|min:1', //gte:schedules
            'uom' => 'nullable|string', // exists? || in:array?
            'unit_cost' => 'bail|required|numeric|min:1',  
            'estimated_budget' => 'bail|required|numeric|min:1|gte:unit_cost', //between 0 and dept budget
            'procurement_mode' => 'nullable|string',   //exists:procurement_modes?
            'schedules' => [
                'required', 
                'array', 
                function($attr, $val, $fail){
                    if(!Collection::wrap($val)->sum('quantity') == request()->quantity)
                        $fail('Total schedules quantity should be equal to the quantity field.');
                },
                function($attr, $val, $fail){
                    $val = collect($val);
                    // dd($val->keys()->max());
                    if(!($val->keys()->unique()->count() == $val->keys()->count() && ($val->keys()->min() >= 1 && $val->keys()->max() <= 12)))
                        $fail("Invalid schedule/s.");
                }
            ],
            'schedules.*.quantity' => 'nullable|numeric',
            'total_ppmp_budget' => 'required|numeric|between:'.$project->total_budget_with_contingency.','.$project->department_budget->remaining,
            'is_cse' => 'required|boolean'
        ]);
        
        // dd($attributes);

        $project->addItem($attributes);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjectItem  $projectItem
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectItem $projectItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectItem  $projectItem
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project, ProjectItem $projectItem)
    {
        $this->authorize('update', $project);

        $cseItems = CommonUseItem::all();

        return view('edit_project_item', compact('project', 'projectItem', 'cseItems'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectItem  $projectItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project, ProjectItem $projectItem)
    {
        $this->authorize('update', $project);
        
        // dd($request->all());
        $origTotalBudget = $project->total_budget_with_contingency;
        $project->total_budget -= $projectItem->estimated_budget;
        $itemTotalWithContingency = bcsub($origTotalBudget, $project->total_budget_with_contingency);
        $remaining = bcadd($project->department_budget->remaining, $itemTotalWithContingency);
        
        $attributes = $request->validate([
            'code' => 'nullable|string',
            'description' => 'required|string',
            'quantity' => 'bail|required|numeric|min:1', //gte:schedules
            'uom' => 'nullable|string', // exists? || in:array?
            'unit_cost' => 'bail|required|numeric|min:1',  
            'estimated_budget' => 'bail|required|numeric|min:1|gte:unit_cost', //between 0 and dept budget
            'procurement_mode' => 'nullable|string',   //exists:procurement_modes?
            'schedules' => [
                'required', 
                'array', 
                function($attr, $val, $fail){
                    // dump(Collection::wrap($val)->sum('quantity'));
                    if(Collection::wrap($val)->sum('quantity') != request()->quantity)
                        $fail('Total schedules quantity should be equal to the quantity field.');
                },
                function($attr, $val, $fail){
                    $val = collect($val);
                    // dd($val->keys()->max());
                    if(!($val->keys()->unique()->count() == $val->keys()->count() && ($val->keys()->min() >= 1 && $val->keys()->max() <= 12)))
                        $fail("Invalid schedule/s.");
                }
            ],
            'schedules.*.quantity' => 'nullable|numeric',
            'total_ppmp_budget' => 'required|numeric|between:'.$project->total_budget_with_contingency.','.$remaining,
            'is_cse' => 'required|boolean'
        ]);

        $project->updateItem($projectItem, $attributes);

        return redirect()->route('project_items.create', ['project' => $project->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectItem  $projectItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, ProjectItem $projectItem)
    {
        $projectItem->delete();

        return back();
    }
}
