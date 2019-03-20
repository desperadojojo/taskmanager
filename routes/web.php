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
Route::get('/', 'ProjectsController@index');


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
//
//// create  增
//Route::post('projects',['uses'=>'ProjectsController@store','as'=>'projects.store']);
//
//// delete 删
//Route::delete('projects/{project}',['uses'=>'ProjectsController@destroy','as'=>'projects.destroy']);
//
////update 改
//Route::patch('projects/{project}',['uses'=>'ProjectsController@update','as'=>'projects.update']);
//
//// show 查
//Route::get('/', 'ProjectController@index');
//Route::get('projects/{project}',['uses'=>'ProjectsController@show','as'=>'projects.show']);


Route::resource('projects','ProjectsController');
Route::resource('tasks','TasksController');

Route::post('tasks/{task}/steps/complete','StepController@completeAll');
Route::delete('tasks/{task}/steps/clear','StepController@clear');  //将自定义精确路由移至模糊路由上面，避免混乱冲突

Route::resource('tasks.steps','StepController');
// tasks/4/steps/1


Route::post('tasks/{id}/check','TasksController@check')->name('tasks.check');
