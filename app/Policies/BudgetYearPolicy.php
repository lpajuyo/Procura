<?php

namespace App\Policies;

use App\User;
use App\BudgetYear;
use Illuminate\Auth\Access\HandlesAuthorization;

class BudgetYearPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability){
        if($user->type->name == "Admin"){
            if($ability == "activate")
                return null;
            else
                return true;
        }
    }

    /**
     * Determine whether the user can view the budget year.
     *
     * @param  \App\User  $user
     * @param  \App\BudgetYear  $budgetYear
     * @return mixed
     */
    public function view(User $user, BudgetYear $budgetYear)
    {
        //
    }

    public function viewBudgetYears(User $user){
        $allowedUserTypes = ['Budget Officer'];

        return in_array($user->type->name, $allowedUserTypes);
    }

    /**
     * Determine whether the user can create budget years.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->type->name == "Budget Officer";
    }

    /**
     * Determine whether the user can update the budget year.
     *
     * @param  \App\User  $user
     * @param  \App\BudgetYear  $budgetYear
     * @return mixed
     */
    public function update(User $user, BudgetYear $budgetYear)
    {
        return $user->type->name == "Budget Officer" && !($budgetYear->is_active);
    }

    /**
     * Determine whether the user can delete the budget year.
     *
     * @param  \App\User  $user
     * @param  \App\BudgetYear  $budgetYear
     * @return mixed
     */
    public function delete(User $user, BudgetYear $budgetYear)
    {
        return $user->type->name == "Budget Officer" && !($budgetYear->is_active);

    }

    /**
     * Determine whether the user can restore the budget year.
     *
     * @param  \App\User  $user
     * @param  \App\BudgetYear  $budgetYear
     * @return mixed
     */
    public function restore(User $user, BudgetYear $budgetYear)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the budget year.
     *
     * @param  \App\User  $user
     * @param  \App\BudgetYear  $budgetYear
     * @return mixed
     */
    public function forceDelete(User $user, BudgetYear $budgetYear)
    {
        //
    }

    public function activate(User $user, BudgetYear $budgetYear){
        return in_array($user->type->name, ['Budget Officer', 'Admin']) && $budgetYear->is_active == false;
    }
}
