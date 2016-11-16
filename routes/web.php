<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!|
|
*/

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('browse', 'VideoController@index')->name('browse');
Route::get('video/{video}', 'VideoController@show')->name('video');

Route::group([
	'middleware' => 'can:is-admin',
	'prefix' => 'admin',
	'as' => 'admin.'
], function() {
	Route::get('/', 'Admin\AdminHomeController@index')->name('index');

	Route::resource('channel', 'Admin\ChannelsController', [
		'parameters' => [
			'channel' => 'channel_id'
		]
	]);
	Route::resource('user', 'Admin\UsersController', ['only' => [
		'index'
	]]);
});
