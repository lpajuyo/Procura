<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ApprovedProjectsController extends Controller
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
    public function store(Request $request, Project $project)
    {
        // $this->authorize('approve', $budgetProposal);

        // $project->approve($request->remarks);
        $project->approve();

        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BudgetProposal  $budgetProposal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Project $project)
    {
        // $this->authorize('approve',$budgetProposal);

        // $project->reject($request->remarks);
        $project->reject();

        return redirect()->route('projects.index');
    }
}
