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

    public function adminDashboard()
    {
        $userCounts = \App\User::count();
        $jobCounts = \App\Job::count();
        $employeesCounts = \App\Employee::count();
        $employersCounts = \App\Employer::count();

        return view('admin.home', [
            'userCounts' => $userCounts,
            'jobCounts' => $jobCounts,
            'employeesCounts' => $employeesCounts,
            'employersCounts' => $employersCounts,
        ]);
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
