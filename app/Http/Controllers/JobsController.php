<?php

namespace App\Http\Controllers;

use App\Job;
use App\Notifications\newNotification;
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

        $job = \App\Job::create($request->all());

        \Notification::send(\App\User::where('id', 1)->get(), new newNotification("Empleo '$job->title' pendiente validar."));
        return redirect('admin')->with('status', "¡Creaste una empleo!");
    }

    /**
     * @param Job $job
     * @return Job
     */
    public function show(Job $job)
    {
        return $job;
    }

    /**
     * @param Job $job
     */
    public function edit(Job $job)
    {
        //
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
        $job = \App\Job::find($job->id);
        $job->approved = $request->approved;
        $job->save();
        return redirect('/admin');
    }

    /**
     * @param Job $job
     */
    public function destroy(Job $job)
    {
        //
    }
}
