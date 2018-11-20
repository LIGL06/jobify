<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employer;
use App\Notifications\newNotification;
use App\User;
use Illuminate\Http\Request;
use Validator;

class EmployerController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if (isset($request->user()->employer->id)) {
            $employerId = $request->user()->employer->id;
            $myFranchises = Company::where('parentId', $request->user()->employer->company->id)->with('jobs')->get();
            $myEmployees = \DB::table('employees')->
            join('jobs', 'jobs.id', '=', 'employees.jobId')->
            join('users', 'users.id', '=', 'employees.userId')->
            where('jobs.EmployerId', $employerId)->
            select('name', 'email', 'status', 'title', 'subTitle', 'employees.id')->get();
            return view('employers.index', ['myEmployees' => $myEmployees, 'myFranchises' => $myFranchises]);
        }
        if (!$request->user()->isEmployer()) {
            return redirect('home');
        }
        return view('employers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $userId = User::where('email', $request->email)->pluck('id');
        $companyId = Company::where("name", "LIKE", "%{$request->company}%")->pluck('id');

        $employer = Employer::create([
            'userId' => $userId[0],
            'companyId' => $companyId[0]
        ]);
        if ($request->user()->isEmployee()) {
            return redirect('employer')->with('status', "¡Bienvenido empleador!");
        }
        return redirect('admin')->with('status', "¡Empleador {$employer->user->name} registrado!");
    }

    /**
     * @param Employer $employer
     * @return Employer
     */
    public function show(Employer $employer)
    {
        return $employer;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Employer $employer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employer $employer)
    {
        $employer = Employer::find($employer->id);
        $employer->approved = $request->approved;
        $employer->save();
        $name = $employer->user->name;
        return redirect('admin')->with('status', "¡Actualizaste a {$name}!");
    }


    public function destroy(Employer $employer)
    {
        //
    }
}
