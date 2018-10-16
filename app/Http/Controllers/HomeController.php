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

    public function userDashboard(Request $request)
    {
        return $request->user()->role;
        switch ($request->user()->role){
            case 'admin':
                return 'You are admin';
                break;
            case 'employee':
                return 'You are employee';
                break;
            case 'employer':
                return 'You are employer';
                break;
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
}
