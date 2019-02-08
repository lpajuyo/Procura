<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Sector;
use App\Department;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\BudgetProposal' => 'App\Policies\BudgetProposalPolicy',
        'App\BudgetYear' => 'App\Policies\BudgetYearPolicy',
        'App\SectorBudget' => 'App\Policies\SectorBudgetPolicy',
        'App\DepartmentBudget' => 'App\Policies\DepartmentBudgetPolicy',
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

        // Gate::before(function($user){
        //     if($user->type->name == "Admin")
        //         return true;
        // });

        Gate::define('viewBudgetAlloc', function($user){
            $allowedUserTypes = ['Budget Officer', 'Sector Head', 'Admin'];
    
            return in_array($user->type->name, $allowedUserTypes);
        });

        Gate::define('view-APP', function($user){
            return $user->type->name == "BAC Secretariat";
        });

        Gate::define('administer', function($user){
            return $user->type->name == "Admin";
        });
    }
}
