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
//view trainee profile
Route::get('/trainee/profile', 'TraineeController@viewProfile')->middleware('trainee');

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
//fill the trainee select
Route::get('/trainer/create_evaluation/fillTraineeSelect', 'EvaluationController@fillTraineeSelect')->middleware('trainer');
//fill the period select
Route::post('/trainer/create_evaluation/fillPeriodSelect', 'EvaluationController@fillPeriodSelect')->middleware('trainer');
//save evaluation
Route::post('/trainer/evaluation/save', 'EvaluationController@saveEvaluation')->middleware('trainer');

//pop up data to madal
Route::post('/trainer/evaluation/edit', 'EvaluationController@editEvaluation')->middleware('trainer');

//Update evaluation
Route::post('/trainer/evaluation/update', 'EvaluationController@updateEvaluation')->middleware('trainer');
//delete evaluation
Route::post('/trainer/evaluation/delete', 'EvaluationController@deleteEvaluation')->middleware('trainer');

Route::post('/trainer/{id}/submit_profile', 'UserController@submitImage')->middleware('trainer');

Route::get('/trainer/create_evaluation', ['middleware' => 'trainer', function (){
    return view('trainer.create_evaluation');
}]);


Route::get('/user','UserController@show')->middleware('trainer');
Route::get('user/user_detail/{id}','UserController@showUserDetail')->middleware('trainer');
Route::get('user/trainee_detail/{id}','UserController@showTraineeDetail')->middleware('trainer');
Route::post('user/delete_user','UserController@deleteUser')->middleware('trainer');
Route::post('user/delete_trainee','UserController@deleteTrainee')->middleware('trainer');

Route::get('user/edit_user/{id}','UserController@editUser')->middleware('trainer');
Route::post('/user/update_user','UserController@updateUser')->middleware('trainer');

Route::get('user/edit_trainee/{id}','UserController@editTrainee')->middleware('trainer');
Route::post('/user/update_trainee','UserController@updateTrainee')->middleware('trainer');

//view trainee evaluation
Route::get('/trainee/evaluation', 'TraineeController@showEvaluation')->middleware('trainee');

