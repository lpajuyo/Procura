<?php

namespace App\Policies;

use App\User;
use App\PurchaseRequest;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Setting;

class PurchaseRequestPolicy
{
    use HandlesAuthorization;

    public function before($user){
        if($user->type->name == "Admin")
            return true;
    }

    /**
     * Determine whether the user can view the purchase request.
     *
     * @param  \App\User  $user
     * @param  \App\PurchaseRequest  $purchaseRequest
     * @return mixed
     */
    public function view(User $user, PurchaseRequest $purchaseRequest)
    {
        if($user->type->name == "Department Head"){
            return $purchaseRequest->requestor->id == $user->id;
        }
        else if($user->id == setting()->get('pr_approver_id', 8)){
            return true;
        }
    }

    public function viewPurchaseRequests(User $user){
        $allowedUserTypes = ['Department Head'];

        return in_array($user->type->name, $allowedUserTypes) || $user->id == setting()->get('pr_approver_id', 8);
    }

    /**
     * Determine whether the user can create purchase requests.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if($user->type->name == "Department Head"){
            return $user->projects()->where('is_approved', 1)->get()->count() != 0;
        }
    }

    /**
     * Determine whether the user can update the purchase request.
     *
     * @param  \App\User  $user
     * @param  \App\PurchaseRequest  $purchaseRequest
     * @return mixed
     */
    public function update(User $user, PurchaseRequest $purchaseRequest)
    {
        return $user->id == $purchaseRequest->requestor->id && is_null($purchaseRequest->submitted_at);
    }

    /**
     * Determine whether the user can delete the purchase request.
     *
     * @param  \App\User  $user
     * @param  \App\PurchaseRequest  $purchaseRequest
     * @return mixed
     */
    public function delete(User $user, PurchaseRequest $purchaseRequest)
    {
        return $user->id == $purchaseRequest->requestor->id && is_null($purchaseRequest->submitted_at);
    }

    /**
     * Determine whether the user can restore the purchase request.
     *
     * @param  \App\User  $user
     * @param  \App\PurchaseRequest  $purchaseRequest
     * @return mixed
     */
    public function restore(User $user, PurchaseRequest $purchaseRequest)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the purchase request.
     *
     * @param  \App\User  $user
     * @param  \App\PurchaseRequest  $purchaseRequest
     * @return mixed
     */
    public function forceDelete(User $user, PurchaseRequest $purchaseRequest)
    {
        //
    }

    public function approvePurchaseRequests(User $user){
    // return $user->type->name == "Sector Head";
    return $user->id == setting()->get('pr_approver_id', 8) && !is_null($user->user_signature);
    }

    public function approve(User $user, PurchaseRequest $purchaseRequest){
        // return $user->type->name == "Sector Head" && is_null($purchaseRequest->is_approved);
        return $user->id == setting()->get('pr_approver_id', 8) && is_null($purchaseRequest->is_approved) && !is_null($user->user_signature);
    }

    public function submit(User $user, PurchaseRequest $purchaseRequest){
        return $user->id == $purchaseRequest->requestor->id && is_null($purchaseRequest->submitted_at) && !is_null($user->user_signature);
    }

    public function unsubmit(User $user, PurchaseRequest $purchaseRequest){
        return $user->id == $purchaseRequest->requestor->id && !is_null($purchaseRequest->submitted_at) && is_null($purchaseRequest->is_approved);
    }
}
