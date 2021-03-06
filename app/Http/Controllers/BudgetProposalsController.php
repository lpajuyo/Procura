<?php

namespace App\Http\Controllers;

use App\BudgetProposal;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\BudgetProposalSubmitted;

class BudgetProposalsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewBudgetProposals', BudgetProposal::class);

        if(Auth::user()->type->name == "Budget Officer")
            $budgetProposals = BudgetProposal::orderByRaw('IF(is_approved IS NULL, 0, 1), is_approved DESC')
                                                ->orderBy('for_year')
                                                ->latest('updated_at')
                                                ->get();
        else
            $budgetProposals = BudgetProposal::orderByRaw('IF(is_approved IS NULL, 0, 1), is_approved DESC')
                                                ->orderBy('for_year')
                                                ->latest('updated_at')
                                                ->where('user_id', Auth::user()->id)
                                                ->get();

        return view('bo_budgetProposals', compact('budgetProposals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', BudgetProposal::class);

        $validator = Validator::make($request->all(), [
            "for_year" => "bail|required|numeric|digits:4|min:".date('Y', strtotime("this year"))."|date_format:Y",
            "proposal_name" => "required|string",
            "amount" => "required|numeric",
            "proposal_file" => "required|mimes:pdf,docx,doc,zip|max:32000",
        ]);

        if($validator->fails()){
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $attributes = $validator->valid();
        $attributes['proposal_file'] = $attributes['proposal_file']->store('proposal_files');
        Auth::user()->addProposal($attributes);

        Notification::send(User::where('user_type_id', 2)->get(), new BudgetProposalSubmitted());

        return redirect('budget_proposals');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BudgetProposal  $budgetProposal
     * @return \Illuminate\Http\Response
     */
    public function show(BudgetProposal $budgetProposal)
    {
        $this->authorize('view', $budgetProposal);

        return $budgetProposal->toJson();
    }

    public function showFile(BudgetProposal $budgetProposal){
        $this->authorize('viewFile', BudgetProposal::class);

        $file = $budgetProposal->proposal_file;

        return Storage::download($file, $budgetProposal->proposal_name . '.' . \File::extension($file));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BudgetProposal  $budgetProposal
     * @return \Illuminate\Http\Response
     */
    public function edit(BudgetProposal $budgetProposal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BudgetProposal  $budgetProposal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BudgetProposal $budgetProposal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BudgetProposal  $budgetProposal
     * @return \Illuminate\Http\Response
     */
    public function destroy(BudgetProposal $budgetProposal)
    {
        //
    }
}
