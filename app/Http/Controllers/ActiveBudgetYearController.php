<?php

namespace App\Http\Controllers;

use App\BudgetYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\User;
use App\Notifications\BudgetYearActivated;
use App\Notifications\SectorBudgetAllocated;
use App\Notifications\DepartmentBudgetAllocated;

class ActiveBudgetYearController extends Controller
{
    public function __invoke(BudgetYear $budgetYear)
    {
        $this->authorize('activate', $budgetYear);

        $budgetYear->activate();

        BudgetYear::where('id', '!=', $budgetYear->id)->update(['is_active' => false]);

        Notification::send(User::where('id', '!=', request()->user()->id)->get(), new BudgetYearActivated());

        foreach($budgetYear->allocatedSectors as $sector){
            Notification::send($sector->head->user, new SectorBudgetAllocated());
        }

        foreach($budgetYear->departmentBudgets as $deptBudget){
            Notification::send($deptBudget->department->head->user, new DepartmentBudgetAllocated());
        }

        return redirect()->route('budget_years.index');
    }
}
