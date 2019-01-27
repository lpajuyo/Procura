<?php

namespace App\Policies;

use App\User;
use App\DepartmentBudget;
use App\Department;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\BudgetYear;

class DepartmentBudgetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the department budget.
     *
     * @param  \App\User  $user
     * @param  \App\DepartmentBudget  $departmentBudget
     * @return mixed
     */
    public function view(User $user, DepartmentBudget $departmentBudget)
    {
        //
    }

    /**
     * Determine whether the user can create department budgets.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, BudgetYear $budgetYear)
    {
        $allowedUserTypes = ["Budget Officer", "Sector Head"];
        if(!in_array($user->type->name, $allowedUserTypes))
            return false;


        if($user->type->name == "Sector Head"){
            if($user->userable->sector->isAllocated($budgetYear))
                return $user->userable->sector->departments->count() != $user->userable->sector->isAllocated($budgetYear)->budget->allocatedDepartments->count();
            else {
                return false;
            }
        }
        else { //Budget Officer
            if($budgetYear->allocatedSectors->count() != 0){
                foreach($budgetYear->allocatedSectors as $sector){
                    $bool = $sector->departments->count() != $sector->budget->allocatedDepartments->count();
                }
                return $bool;
            }
            else{
                return false;
            }
        }
    }

    /**
     * Determine whether the user can update the department budget.
     *
     * @param  \App\User  $user
     * @param  \App\DepartmentBudget  $departmentBudget
     * @return mixed
     */
    public function update(User $user, DepartmentBudget $departmentBudget)
    {
        //
    }

    /**
     * Determine whether the user can delete the department budget.
     *
     * @param  \App\User  $user
     * @param  \App\DepartmentBudget  $departmentBudget
     * @return mixed
     */
    public function delete(User $user, DepartmentBudget $departmentBudget)
    {
        //
    }

    /**
     * Determine whether the user can restore the department budget.
     *
     * @param  \App\User  $user
     * @param  \App\DepartmentBudget  $departmentBudget
     * @return mixed
     */
    public function restore(User $user, DepartmentBudget $departmentBudget)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the department budget.
     *
     * @param  \App\User  $user
     * @param  \App\DepartmentBudget  $departmentBudget
     * @return mixed
     */
    public function forceDelete(User $user, DepartmentBudget $departmentBudget)
    {
        //
    }
}
