<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BudgetYear;
use Carbon\Carbon;
use App\BudgetProposal;
use App\Project;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        switch($request->user()->type->name){
            case "Department Head":
                return $this->viewUserDashboard();
                break;
            case "Budget Officer":
                return $this->viewBoDashboard();
                break;
            case "Sector Head":
                return $this->viewSectorDashboard();
                break;
            case "Admin":
                return view('admin_dashboard');
            default:
                return view('user_dashboard');
        }
        //return view('home');
    }

    public function viewUserDashboard()
    {
        $budgetYear = BudgetYear::active()->first();

        if($budgetYear){
            $deptBudget = request()->user()->userable->department->isAllocated($budgetYear)->budget;

            //purchases made calc (line chart)
            $purchaseRequests = request()->user()->purchase_requests()->approved()->get();
            $purchaseRequests = $purchaseRequests->filter(function($value, $key){ //filter prs for this year only
                return $value->updated_at->year == Carbon::now()->year;
            });
            $purchaseRequests = $purchaseRequests->groupBy(function($item, $key){
                return $item['updated_at']->month;
            });
            $purchasesMade = [];
            for($i = 1; $i <= 12; $i++){
                if(isset($purchaseRequests[$i]))
                    $purchasesMade[] = $purchaseRequests[$i]->count();
                else
                    $purchasesMade[] = 0;
            }

            //annual budget (bar chart)
            $currentYear = Carbon::now()->year;
            for($i = $currentYear - 6; $i <= $currentYear; $i++){
                $yearLabels[] = $i;
                if(BudgetYear::where('budget_year', $i)->first() != null){
                    if(request()->user()->userable->department->isAllocated(BudgetYear::where('budget_year', $i)->first()))
                        $yearAmounts[] = request()->user()->userable->department->isAllocated(BudgetYear::where('budget_year', $i)->first())->budget->total;
                    else
                        $yearAmounts[] = 0;
                }
                else
                    $yearAmounts[] = 0;
            }

            //ppmp percentages
            $projects = request()->user()->projects()->where('budget_year_id', $budgetYear->id)->get();
            if($projects->count() != 0){
                $pendingPercentage = bcmul(bcdiv($projects->whereStrict('is_approved', null)->count(), $projects->count(), 5), 100, 5);
                $approvedPercentage = bcmul(bcdiv($projects->whereStrict('is_approved', 1)->count(), $projects->count(), 5), 100, 5);
                $rejectedPercentage = bcmul(bcdiv($projects->whereStrict('is_approved', 0)->count(), $projects->count(), 5), 100, 5);
            }
        }

        return view('user_dashboard', compact('budgetYear', 'deptBudget', 'purchasesMade', 'yearLabels', 'yearAmounts', 'pendingPercentage', 'approvedPercentage', 'rejectedPercentage'));
    }

    public function viewBoDashboard()
    {
        $budgetYear = BudgetYear::active()->first();

        if($budgetYear){
            //annual budget (bar chart)
            $currentYear = Carbon::now()->year;
            for($i = $currentYear - 6; $i <= $currentYear; $i++){
                $yearLabels[] = $i;
                if(BudgetYear::where('budget_year', $i)->first() != null)
                    $yearAmounts[] = BudgetYear::where('budget_year', $i)->first()->total();
                else
                    $yearAmounts[] = 0;
            }

            //budget proposals
            $budgetProposals = BudgetProposal::where('for_year', $budgetYear->budget_year)->get();
            $pendingPercentage = bcmul(bcdiv($budgetProposals->whereStrict('is_approved', null)->count(), $budgetProposals->count(), 5), 100, 5);
            $approvedPercentage = bcmul(bcdiv($budgetProposals->whereStrict('is_approved', 1)->count(), $budgetProposals->count(), 5), 100, 5);
            $rejectedPercentage = bcmul(bcdiv($budgetProposals->whereStrict('is_approved', 0)->count(), $budgetProposals->count(), 5), 100, 5);
        }

        return view('bo_dashboard', compact('budgetYear', 'yearLabels', 'yearAmounts', 'pendingPercentage', 'approvedPercentage', 'rejectedPercentage'));
    }

    public function viewSectorDashboard()
    {
        $budgetYear = BudgetYear::active()->first();

        if($budgetYear){
            $sectorBudget = request()->user()->userable->sector->isAllocated($budgetYear)->budget;

            //annual budget (bar chart)
            $currentYear = Carbon::now()->year;
            for($i = $currentYear - 6; $i <= $currentYear; $i++){
                $yearLabels[] = $i;
                if(BudgetYear::where('budget_year', $i)->first() != null){
                    if(request()->user()->userable->sector->isAllocated(BudgetYear::where('budget_year', $i)->first()))
                        $yearAmounts[] = request()->user()->userable->sector->isAllocated(BudgetYear::where('budget_year', $i)->first())->budget->total();
                    else
                        $yearAmounts[] = 0;
                }
                else
                    $yearAmounts[] = 0;
            }

            //ppmp percentages
            $projects = Project::all();
            $projects = $projects->filter(function($project){
                return $project->approver->id == Auth::user()->id;
            });
            if($projects->count() != 0){
                $pendingPercentage = bcmul(bcdiv($projects->whereStrict('is_approved', null)->count(), $projects->count(), 5), 100, 5);
                $approvedPercentage = bcmul(bcdiv($projects->whereStrict('is_approved', 1)->count(), $projects->count(), 5), 100, 5);
                $rejectedPercentage = bcmul(bcdiv($projects->whereStrict('is_approved', 0)->count(), $projects->count(), 5), 100, 5);
            }
        }

        return view('sector_dashboard', compact('budgetYear', 'sectorBudget', 'yearLabels', 'yearAmounts', 'pendingPercentage', 'approvedPercentage', 'rejectedPercentage'));
    }
}
