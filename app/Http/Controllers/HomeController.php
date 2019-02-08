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
        switch($request->user()->type->name){
            case "Department Head":
                return view('user_dashboard');
            case "Budget Officer":
                return view('bo_dashboard');
            case "Sector Head":
                return view('sector_dashboard');
            case "Admin":
                return view('admin_dashboard');
            default:
                return view('user_dashboard');
        }
        //return view('home');
    }
}
