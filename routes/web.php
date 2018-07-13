<?php

Route::view('/', 'home');
Auth::routes();
Route::get('home', 'HomeController@index')->name('home');

// Use order of importance, as more specific routes will act first.
Route::get('threads/create', 'ThreadsController@create');
Route::get('threads/{channel?}', 'ThreadsController@index')->name('threads.index');
Route::get('threads/{channel}/{thread}', 'ThreadsController@show');
Route::delete('threads/{channel}/{thread}', 'ThreadsController@destroy');

Route::post('threads', 'ThreadsController@store');
Route::post('threads/{channel}/{thread}/replies', 'RepliesController@store');

Route::post('replies/{reply}/favorites', 'FavoritesController@store');
Route::delete('replies/{reply}', 'RepliesController@destroy');

Route::get('profiles/{user}', 'ProfilesController@show')->name('profile');

// Route::get('threads/{thread}', 'ThreadsController@show')->name('threads.show');
// Route::resource('threads', 'ThreadsController');
