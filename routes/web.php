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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@welcome')->name('welcome');
Route::get('profiles/{user}', 'ProfilesController@show')->name('profiles.show');
Route::get('profiles/{user}/edit', 'ProfilesController@edit')->name('profiles.edit');
Route::patch('profiles/{user}', 'ProfilesController@update')->name('profiles.update');

Route::resource('categories', 'CategoryController');
Route::resource('assignments', 'AssignmentController');
Route::resource('blogs', 'BlogController');

Route::get('/blogs/blog/4', 'BlogController@code')->name('blogs.code');
Route::get('/blogs/blog/showcode/{blog}', 'BlogController@showcode')->name('blogs.showcode');
Route::get('/blogs/blog/3', 'BlogController@audio')->name('blogs.audio');
Route::get('/blogs/blog/showcode/{blog}', 'BlogController@showaudio')->name('blogs.showaudio');
Route::get('/blogs/blog/2', 'BlogController@video')->name('blogs.video');
Route::get('/blogs/blog/showcode/{blog}', 'BlogController@showvideo')->name('blogs.showvideo');
Route::get('/blogs/blog/1', 'BlogController@standard')->name('blogs.standard');
Route::get('/blogs/blog/showcode/{blog}', 'BlogController@showstandard')->name('blogs.showstandard');

Route::resource('exercises', 'ExerciseController');
Route::resource('comments', 'CommentController');
Route::resource('tags', 'TagController');
Route::resource('favorites', 'FavoriteController');
