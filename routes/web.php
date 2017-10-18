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
    return view('home');
});
Auth::routes();

// Use order of importance, as more specific routes will act first.
Route::get('threads/create', 'ThreadsController@create');
Route::get('threads/{channel?}', 'ThreadsController@index')->name('threads.index');
Route::get('threads/{channel}/{thread}', 'ThreadsController@show');

Route::post('threads', 'ThreadsController@store');
Route::post('threads/{channel}/{thread}/replies', 'RepliesController@store');

Route::post('replies/{reply}/favorites', 'FavoritesController@store');

// Route::get('threads/{thread}', 'ThreadsController@show')->name('threads.show');
// Route::resource('threads', 'ThreadsController');
Route::get('home', 'HomeController@index')->name('home');
