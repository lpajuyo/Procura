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
    return view('user_dashboard');
});

Route::get('/user_BPhistory', function () {
    return view('user_BPhistory');
});

Route::get('bo_budgetProposals', function () {
    return view('bo_budgetProposals');
});

Route::get('bo_budgetAlloc', function () {
    return view('bo_budgetAlloc');
});

Route::get('bo_budgetYear', function () {
    return view('bo_budgetYear');
});

Route::get('sector_budgetAlloc', function () {
    return view('sector_budgetAlloc');
});

Route::get('sector_BPhistory', function () {
    return view('sector_BPhistory');
});