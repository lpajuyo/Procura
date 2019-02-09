<?php

namespace App\Http\Controllers;

use App\BudgetYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\User;
use App\Notifications\BudgetYearActivated;

class ActiveBudgetYearController extends Controller
{
    public function __invoke(BudgetYear $budgetYear)
    {
        $this->authorize('activate', $budgetYear);

        $budgetYear->activate();

        BudgetYear::where('id', '!=', $budgetYear->id)->update(['is_active' => false]);

        Notification::send(User::all(), new BudgetYearActivated());

        return redirect()->route('budget_years.index');
    }
}
