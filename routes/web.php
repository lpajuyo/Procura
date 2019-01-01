<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::resource('budget_years', 'BudgetYearsController');

Route::get('budget_allocation', 'BudgetAllocationController');

Route::resource('sector_budgets', 'SectorBudgetsController');
Route::resource('department_budgets', 'DepartmentBudgetsController');

Route::resource('sectors', 'SectorsController');

// Route::get('sector_budgets', 'SectorBudgetsController@index');
// Route::post('sector_budgets', 'SectorBudgetsController@store');

Route::get('/user_BPhistory', function () {
    return view('user_BPhistory');
});

Route::get('bo_budgetProposals', function () {
    return view('bo_budgetProposals');
});

// Route::get('bo_budgetAlloc', function () {
//     return view('bo_budgetAlloc');
// });

Route::get('sector_budgetAlloc', function () {
    return view('sector_budgetAlloc');
});

Route::get('sector_BPhistory', function () {
    return view('sector_BPhistory');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
