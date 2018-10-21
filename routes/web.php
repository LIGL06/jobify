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

Route::get('jobs/autocomplete','JobsController@autoComplete')->name('jobAutoComplete');

Route::group(['middleware'=>'admin'], function() {
    Route::get('admin', 'HomeController@adminDashboard')->name('admin');
    Route::resource('jobs','JobsController');
    Route::resource('companies','CompaniesController');
    Route::resource('employers', 'EmployerController');
    Route::resource('employees', 'EmployeeController');
});

Route::get('/home', 'HomeController@index')->name('home');
