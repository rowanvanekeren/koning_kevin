<?php

use App\Readme;
//use Response;
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

Route::get('/', function () {

    if(Auth::check()){
        return redirect('/dashboard');
    }
    return view('welcome');
});

Auth::routes();

//Sarah routes
Route::get('/dashboard', 'HomeController@index');
Route::get('/profiel/{id?}', 'HomeController@profile_info');
Route::get('/add_project', 'ProjectController@show_add_project');
Route::post('/add_project','ProjectController@add_project');
Route::get('/api/get_inactive_users', 'ApiController@get_inactive_users');

//Posts
Route::post('/api/accept_user', 'ApiController@activate_user');
Route::post('/api/add_role_to_user', 'ApiController@add_role_to_user');




//Anton Routes
//get
Route::get('/add_file', 'Managing_files@show_add_file');
Route::get('/bestanden','Managing_files@show_file');
Route::get('/download/{path}','Managing_files@download');
Route::get('/leesmij', function(){
    $filename =Readme::all()->last()->url;
    $path = base_path() . '/public/files/readme/' . $filename;
    return Response::make(file_get_contents($path), 200, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="' . $filename . '"'
    ]);
});


//get api
Route::get('/api/get_all_files','Api_file_Controller@get_all_files');
Route::post('/api/delete_file','Api_file_Controller@delete_file');
Route::get('/api/get_all_files_search','Api_file_Controller@get_all_files_search');
Route::get('/api/file_info/{id}','Api_file_Controller@file_info');
Route::get('/api/get_files_belongs_to_user','Api_file_Controller@get_files_belongs_to_user');
Route::get('/api/get_categories','Api_file_Controller@get_categories');
Route::get('/api/get_all_files_for_category/{id}','Api_file_Controller@get_all_files_for_category');
Route::get('/api/get_all_files_for_projects','Api_file_Controller@get_files_project');


//post
Route::post('/add_file','Managing_files@add_file');

//deze route gebruik ik om te experementeren
Route::get('/test', function () {
    return 'test';
});
