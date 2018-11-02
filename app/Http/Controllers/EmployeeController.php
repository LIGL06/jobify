<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Notifications\newNotification;
use Illuminate\Http\Request;
use Validator;

class EmployeeController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if (!$request->user()->isEmployee()) {
            return redirect('home');
        }
        $jobs = \App\Job::all();
        $myJobs = Employee::where('userId', $request->user()->id)->get();
        return view('employees.index', [
            'jobs' => $jobs,
            'myJobs' => $myJobs
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userId' => 'required|integer',
            'companyId' => 'required|integer',
            'jobId' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect('employees/create')
                ->withErrors($validator)
                ->withInput();
        }
        $employee = Employee::where('userId', $request->user()->id)->where('jobId', $request->jobId)->get();
        if ($employee->count() == 0) {
            $employee = \App\Employee::create($request->all());
            $employer = \DB::table('employers')->
            join('jobs', 'employers.id', '=', 'jobs.employerId')->
            join('users', 'employers.userId', '=', 'users.id')->
            select('users.email')->groupBy('email')->pluck('email');
            $name = $employee->user->name;

            \Notification::send(\App\User::where('id', 1)->get(), new newNotification("'$name' aplicó un empleo."));
            \Notification::send(\App\User::where('email', 'LIKE', "%{$employer[0]}%")->get(), new newNotification("'$name' aplicó un empleo."));
            \Notification::send(\App\User::where('id', $request->userId)->get(), new newNotification("Aplicaste a un empleo."));
            return redirect('employees')->with('status', "¡Aplicaste a un empleo!");
        }
        return redirect('employees')->with('alert', "¡Ya habías aplicado a ese empleo!");

    }

    /**
     * @param Employee $employee
     * @return Employee
     */
    public function show(Employee $employee)
    {
        $user = \App\User::where('id', $employee->userId)->with('info')->get();
        return view('employees.show', [
            'user' => $user,
            'employee' => $employee
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $employee = \App\Employee::find($employee->id);
        $employee->fill($request->all());
        $employee->save();
        if ($request->user()->isEmployee()) {
            return redirect('home')->with('status', "¡Aplicaste a un empleo!");
        }
        \Notification::send(\App\User::where('id', $employee->userId)->get(), new newNotification("Actualizaron tu estado en '{$employee->job->title}'."));
        return redirect('employers')->with('status', "¡Validaste a {$employee->user->name}!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
