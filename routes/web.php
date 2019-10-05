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

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['namespace'=> 'Admin','middleware' => ['auth']], function() {
    Route::post('loadDeleteProjectUsingAjax', 'ProjectController@loadDeleteProjectUsingAjax')->name('loadDeleteProjectUsingAjax');
    Route::get('/projects', 'ProjectController@index')->name('list-project');
    Route::get('/add-project', 'ProjectController@create')->name('add-project');
    Route::post('/add-project', 'ProjectController@store')->name('store-project');
    Route::get('/edit-project/{id}', 'ProjectController@edit')->name('edit-project');
    Route::post('/update-project/{id}', 'ProjectController@update')->name('update-project');
    Route::get('/view-project/{id}', 'ProjectController@show')->name('view-project');
    Route::delete('/delete-project/{id}', 'ProjectController@destroy')->name('delete-project');
});
