<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use App\Notifications\ProjectSubmitted;

class SubmittedProjectsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        $this->authorize('submit', $project);

        $project->submit();

        $project->approver->notify(new ProjectSubmitted());

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $this->authorize('unsubmit', $project);

        $project->unsubmit();

        return back();
    }
}
