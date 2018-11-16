<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Job;
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
        $jobs = Job::orderBy($request->input('sort', 'title'))->paginate(6);
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
        $job = Job::where('id', $request->jobId)->first();
        if ($employee->count() == 0) {
            $employee = new Employee();
            $employee->fill($request->all());
            $employee->status = 'Pre-confirmación';
            $employee->save();
            $employer = \DB::table('employers')->
            join('jobs', 'employers.id', '=', 'jobs.employerId')->
            join('users', 'employers.userId', '=', 'users.id')->
            select('users.email')->groupBy('email')->pluck('email')->first();
            $name = $employee->user->name;

            $employer = User::where('email', 'LIKE', "%{$employer}%")->first();
            $user = User::where('id', $request->user()->id)->first();

            \Notification::send($employer, new newNotification("'$name' aplicó un empleo.", $employer, env('APP_URL') . '/employer'));
            \Notification::send($user, new newNotification("Aplicaste a {$job->title}", $user, env('APP_URL') . '/employee'));
            return redirect('employees')->with('status', "¡Aplicaste a {$job->title}!");
        }
        return redirect('employees')->with('alert', "¡Ya habías aplicado a {$job->title}!");

    }

    /**
     * @param Employee $employee
     * @return Employee
     */
    public function show(Employee $employee)
    {
        $user = User::where('id', $employee->userId)->with('info')->first();
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
        \Notification::send(User::where('id', $employee->userId)->get(), new newNotification("Actualizaron tu estado en '{$employee->job->title}' a '{$employee->status}'.", $employee, env('APP_URL') . '/employee'));
        return redirect('employers')->with('status', "¡Actualizaste una propiedad de {$employee->user->name}!");
    }

}
