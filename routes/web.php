<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


// Default route goes to login
Route::get('/', function () {
    return view('welcome');
});

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/reminder', 'PasswordReminderController@index');
Route::post('/reminder', 'PasswordReminderController@send');

Route::group(['middleware' => ['web']], function () {

    Route::auth();
    Route::get('/restricted', function () {
        return view('restricted');
    });

    Route::post('contact', 'ContactController@create');

    Route::get('dashboard', 'DashboardController@index')->middleware('auth');

    Route::get('user', 'UserController@showProfile')->middleware('auth');
    Route::post('user/save_password',['as' => 'user/save_password','uses' => 'UserController@savePassword'])->middleware('auth');
    Route::post('user/edit',['as' => 'user/edit','uses' => 'UserController@edit'])->middleware('auth');
    Route::post('user/delete',['as' => 'user/delete','uses' => 'UserController@delete'])->middleware('auth');

    Route::get('user/picture', 'UserController@picture')->middleware('auth');
    Route::post('user/picture', 'UserController@uploadPicture')->middleware('auth');
    Route::get('user/picture/save', 'UserController@savePictureView')->middleware('auth');
    Route::post('user/picture/save', 'UserController@savePicture')->middleware('auth');

    Route::get('user/school', 'SchoolController@index')->middleware('auth');
    Route::get('user/school/create', 'SchoolController@create')->middleware('auth');
    Route::post('user/school/store', 'SchoolController@store')->middleware('auth');
    Route::delete('user/school/{id}', 'SchoolController@destroy')->middleware('auth');

    Route::get('user/results', 'ResultsController@index')->middleware('auth');

    Route::get('application', 'ApplicationController@index')->middleware('auth');
    Route::get('application/update', 'ApplicationController@update')->middleware('auth');
    Route::post('application/save', 'ApplicationController@save')->middleware('auth');
    Route::get('application/print', 'ApplicationController@printForm')->middleware('auth');
    Route::get('application/card',['as' => 'application/card','uses' => 'ApplicationController@card'])->middleware('auth');
    Route::get('application/results', 'ApplicationController@results')->middleware('auth');
    
    Route::get('admin/applications/', 'ApplicationController@all')->middleware('admin');
    Route::get('admin/applications/all', 'ApplicationController@all')->middleware('admin');
    Route::get('admin/applications/complete', 'ApplicationController@complete')->middleware('admin');
    Route::get('admin/applications/incomplete', 'ApplicationController@incomplete')->middleware('admin');
    Route::get('admin/applications/printed', 'ApplicationController@printed')->middleware('admin');
    Route::post('admin/applications/view', 'ApplicationController@view')->middleware('admin');
    Route::get('admin/applications/exam', 'ApplicationController@printExam')->middleware('admin');
    Route::get('admin/applications/unprinted_cards', 'ApplicationController@unprintedCards')->middleware('admin');
    Route::get('admin/applications/printed_cards', 'ApplicationController@printedCards')->middleware('admin');
    Route::get('admin/applications/cards', 'ApplicationController@cards')->middleware('admin');
  
    Route::get('admin/exam', 'ApplicationController@examIndex')->middleware('admin');
    Route::get('admin/exam/import', 'ApplicationController@examImport')->middleware('admin');
    Route::post('admin/exam/upload', 'ApplicationController@examUpload')->middleware('admin');

    Route::get('admin/reports/', 'ApplicationController@reports')->middleware('admin');
    Route::get('admin/reports/export/{report}', 'ApplicationController@export')->middleware('admin');

    Route::get('admin', 'AdminController@index')->middleware('admin');

    Route::get('admin/settings/', 'SettingController@index')->middleware('admin');
    
    Route::get('admin/settings/admissions/', 'AdmissionController@index')->middleware('admin');
    Route::get('admin/settings/admissions/{id}', 'AdmissionController@admissionsIndex')->middleware('admin');
    Route::post('admin/settings/admissions/update/{id}', 'AdmissionController@admissionsUpdate')->middleware('admin');

    Route::get('admin/users/', 'AdminController@users')->middleware('admin');
    Route::get('admin/users/create', 'AdminController@createUser')->middleware('admin');
    Route::post('admin/users/store', 'AdminController@storeUser')->middleware('admin');
    Route::post('admin/users/show', 'AdminController@showUser')->middleware('admin');
    Route::post('admin/users/edit', 'AdminController@editUser')->middleware('admin');
    Route::post('admin/users/update', 'AdminController@updateUser')->middleware('admin');
    Route::delete('admin/users/{id}', 'AdminController@deleteUser')->middleware('admin');

    Route::get('contacts', 'ContactController@index')->middleware('admin');
    Route::post('contacts/reply', 'ContactController@reply')->middleware('admin');
    Route::post('contacts/send', 'ContactController@send')->middleware('admin');

    Route::get('academic', 'AcademicController@index')->middleware('academic');

    Route::get('student', 'StudentController@index')->middleware('student');  

});

Route::group(['middleware' => ['auth', 'admin', 'student', 'academic']], function () {
    
});

Route::resource('admin/users', 'Admin\\UsersController');
Route::resource('academic/courses', 'Academic\\CoursesController');

Route::get('admin/users/picture/index', 'Admin\\PictureController@pictureIndex')->middleware('admin');
Route::post('admin/users/picture/upload', 'Admin\\PictureController@pictureUpload')->middleware('admin');
Route::get('admin/users/picture/view', 'Admin\\PictureController@pictureView')->middleware('admin');
Route::post('admin/users/picture/save', 'Admin\\PictureController@pictureSave')->middleware('admin');


Route::resource('academic/subjects', 'Academic\\SubjectsController');

Route::resource('admin/settings/schools', 'Admin\\SchoolsController');

Route::resource('admin/settings/site', 'Admin\\OptionsSiteController');
Route::resource('admin/settings/social', 'Admin\\OptionsSocialController');
Route::resource('admin/settings/images', 'Admin\\OptionsImagesController');
Route::resource('admin/settings/files', 'Admin\\OptionsFilesController');
Route::resource('admin/settings/card', 'Admin\\OptionsCardController');

Route::get('admin/settings/data-management', 'Admin\\DataManagementController@index')->middleware('admin');
Route::post('admin/settings/data-management', 'Admin\\DataManagementController@execute')->middleware('admin');
Route::get('admin/settings/delete-incomplete', 'Admin\\DataManagementController@deleteIncomplete')->middleware('admin');
Route::get('admin/settings/allocate-seats', 'Admin\\DataManagementController@allocateSeats')->middleware('admin');

Route::get('sms/{phone}/{msg}', 'SmsController@index');

Route::get('schooladmin', 'Admin\\UsersController@createPicture')->middleware('admin');
Route::get('schooladmin', 'SchoolAdmin\\SchoolAdminController@index')->middleware('schooladmin');
Route::get('schooladmin/export', 'SchoolAdmin\\SchoolAdminController@export')->middleware('schooladmin');

// Route::resource('admin/results', 'Admin\\ResultsController');
Route::get('admin/results/import', 'Admin\\ResultsController@import')->middleware('admin');
Route::post('admin/results/upload', 'Admin\\ResultsController@upload')->middleware('admin');
