<?php

namespace App\Policies;

use App\User;
use App\Project;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\BudgetYear;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function before($user){
        if($user->type->name == "Admin")
            return true;
    }

    /**
     * Determine whether the user can view the project.
     *
     * @param  \App\User  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function view(User $user, Project $project)
    {
        if($user->type->name == "Department Head"){
            return $project->user->id == $user->id;
        }
        else if($user->type->name == "Sector Head"){
            return true;
        }
    }

    public function viewFile(User $user, Project $project){
        if($user->type->name == "Department Head"){
            return $project->user->id == $user->id;
        }
        else if($user->type->name == "Sector Head"){
            return true;
        }
    }

    public function viewProjects(User $user){
        $allowedUserTypes = ['Department Head', 'Sector Head'];

        return in_array($user->type->name, $allowedUserTypes);
    }

    /**
     * Determine whether the user can create projects.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if($user->type->name == "Department Head"){
            return $user->userable->department->isAllocated(BudgetYear::active()->first());
        }
    }

    /**
     * Determine whether the user can update the project.
     *
     * @param  \App\User  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function update(User $user, Project $project)
    {
        //
    }

    /**
     * Determine whether the user can delete the project.
     *
     * @param  \App\User  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function delete(User $user, Project $project)
    {
        return $user->id == $project->user_id && is_null($project->submitted_at);
    }

    /**
     * Determine whether the user can restore the project.
     *
     * @param  \App\User  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function restore(User $user, Project $project)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the project.
     *
     * @param  \App\User  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function forceDelete(User $user, Project $project)
    {
        //
    }

    public function approveProjects(User $user){
        return $user->type->name == "Sector Head";
    }

    public function approveProject(User $user, Project $project){
        return $user->type->name == "Sector Head" && is_null($project->is_approved);
    }

    public function submit(User $user, Project $project){
        return $user->id == $project->user_id && is_null($project->submitted_at);
    }

    public function unsubmit(User $user, Project $project){
        return $user->id == $project->user_id && !is_null($project->submitted_at) && is_null($project->is_approved);
    }
}
