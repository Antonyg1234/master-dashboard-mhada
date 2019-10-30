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
Route::get('get_financial_detail','FinanceController@get_finance_details');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['namespace'=> 'Admin','middleware' => ['auth']], function() {
    // Project CRUD
    Route::post('loadDeleteProjectUsingAjax', 'ProjectController@loadDeleteProjectUsingAjax')->name('loadDeleteProjectUsingAjax');
    Route::get('/projects', 'ProjectController@index')->name('list-project');
    Route::get('/add-project', 'ProjectController@create')->name('add-project');
    Route::post('/add-project', 'ProjectController@store')->name('store-project');
    Route::get('/edit-project/{id}', 'ProjectController@edit')->name('edit-project');
    Route::post('/update-project/{id}', 'ProjectController@update')->name('update-project');
    Route::get('/view-project/{id}', 'ProjectController@show')->name('view-project');
    Route::delete('/delete-project/{id}', 'ProjectController@destroy')->name('delete-project');

    // Board CRUD
    Route::post('loadDeleteBoardUsingAjax', 'BoardController@loadDeleteBoardUsingAjax')->name('loadDeleteBoardUsingAjax');
    Route::get('/boards', 'BoardController@index')->name('list-board');
    Route::get('/add-board', 'BoardController@create')->name('add-board');
    Route::post('/add-board', 'BoardController@store')->name('store-board');
    Route::get('/edit-board/{id}', 'BoardController@edit')->name('edit-board');
    Route::post('/update-board/{id}', 'BoardController@update')->name('update-board');
    Route::get('/view-board/{id}', 'BoardController@show')->name('view-board');
    Route::delete('/delete-board/{id}', 'BoardController@destroy')->name('delete-board');

    //User Crud
    Route::post('loadDeleteUserUsingAjax', 'UserController@loadDeleteUserUsingAjax')->name('loadDeleteUserUsingAjax');
    Route::get('/users', 'UserController@index')->name('list-user');
    Route::get('/add-user', 'UserController@create')->name('add-user');
    Route::post('/add-user', 'UserController@store')->name('store-user');
    Route::get('/edit-user/{id}', 'UserController@edit')->name('edit-user');
    Route::post('/update-user/{id}', 'UserController@update')->name('update-user');
    Route::get('/view-user/{id}', 'UserController@show')->name('view-user');
    Route::delete('/delete-user/{id}', 'UserController@destroy')->name('delete-user');

    //Role CRUD
    Route::post('loadDeleteRoleUsingAjax', 'RoleController@loadDeleteRoleUsingAjax')->name('loadDeleteRoleUsingAjax');
    Route::get('/roles', 'RoleController@index')->name('list-role');
    Route::get('/add-role', 'RoleController@create')->name('add-role');
    Route::post('/add-role', 'RoleController@store')->name('store-role');
    Route::get('/edit-role/{id}', 'RoleController@edit')->name('edit-role');
    Route::post('/update-role/{id}', 'RoleController@update')->name('update-role');
    Route::get('/view-role/{id}', 'RoleController@show')->name('view-role');
    Route::delete('/delete-role/{id}', 'RoleController@destroy')->name('delete-role');

    //User-Role
    Route::get('/user-role/{id}', 'UserController@userRoles')->name('assign-role');
    Route::post('/user-role/{id}', 'UserController@storeUserRoles')->name('store-user-role');

    //User-Board
    Route::get('/user-board/{id}', 'UserController@userBoards')->name('assign-board');
    Route::post('/user-board/{id}', 'UserController@storeUserBoards')->name('store-user-board');


});
