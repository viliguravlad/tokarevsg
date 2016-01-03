<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/* 
|--------------------------------------------------------------------------
| For redirecting from '/' to 'auth/login'
|--------------------------------------------------------------------------
|
*/
Route::get('/', function(){
	return redirect('auth/login');
});

/* 
|--------------------------------------------------------------------------
| For routing 'auth/login' and 'auth/logout' 
|--------------------------------------------------------------------------
|
*/
Route::controller('auth', '\App\Http\Controllers\Auth\AuthController');

/*
|--------------------------------------------------------------------------
| For routing to '/home'
|--------------------------------------------------------------------------
| If user is admin, then view(admin/main)
| If user is simple, then view(home)
|
*/
Route::controller('home', '\App\Http\Controllers\HomeController');

/*
|--------------------------------------------------------------------------
| For routing to 'admin/log' and 'admin/register'
|--------------------------------------------------------------------------
|
| Route::get('admin/log', '\App\Http\Controllers\Admin\LogController@index');
| Route::get('admin/register', '\App\Http\Controllers\Admin\RegisterController@index');
*/
//Route::controller('admin', '\App\Http\Controllers\AdminController');
Route::get('admin/log', '\App\Http\Controllers\NewAdminController@log');
Route::get('admin/users', '\App\Http\Controllers\NewAdminController@users');
Route::resource('admin', '\App\Http\Controllers\NewAdminController');

/*
|--------------------------------------------------------------------------
| For sending single and multiple SMS (/send/single; /send/multiple)
|--------------------------------------------------------------------------
|
*/
Route::controller('send', '\App\Http\Controllers\SendController');

/*
|--------------------------------------------------------------------------
| For viewing Clients table
|--------------------------------------------------------------------------
|
*/
//Route::controller('clients', '\App\Http\Controllers\ClientsController');
Route::resource('clients', '\App\Http\Controllers\NewClientsController');














/*Route::get('admin/main', function(){
	return View::make('admin/main');
});*/

/*Route::get('singleSMS', function()
	{
		if(Auth::guest())
			return redirect('auth/login');
		else
			return View::make('singleSMS');
	});

Route::get('massiveSMS', function()
	{
		if(Auth::guest())
			return redirect('auth/login');
		else
			return View::make('massiveSMS');
	});*/

/*Route::get('singleSMS', function() {
	return View::make('singleSMS');
});

Route::get('massiveSMS', function() {
	return View::make('massiveSMS');
});

Route::get('client', function() {
	return View::make('client');
});*/

//Route::get('auth/login', 'Auth\AuthController@getLogin');
//Route::post('auth/login', 'Auth\AuthController@postLogin');
//Route::get('auth/logout', 'Auth\AuthController@getLogout');