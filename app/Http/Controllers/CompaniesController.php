<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employer;
use App\User;
use App\Notifications\newNotification;
use Illuminate\Support\Facades\Storage;
use Validator;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{

    public function index()
    {
        //
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
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
        $company = Company::create($request->all());
        if ($request->user()->isAdmin()) {
            \Notification::send(User::where('id', 1)->get(), new newNotification("Empresa '$company->name' pendiente validar."));
            return redirect('admin')->with('status', "¡Creaste una empresa!");
        }
        if ($request->user()->isEmployer()) {
            \Notification::send(User::where('id', $request->user()->id)->get(), new newNotification("Tu empresa '$company->name' está pendiente de validar."));
            Employer::create([
                'userId' => $request->user()->id,
                'companyId' => $company->id
            ]);
            return redirect('employers')->with('status', "¡Creaste una empresa!");
        }
    }

    public function show(Company $company)
    {
        //
    }

    public function edit(Company $company)
    {
        //
    }

    /**
     * @param Request $request
     * @param Company $company
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Company $company)
    {
        $company = Company::find($company->id);
        $company->approved = $request->approved ? $request->approved : false;
        if (isset($company->bgPictureUrl) && $request->hasFile('image')) {
            $picParts = explode("/", $company->bgPictureUrl);
            $pictureLink = end($picParts);
            Storage::disk('s3')->delete('profilePictures/' . $pictureLink);
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('profilePictures', 's3');
            $imageUrl = Storage::cloud()->url($image);
            $company->bgPictureUrl = $imageUrl;
        }
        $company->fill($request->all());
        $company->save();
        return $request->user()->isAdmin() ? redirect('admin')->with('status', "¡Actualizaste a $company->name!") : redirect('company/me')->with('status', "¡Actualizaste a $company->name!");
    }

    public function destroy(Company $company)
    {
        //
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function autoComplete(Request $request)
    {
        $subTitles = \DB::table('companies')->where("name", "LIKE", "%{$request->input('query')}%")->pluck('name');
        return response()->json($subTitles);
    }
}
