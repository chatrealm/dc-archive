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
Route::get('creators', 'CreatorController@index')->name('creator.index');
Route::get('p/{page}', 'PageController@show')->name('page.show');
Route::get('video/{video}', 'VideoController@show')->name('video');
