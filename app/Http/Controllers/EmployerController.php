<?php

namespace App\Http\Controllers;

use App\Employer;
use App\Notifications\newNotification;
use Illuminate\Http\Request;
use Validator;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $userId = \App\User::where('email', $request->email)->pluck('id');
        $companyId = \App\Company::where("name", "LIKE", "%{$request->company}%")->pluck('id');

        $employer = \App\Employer::create([
            'userId' => $userId[0],
            'companyId' => $companyId[0]
        ]);
        $employerName = $employer->user->name;

        \Notification::send(\App\User::where('id', 1)->get(), new newNotification("Empleador '$employerName' pendiente validar."));
        return redirect('admin')->with('status', "¡Creaste una empleador!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function show(Employer $employer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function edit(Employer $employer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employer $employer)
    {
        $employer = \App\Employer::find($employer->id);
        $employer->approved = $request->approved;
        $employer->save();
        $name = $employer->user->name;
        return redirect('admin')->with('status', "¡Actualizaste a {$name}!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employer $employer)
    {
        //
    }
}
