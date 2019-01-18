<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\BudgetProposal' => 'App\Policies\BudgetProposalPolicy',
        'App\SectorBudget' => 'App\Policies\SectorBudgetPolicy',
        'App\Project' => 'App\Policies\ProjectPolicy',
        'App\PurchaseRequest' => 'App\Policies\PurchaseRequestPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
