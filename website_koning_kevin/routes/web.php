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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index');
Route::get('/profiel', 'HomeController@profile_info');


Route::get('/bestanden', 'Managing_files@add_file');





//deze route gebruik ik om te experementeren
Route::get('/test', function () {
    return 'test';
});
