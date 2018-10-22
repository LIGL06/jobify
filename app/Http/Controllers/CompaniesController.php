<?php

namespace App\Http\Controllers;

use App\Company;
use App\Notifications\newNotification;
use Validator;
use Illuminate\Http\Request;

class CompaniesController extends Controller
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
        return view('companies.create');
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
            'name' => 'required|unique:companies|max:255',
            'rotation' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('companies/create')
                ->withErrors($validator)
                ->withInput();
        }
        $company = \App\Company::create($request->all());
        \Notification::send(\App\User::where('id', 1)->get(), new newNotification("Empresa '$company->name' pendiente validar."));
        return redirect('admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Company $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $company = \App\Company::find($company->id);
        $company->approved = $request->approved;
        $company->save();
        return redirect('/admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }

    public function autoComplete(Request $request){
        $subTitles = \DB::table('companies')->where("name", "LIKE", "%{$request->input('query')}%")->pluck('name');
        return response()->json($subTitles);
    }
}
