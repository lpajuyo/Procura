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

Route::get('budget_allocation/{budgetYear?}', 'BudgetAllocationController')->name('budget_alloc');

Route::resource('sector_budgets', 'SectorBudgetsController');
Route::resource('department_budgets', 'DepartmentBudgetsController');
// Route::get('sector_budgets', 'SectorBudgetsController@index');
// Route::post('sector_budgets', 'SectorBudgetsController@store');

Route::resource('sectors', 'SectorsController');

Route::resource('budget_proposals', 'BudgetProposalsController');
Route::get('budget_proposals/{budget_proposal}/file', 'BudgetProposalsController@showFile')->name('budget_proposals.showFile');

Route::post('approved_proposals/{budgetProposal}', 'ApprovedProposalsController@store')->name('approve_proposal');
Route::delete('approved_proposals/{budgetProposal}', 'ApprovedProposalsController@destroy')->name('reject_proposal');

Route::get('projects/{project}/file', 'ProjectsController@generateFile')->name('projects.generateFile');
Route::resource('projects', 'ProjectsController');
Route::resource('projects/{project}/items', 'ProjectItemsController');
Route::post('approved_projects/{project}', 'ApprovedProjectsController@store')->name('approve_project');
Route::delete('approved_projects/{project}', 'ApprovedProjectsController@destroy')->name('reject_project');

Route::resource('purchase_requests', 'PurchaseRequestsController');
Route::resource('purchase_requests/{purchase_request}/items', 'PurchaseRequestItemsController');

//
Route::get('/user_BPhistory', function () {
    return view('user_BPhistory');
});

Route::get('/user_viewppmp', function () {
    return view('user_viewppmp');
});

Route::get('/user_pr', function () {
    return view('user_pr');
});

Route::get('/user_createpr', function () {
    return view('user_createpr');
});

Route::get('/user_createppmp', function () {
    return view('user_createppmp');
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

Route::get('sector_ppmp', function () {
    return view('sector_ppmp');
});

Route::get('sector_pr', function () {
    return view('sector_pr');
});

Route::get('test', 'CseController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
