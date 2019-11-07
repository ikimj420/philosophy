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
//Show User
Route::get('/profiles/{user}', 'ProfilesController@show')->name('profiles.show');
//edit User
Route::get('/profiles/{user}/edit', 'ProfilesController@edit')->name('profiles.edit');
Route::patch('/profiles/{user}', 'ProfilesController@update')->name('profiles.update');
Route::delete('/profiles/{user}', 'ProfilesController@destroy')->name('profiles.destroy');
//Category
Route::resource('categories', 'CategoryController');
//ToDo
Route::resource('assignments', 'AssignmentController');
//Add Remove Favorite
Route::post('/favorite/{id} ', 'FavoriteController@saveExercise')->name('favorite.saveExercise');
Route::delete('/favorite/{id} ', 'FavoriteController@destroyExercise')->name('favorite.destroyExercise');
Route::post('/favorites/{id} ', 'FavoriteController@saveBlog')->name('favorites.saveBlog');
Route::delete('/favorites/{id} ', 'FavoriteController@destroyBlog')->name('favorites.destroyBlog');
//Blog
Route::resource('blogs', 'BlogController');
//Blog ShowCode
Route::get('/blogs/blog/4', 'BlogController@code')->name('blogs.code');
//Blog ShowAudio
Route::get('/blogs/blog/3', 'BlogController@audio')->name('blogs.audio');
//Blog ShowVideo
Route::get('/blogs/blog/2', 'BlogController@video')->name('blogs.video');
//Blog ShowStandars
Route::get('/blogs/blog/1', 'BlogController@standard')->name('blogs.standard');
//Make
Route::resource('exercises', 'ExerciseController');
//Make ShowFood
Route::get('/exercises/exercise/6', 'ExerciseController@food')->name('exercises.food');
//Make ShowCocktail
Route::get('/exercises/exercise/5', 'ExerciseController@cocktail')->name('exercises.cocktail');
//Send Mail
Route::get('/contact', 'ContactController@create');
Route::post('/contact', 'ContactController@store');
//Show Group Of Tags
Route::get('/tag/tags/{tag}', 'TagsController@index');
//search
Route::get('/search', 'SearchController@index')->name('search');
