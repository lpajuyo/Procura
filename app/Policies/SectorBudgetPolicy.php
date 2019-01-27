<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\SectorBudget;
use App\Sector;
use App\BudgetYear;

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
    public function view(User $user, Sector $sector)
    {
        $allowedUserTypes = ['Budget Officer', 'Sector Head'];

        if (in_array($user->type->name, $allowedUserTypes) && $user->type->name == 'Sector Head') {
            return $user->userable->sector_id == $sector->id;
        } else {
            return in_array($user->type->name, $allowedUserTypes);
        }
    }

    /**
     * Determine whether the user can create sector budgets.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, BudgetYear $budgetYear = null)
    {   
        $allowedUserTypes = ["Budget Officer"];
        if(!in_array($user->type->name, $allowedUserTypes))
            return false;


        if($budgetYear == null)
            return true;
        else
            return Sector::all()->count() != $budgetYear->allocatedSectors->count();
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
