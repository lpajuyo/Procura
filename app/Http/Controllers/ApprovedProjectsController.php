<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Notifications\ProjectApproved;
use App\Notifications\ProjectRejected;

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
        $this->authorize('approveProject', $project);

        $project->approve($request->remarks);
        // $project->approve();

        $project->user->notify(new ProjectApproved());

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
        $this->authorize('approveProject', $project);

        $project->reject($request->remarks);
        // $project->reject();

        $project->user->notify(new ProjectRejected());

        return redirect()->route('projects.index');
    }
}
