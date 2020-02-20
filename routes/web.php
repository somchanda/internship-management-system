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


Route::get('/', 'Controller@redirect');

Route::get('/account_list', 'Controller@accountList');

Route::post('/update_session', 'Controller@updateSession');

Auth::routes();

Route::get('/trainer/create_account', ['middleware' => 'admin', function(){
    return view('auth.register');
}]);

Route::post('/trainer/create_account', 'UserController@createAccount')->middleware('admin');

//Route::get('/home', 'HomeController@index')->name('home');

// view trainee dashboard
Route::get('/trainee/dashboard', ['middleware' => 'trainee', function(){
    return view('/trainee.dashboard');
}]);

// view trainer layout
Route::get('/trainer/layout', ['middleware' => 'trainer', function (){
    return view('trainer.layout');
}]);

// view trainer or admin dashboard
Route::get('/trainer/dashboard', ['middleware' => 'trainer', function () {
    return view('trainer.dashboard');
}]);

Route::get('/back', function (){
    return back();
});

Route::get('/trainer/evaluation_list', 'EvaluationController@showList')->middleware('trainer');

Route::post('/trainer/{id}/submit_profile', 'UserController@submitImage')->middleware('trainer');

Route::get('/trainer/create_evaluation', ['middleware' => 'trainer'], function (){

});
