<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Job;
use App\JobInfo;
use App\Notifications\newNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class JobsController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function autoComplete(Request $request)
    {
        $subTitles = DB::table('job_subdescription')->where("name", "LIKE", "%{$request->input('query')}%")->pluck('name');
        return response()->json($subTitles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $companies = \App\Company::all();
        $employers = \App\Employer::all();
        return view('jobs.create', [
            'companies' => $companies,
            'employers' => $employers
        ]);
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
            'title' => 'required|max:100',
            'subTitle' => 'required|max:50',
            'companyId' => 'required|integer',
            'vacancies' => 'required|integer',
            'required' => 'required|boolean',
            'employerId' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect('jobs/create')
                ->withErrors($validator)
                ->withInput();
        }

        $job = Job::create($request->all());
        JobInfo::updateOrCreate([
            'jobId' => $job->id,
            'skills' => $request->skills
        ], ['jobId', $job->id]);
        $admin = User::where('id', 1)->first();
        \Notification::send($admin, new newNotification("Empleo '$job->title' pendiente validar.", $admin, env('APP_URL') . '/admin'));

        if ($request->user()->isAdmin()) {
            return redirect('admin')->with('status', "¡Creaste una empleo!");
        }
        if ($request->user()->isEmployer()) {
            $employer = User::where('id', $request->user()->id)->first();
            \Notification::send($employer, new newNotification("Tu Empleo '$job->title' está pendiente de validar, pero pueden registrarse los aspirantes.", $employer, env('APP_URL') . '/employer'));
            return redirect('employers')->with('status', "¡Creaste una empleo!");
        }

    }

    /**
     * @param Job $job
     * @return Job
     */
    public function show(Job $job)
    {
        return redirect()->route('home');
    }

    /**
     * @param Job $job
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Job $job)
    {
        return view('jobs.edit', ['job' => $job]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Job $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        $job = Job::find($job->id);
        $job->fill($request->all())->save();
        JobInfo::updateOrCreate([
            'jobId' => $job->id,
            'skills' => $request->skills
        ], ['jobId', $job->id]);
        return redirect('/admin');
    }

    /**
     * @param Job $job
     * @return Job
     * @throws \Exception
     */
    public function destroy(Job $job)
    {
        $employees = Employee::where('jobId', $job->id)->with('user')->get();
        foreach ($employees as $employee) {
            \Notification::send($employee->user, new newNotification("El empleo '$job->title' se ha dado de baja, gracias por aplicar.", $employee->user, env('APP_URL') . '/employer'));
        }
        $job->delete();
        return $job;

    }
}
