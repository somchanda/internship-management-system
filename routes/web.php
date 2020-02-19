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

Route::post('/update_session', 'Controller@updateSession');

Route::get('/trainer/layout', function (){
    return view('trainer.layout');
});

Route::get('/user','UserController@show');
Route::get('user/user_detail/{id}','UserController@showUserDetail');
Route::get('user/trainee_detail/{id}','UserController@showTraineeDetail');
Route::post('user/delete_user','UserController@deleteUser');
Route::post('user/delete_trainee','UserController@deleteTrainee');
Route::get('user/edit_user/{id}','UserController@editUser');
Route::post('/user/update','UserController@updateUser');

