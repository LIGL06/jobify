<?php

namespace App\Http\Controllers;

use App\Employee;
use App\User;
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
            $employee = Employee::create($request->all());
            $employer = \DB::table('employers')->
            join('jobs', 'employers.id', '=', 'jobs.employerId')->
            join('users', 'employers.userId', '=', 'users.id')->
            select('users.email')->groupBy('email')->pluck('email')->first();
            $name = $employee->user->name;

            \Notification::send(User::where('id', 1)->get(), new newNotification("'$name' aplicó un empleo.", User::where('id', 1)->get(), env('APP_URL') . '/admin'));
            \Notification::send(User::where('email', 'LIKE', "%{$employer}%")->get()->first(), new newNotification("'$name' aplicó un empleo.", User::where('email', 'LIKE', "%{$employer}%")->get()->first(), env('APP_URL') . '/employer'));
            \Notification::send(User::where('id', $request->userId)->get(), new newNotification("Aplicaste a {$request->user()->employee->job->title}", $employee, env('APP_URL') . '/employee'));
            return redirect('employees')->with('status', "¡Aplicaste a un empleo!");
        }
        return redirect('employees')->with('alert', "¡Ya habías aplicado a {$request->user()->employee->job->title}!");

    }

    /**
     * @param Employee $employee
     * @return Employee
     */
    public function show(Employee $employee)
    {
        $user = \App\User::where('id', $employee->userId)->with('info')->first();
        return view('employees.show', [
            'user' => $user,
            'employee' => $employee
        ]);
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
        $employee = Employee::find($employee->id);
        $employee->fill($request->all());
        $employee->save();
        if ($request->user()->isEmployee()) {
            return redirect('home')->with('status', "¡Aplicaste al empleo, {$employee->job->title}!");
        }
        \Notification::send(User::where('id', $employee->userId)->get(), new newNotification("Actualizaron tu estado en '{$employee->job->title}' a '{$request->status}'.", $employee, env('APP_URL') . '/employee'));
        return redirect('employers')->with('status', "¡Actualizaste una propiedad de {$employee->user->name}!");
    }

}
