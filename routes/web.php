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

Broadcast::routes(['middleware' => 'auth','admin']);

Route::middleware(['auth'])->group(function (){
    Route::get('jobs', 'JobsController@index');
    Route::get('companies', 'CompaniesController@index');
    Route::get('employers', 'EmployerController@index');
    Route::get('employees', 'EmployeeController@index');
    Route::get('jobs/autocomplete', 'JobsController@autoComplete');
    Route::post('notifications','HomeController@getNotifications')->name('notifications');
    Route::post('markRead','HomeController@markNotification')->name('markNotification');
});

Route::middleware(['admin'])->group(function () {
    Route::get('jobs/autocomplete', 'JobsController@autoComplete')->name('jobAutoComplete');
    Route::get('users/autocomplete', 'HomeController@autoComplete')->name('userAutoComplete');
    Route::get('companies/autocomplete', 'CompaniesController@autoComplete')->name('companiesAutoComplete');
    Route::get('admin', 'HomeController@adminDashboard')->name('admin');
    Route::resource('jobs', 'JobsController')->except('index');
    Route::resource('companies', 'CompaniesController')->except('index');
    Route::resource('employees', 'EmployeeController')->except('index');
    Route::resource('employers', 'EmployerController')->except('index');
});

Route::get('/home', 'HomeController@index')->name('home');
