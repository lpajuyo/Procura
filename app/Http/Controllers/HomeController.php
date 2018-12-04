<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        switch($request->user()->user_type_id){
            case 1:
                return view('user_dashboard');
            case 2:
                return view('bo_dashboard');
            case 3:
                return view('sector_dashboard');
        }
        //return view('home');
    }
}
