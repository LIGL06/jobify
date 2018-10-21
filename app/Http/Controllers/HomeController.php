<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\newEmployeeNotification;

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
     * @return mixed
     */
    public function getNotifications()
    {
        return auth()->user()->unreadNotifications;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function markNotification(Request $request){
        return auth()->user()->unreadNotifications->find($request->not_id)->markAsRead();
    }

    public function adminDashboard()
    {
        $companiesCount = \App\Company::count();
        $jobCounts = \App\Job::count();
        $employeesCounts = \App\Employee::count();
        $employersCounts = \App\Employer::count();

        $jobs = \App\Job::where('vacancies', '>', 0)->orderBy('created_at', 'desc')->get();
        $employees = \App\Employee::where('approved', 0)->orderBy('created_at', 'desc')->get();
        $companies = \App\Company::where('approved', 0)->orderBy('created_at', 'desc')->get();
        $employers = \App\Employer::where('approved', 0)->orderBy('created_at', 'desc')->get();

        return view('admin.home', [
            'companiesCount' => $companiesCount,
            'jobCounts' => $jobCounts,
            'employeesCounts' => $employeesCounts,
            'employersCounts' => $employersCounts,
            'jobs' => $jobs,
            'employees' => $employees,
            'companies' => $companies,
            'employers' => $employers
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
