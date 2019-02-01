<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BudgetYear;

class AppCseController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(BudgetYear $budgetYear)
    {
        dd($budgetYear);
    }
}
