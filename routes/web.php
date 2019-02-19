<?php

use App\Http\Controllers\SubmittedProjectsController;
use Illuminate\Http\Request;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('active_budget_year/{budget_year}', 'ActiveBudgetYearController')->name('budget_year.activate');
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

Route::post('submitted_projects/{project}', 'SubmittedProjectsController@store')->name('projects.submit');
Route::delete('submitted_projects/{project}', 'SubmittedProjectsController@destroy')->name('projects.cancel_submit');
Route::get('projects/{project}/file', 'ProjectsController@generateFile')->name('projects.generateFile');
Route::post('approved_projects/{project}', 'ApprovedProjectsController@store')->name('approve_project');
Route::delete('approved_projects/{project}', 'ApprovedProjectsController@destroy')->name('reject_project');
Route::resource('projects', 'ProjectsController');
Route::resource('projects/{project}/project_items', 'ProjectItemsController');

Route::post('submitted_pr/{purchase_request}', 'SubmittedPurchaseRequestsController@store')->name('pr.submit');
Route::delete('submitted_pr/{purchase_request}', 'SubmittedPurchaseRequestsController@destroy')->name('pr.cancel_submit');
Route::get('purchase_requests/{purchase_request}/file', 'PurchaseRequestsController@showFile')->name('purchase_requests.showFile');
Route::resource('purchase_requests', 'PurchaseRequestsController');
Route::resource('purchase_requests/{purchase_request}/items', 'PurchaseRequestItemsController')->names([
    'create' => 'pr_items.create',
    'store' => 'pr_items.store' 
]);
Route::post('approved_purchase_requests/{purchase_request}', 'ApprovedPurchaseRequestsController@store')->name('approve_pr');
Route::delete('approved_purchase_requests/{purchase_request}', 'ApprovedPurchaseRequestsController@destroy')->name('reject_pr');

Route::get('app_cse/{budget_year?}', 'AppCseController')->name('app_cse');
Route::get('app_non_cse/{budget_year?}', 'AppNonCseController')->name('app_non_cse');

Route::resource('cse_items', 'CseController');
Route::post('set_pr_approver', function (Request $request) {
    Setting::set('pr_approver_id', $request->pr_approver_id);
    Setting::save();
    return back();
})->name('pr_approver.set');
Route::patch('users/{user}/picture', 'UsersController@updatePicture')->name('users.update_picture');
Route::patch('users/{user}/password', 'UsersController@updatePassword')->name('users.update_password');
Route::resource('users', 'UsersController');

Route::get('/settings', 'AccountSettingsController');

//

