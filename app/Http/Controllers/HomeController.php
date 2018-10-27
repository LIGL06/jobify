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
    public function markNotification(Request $request)
    {
        return auth()->user()->unreadNotifications->find($request->not_id)->markAsRead();
    }

    /**
     * @return mixed
     */
    public function markAllNotifications()
    {
        return auth()->user()->unreadNotifications->markAsRead();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminDashboard()
    {
        $companiesCount = \App\Company::count();
        $jobCounts = \App\Job::count();
        $employeesCounts = \App\Employee::count();
        $employersCounts = \App\Employer::count();

        $jobs = \App\Job::where('vacancies', '>', 0)->orderBy('created_at', 'desc')->get();
        $employees = \App\Employee::orderBy('created_at', 'desc')->get();
        $companies = \App\Company::orderBy('created_at', 'desc')->get();
        $employers = \App\Employer::orderBy('created_at', 'desc')->get();

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
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index(Request $request)
    {
        if($request->user()->isEmployer()){
            return redirect('employers');
        }
        if($request->user()->isEmployee()){
            return redirect('employees');
        }
        if($request->user()->isAdmin()){
            return redirect('admin');
        }
    }

    public function autoComplete(Request $request)
    {
        $subTitles = \DB::table('users')->where("email", "LIKE", "%{$request->input('query')}%")->pluck('email');
        return response()->json($subTitles);
    }
}
