<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Broadcast::routes(['middleware' => ['auth']]);

Route::middleware(['auth'])->group(function (){
    Route::get('jobs', 'JobsController@index');
    Route::get('companies', 'CompaniesController@index');
    Route::get('employers', 'EmployerController@index')->middleware('employer');
    Route::get('employees', 'EmployeeController@index')->middleware('employee');
    Route::post('notifications','HomeController@getNotifications')->name('notifications');
    Route::post('markRead','HomeController@markNotification')->name('markNotification');
    Route::resource('employees', 'EmployeeController')->middleware('admin','employee');
    
    Route::get('jobs/autocomplete', 'JobsController@autoComplete')->name('jobAutoComplete');
    Route::get('users/autocomplete', 'HomeController@autoComplete')->name('userAutoComplete');
    Route::get('companies/autocomplete', 'CompaniesController@autoComplete')->name('companiesAutoComplete');

    Route::group(['middleware' => ['admin']], function () {
        Route::get('admin', 'HomeController@adminDashboard')->name('admin');
        Route::get('jobs/create', 'JobsController@create')->name('jobs.create');
        Route::post('jobs', 'JobsController@store')->name('jobs.store');
        Route::put('jobs/{id}', 'JobsController@update')->name('jobs.update');
        Route::resource('companies', 'CompaniesController')->except('index');
        Route::resource('employers', 'EmployerController')->except('index');
    });

    Route::group(['middleware' => ['employer']], function () {
        Route::post('jobs', 'JobsController@store')->name('jobs.store');
        Route::put('jobs/{id}', 'JobsController@update')->name('jobs.update');
        Route::resource('companies', 'CompaniesController')->except('index');
        Route::resource('employers', 'EmployerController')->except('index');
    });
});

Route::get('/home', 'HomeController@index')->name('home');
