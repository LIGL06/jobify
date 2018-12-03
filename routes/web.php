<?php
Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);
Broadcast::routes(['middleware' => ['auth']]);

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/users/me', 'HomeController@getMe')->name('profile');
    Route::get('/user/{id}', 'HomeController@getUser');
    Route::post('/users/me', 'HomeController@createProfile')->name('createProfile');
    Route::put('/user/{id}', 'HomeController@updateUser')->name('updateProfile');
    //Customization
    Route::get('/company/me', 'HomeController@getCompany')->name('companyProfile');
    Route::post('/company/{id}', 'HomeController@createCompanyProfile')->name('createCompanyProfile');
    //Notifications
    Route::post('notifications', 'HomeController@getNotifications')->name('notifications');
    Route::post('markAsRead', 'HomeController@markNotification')->name('markNotification');
    Route::post('markAllNotifications', 'HomeController@markAllNotifications')->name('markAllNotifications');
    //Autocompletes
    Route::get('jobs/autocomplete', 'JobsController@autoComplete')->name('jobAutoComplete');
    Route::get('users/autocomplete', 'HomeController@autoComplete')->name('userAutoComplete');
    Route::get('companies/autocomplete', 'CompaniesController@autoComplete')->name('companiesAutoComplete');
    //Resources
    Route::resource('companies', 'CompaniesController');
    Route::resource('jobs', 'JobsController');
    Route::resource('employees', 'EmployeeController');
    Route::resource('employers', 'EmployerController');
});

Route::middleware(['admin'])->group(function () {
    Route::get('admin', 'HomeController@adminDashboard')->name('admin');
    Route::get('admin/export', 'HomeController@export');
});


