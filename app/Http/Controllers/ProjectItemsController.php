<?php

namespace App\Http\Controllers;

use App\ProjectItem;
use App\Project;
use Illuminate\Http\Request;

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
        return view('add_project_item', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        // dd($request->all());
        $attributes = $request->all();
        $project->addItem($attributes);
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
    public function edit(ProjectItem $projectItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectItem  $projectItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectItem $projectItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectItem  $projectItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectItem $projectItem)
    {
        //
    }
}
