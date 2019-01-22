<?php

namespace App\Policies;

use App\User;
use App\SectorBudget;
use Illuminate\Auth\Access\HandlesAuthorization;

class SectorBudgetPolicy
{
    use HandlesAuthorization;

    public function before($user){
        if($user->type->name == "Admin")
            return true;
    }
    
    /**
     * Determine whether the user can view the sector budget.
     *
     * @param  \App\User  $user
     * @param  \App\SectorBudget  $sectorBudget
     * @return mixed
     */
    public function view(User $user, SectorBudget $sectorBudget)
    {
        //
    }

    /**
     * Determine whether the user can create sector budgets.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->type->name == "Budget Officer";
    }

    /**
     * Determine whether the user can update the sector budget.
     *
     * @param  \App\User  $user
     * @param  \App\SectorBudget  $sectorBudget
     * @return mixed
     */
    public function update(User $user, SectorBudget $sectorBudget)
    {
        //
    }

    /**
     * Determine whether the user can delete the sector budget.
     *
     * @param  \App\User  $user
     * @param  \App\SectorBudget  $sectorBudget
     * @return mixed
     */
    public function delete(User $user, SectorBudget $sectorBudget)
    {
        //
    }

    /**
     * Determine whether the user can restore the sector budget.
     *
     * @param  \App\User  $user
     * @param  \App\SectorBudget  $sectorBudget
     * @return mixed
     */
    public function restore(User $user, SectorBudget $sectorBudget)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the sector budget.
     *
     * @param  \App\User  $user
     * @param  \App\SectorBudget  $sectorBudget
     * @return mixed
     */
    public function forceDelete(User $user, SectorBudget $sectorBudget)
    {
        //
    }
}
