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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subTitles = DB::table('job_subdescription')->limit(5)->get();
        $companies = \App\Company::all();
        $employers = \App\Employer::all();
        return view('jobs.create', [
            'companies' => $companies,
            'employers' => $employers,
            'subTitles' => $subTitles
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

        if (\Notification::send(\App\User::where('id', 1)->get(), new newNotification("Empleo '$job->title' pendiente validar."))) {
            return back();
        }
        return redirect('admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job $job
     * @return \Illuminate\Http\Response
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
    }
}
