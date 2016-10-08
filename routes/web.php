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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::group([
	'middleware' => 'can:is-admin',
	'prefix' => 'admin',
	'as' => 'admin.'
], function() {
	Route::get('/', 'Admin\AdminHomeController@index')->name('index');

	Route::resource('users', 'Admin\UsersController', ['only' => [
		'index'
	]]);
});
