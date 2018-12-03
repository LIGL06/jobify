<?php

namespace App\Http\Controllers;

use App\Exports\AllExport;
use App\Notifications\newNotification;
use App\User;
use App\UserInfo;
use Cloudinary\Uploader;
use Illuminate\Http\Request;
use DB;
use JD\Cloudder\Facades\Cloudder;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return mixed
     */
    public function getNotifications()
    {
        return auth()->user()->unreadNotifications;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function markNotification(Request $request)
    {
        return auth()->user()->unreadNotifications->find($request->not_id)->markAsRead();
    }

    /**
     * @return mixed
     */
    public function markAllNotifications()
    {
        return auth()->user()->unreadNotifications->markAsRead();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminDashboard()
    {
        $companiesCount = \App\Company::count();
        $jobCounts = \App\Job::count();
        $employeesCounts = \App\Employee::count();
        $employersCounts = \App\Employer::count();

        $jobs = \App\Job::where('vacancies', '>', 0)->orderBy('created_at', 'desc')->get();
        $employees = \App\Employee::orderBy('created_at', 'desc')->get();
        $companies = \App\Company::orderBy('created_at', 'desc')->get();
        $employers = \App\Employer::orderBy('created_at', 'desc')->get();

        return view('admin.home', [
            'companiesCount' => $companiesCount,
            'jobCounts' => $jobCounts,
            'employeesCounts' => $employeesCounts,
            'employersCounts' => $employersCounts,
            'jobs' => $jobs,
            'employees' => $employees,
            'companies' => $companies,
            'employers' => $employers
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index(Request $request)
    {
        if ($request->user()->isEmployer()) {
            return redirect('employers');
        }
        if ($request->user()->isEmployee()) {
            return redirect('employees');
        }
        if ($request->user()->isAdmin()) {
            return redirect('admin');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function autoComplete(Request $request)
    {
        $subTitles = DB::table('users')->where("email", "LIKE", "%{$request->input('query')}%")->pluck('email');
        return response()->json($subTitles);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getUser($id)
    {
        return User::where('id', $id)->with('info', 'employee', 'employer')->get();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getMe(Request $request)
    {

        $user = User::where('id', $request->user()->id)->with('info', 'employee')->first();
        return view('user', ['user' => $user]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCompany(Request $request)
    {
        $user = User::where('id', $request->user()->id)->with('info', 'employer')->first();
        return view('companies.edit', ['user' => $user]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createProfile(Request $request)
    {
        $user = User::where('id', $request->user()->id)->first();
        $userInfo = new UserInfo();
        $validator = Validator::make($request->all(), [
            'fName' => 'required',
            'lName' => 'required',
            'doB' => 'required',
            'civilStatus' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'profession' => 'required',
            'uniqueKey' => 'unique:user_infos',
            'socialKey' => 'unique:user_infos',
        ]);

        if ($validator->fails()) {
            return redirect('users/me')
                ->withErrors($validator)
                ->withInput();
        }
        $user->name = $request->fName;
        $userInfo->userId = $request->user()->id;
        $userInfo->professional = true;
        $userInfo->handyCap = false;
        $userInfo->salary = 0;

        if ($request->hasFile('image')) {
            $validator = Validator::make($request->all(), [
                'image' => 'required|mimes:jpeg,bmp,jpg,png|between:1,5000'
            ], [
                'between' => 'The :attribute value :input is not between :min - :max.',
                'mimes' => 'The :attribute must be one of the following types: :values',
            ]);
            if ($validator->fails()) {
                return redirect('users/me')
                    ->withErrors($validator)
                    ->withInput();
            }
            $image = $request->file('image')->getRealPath();
            Cloudder::upload($image, null);
            $userInfo->pictureUrl = Cloudder::show(Cloudder::getPublicId());
        }

        if ($request->hasFile('cv')) {
            $validator = Validator::make($request->all(), [
                'cv' => 'required|mimes:pdf,docx,doc,ppt|between:1,2000'
            ], [
                'between' => 'The :attribute value :input is not between :min - :max.',
                'mimes' => 'The :attribute must be one of the following types: :values',
            ]);
            if ($validator->fails()) {
                return redirect('users/me')
                    ->withErrors($validator)
                    ->withInput();
            }
            $cv = $request->file('cv')->getRealPath();
            Cloudder::upload($cv, $request->file('cv')->getFilename());
            $userInfo->cvUrl = Cloudder::getResult()['url'];
        }
        $userInfo->fill($request->all());
        $user->save();
        $userInfo->save();

        \Notification::send($user, new newNotification("Creaste tu perfil.", $user, env('APP_URL') . '/users/me'));
        return redirect('home')->with('status', "¡Creaste tu perfil!");
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateUser(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $userInfo = UserInfo::where('id', $request->userInfoId)->first();
        $validator = Validator::make($request->all(), [
            'fName' => 'required',
            'lName' => 'required',
            'doB' => 'required',
            'civilStatus' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'profession' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('users/me')
                ->withErrors($validator)
                ->withInput();
        }
        if ((isset($userInfo->pictureUrl) && $request->hasFile('image')) || $request->hasFile('image')) {
            $validator = Validator::make($request->all(), [
                'image' => 'required|mimes:jpeg,bmp,jpg,png|between:1,5000'
            ], [
                'between' => 'The :attribute value :input is not between :min - :max.',
                'mimes' => 'The :attribute must be one of the following types: :values',
            ]);
            if ($validator->fails()) {
                return redirect('users/me')
                    ->withErrors($validator)
                    ->withInput();
            }
            $image = $request->file('image')->getRealPath();
            Cloudder::upload($image, null);
            $userInfo->pictureUrl = Cloudder::show(Cloudder::getPublicId());
        }
        if ((isset($userInfo->cvUrl) && $request->hasFile('cv')) || $request->hasFile('cv')) {
            $validator = Validator::make($request->all(), [
                'cv' => 'required|mimes:pdf,docx,doc,ppt|between:1,2000'
            ], [
                'between' => 'The :attribute value :input is not between :min - :max.',
                'mimes' => 'The :attribute must be one of the following types: :values',
            ]);
            if ($validator->fails()) {
                return redirect('users/me')
                    ->withErrors($validator)
                    ->withInput();
            }
            $cv = $request->file('cv')->getRealPath();
            Cloudder::upload($cv, $request->file('cv')->getFilename());
            $userInfo->cvUrl = Cloudder::getResult()['url'];
        }

        $userInfo->fill($request->all());
        $user->name = $request->fName;
        $user->save();
        $userInfo->save();

        \Notification::send($user, new newNotification("Actualizaste tus datos.", $user, env('APP_URL') . '/users/me'));
        return redirect('home')->with('status', "¡Actualizaste tu perfil!");
    }
     /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
     public function export()
     {
         return Excel::download(new AllExport(), "employers" . \Carbon\Carbon::now()->toDateString() . ".xlsx");
     }
}
