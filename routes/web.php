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
Route::get('/', 'HomeController@welcome')->name('welcome');

Route::get('/contact', 'ContactController@create');
Route::post('/contact', 'ContactController@store');

Route::get('profiles/{user}', 'ProfilesController@show')->name('profiles.show');
Route::get('profiles/{user}/edit', 'ProfilesController@edit')->name('profiles.edit');
Route::patch('profiles/{user}', 'ProfilesController@update')->name('profiles.update');

Route::resource('categories', 'CategoryController');

Route::resource('assignments', 'AssignmentController');

Route::resource('blogs', 'BlogController');
Route::get('/blogs/blog/4', 'BlogController@code')->name('blogs.code');
Route::get('/blogs/blog/3', 'BlogController@audio')->name('blogs.audio');
Route::get('/blogs/blog/2', 'BlogController@video')->name('blogs.video');
Route::get('/blogs/blog/1', 'BlogController@standard')->name('blogs.standard');

Route::resource('exercises', 'ExerciseController');
Route::get('/exercises/exercise/6', 'ExerciseController@food')->name('exercises.food');
Route::get('/exercises/exercise/5', 'ExerciseController@cocktail')->name('exercises.cocktail');

Route::get('/tag/tags/{tag}', 'TagsController@index');

//Add Remove Favorite
Route::post('/favorite/{id} ', 'FavoriteController@saveExercise')->name('favorite.saveExercise');
Route::delete('/favorite/{id} ', 'FavoriteController@destroyExercise')->name('favorite.destroyExercise');
Route::post('/favorites/{id} ', 'FavoriteController@saveBlog')->name('favorites.saveBlog');
Route::delete('/favorites/{id} ', 'FavoriteController@destroyBlog')->name('favorites.destroyBlog');

//search
Route::get('/search', 'SearchController@index')->name('search');
