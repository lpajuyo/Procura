<?php

namespace App\Policies;

use App\User;
use App\BudgetProposal;
use Illuminate\Auth\Access\HandlesAuthorization;

class BudgetProposalPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the budget proposal.
     *
     * @param  \App\User  $user
     * @param  \App\BudgetProposal  $budgetProposal
     * @return mixed
     */
    public function view(User $user, BudgetProposal $budgetProposal)
    {
        $allowedUserTypes = ['Department Head'];

        if(in_array($user->type->name, $allowedUserTypes))
            return $user->id == $budgetProposal->user_id;
        else    
            return false;
    }

    public function viewFile(User $user){
        return $user->type->name == "Budget Officer";
    }

    /**
     * Determine whether the user can create budget proposals.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->type->name == "Department Head";
    }

    /**
     * Determine whether the user can update the budget proposal.
     *
     * @param  \App\User  $user
     * @param  \App\BudgetProposal  $budgetProposal
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->type->name == "Budget Officer";
    }

    /**
     * Determine whether the user can delete the budget proposal.
     *
     * @param  \App\User  $user
     * @param  \App\BudgetProposal  $budgetProposal
     * @return mixed
     */
    public function delete(User $user, BudgetProposal $budgetProposal)
    {
        //
    }

    /**
     * Determine whether the user can restore the budget proposal.
     *
     * @param  \App\User  $user
     * @param  \App\BudgetProposal  $budgetProposal
     * @return mixed
     */
    public function restore(User $user, BudgetProposal $budgetProposal)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the budget proposal.
     *
     * @param  \App\User  $user
     * @param  \App\BudgetProposal  $budgetProposal
     * @return mixed
     */
    public function forceDelete(User $user, BudgetProposal $budgetProposal)
    {
        //
    }

    public function approve(User $user, BudgetProposal $budgetProposal){
        return $user->type->name == "Budget Officer" && is_null($budgetProposal->is_approved);
    }
}
