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
    //return view('welcome');
    return redirect('/posts');
});
Auth::routes();
Route::get('/home', 'HomeController@index');
Route::get('posts', 'PostsController@index');
Route::get('posts/create', 'PostsController@create');
Route::get('posts/{tag}/{post}', 'PostsController@show');
Route::delete('posts/{tag}/{post}', 'PostsController@destroy');
Route::post('posts', 'PostsController@store');
Route::get('posts/{tag}', 'PostsController@index');
Route::post('/posts/{tag}/{post}/replies', 'RepliesController@store');

Route::post('/replies/{reply}/favorites', 'FavoritesController@store');
Route::delete('/replies/{reply}/favorites', 'FavoritesController@destroy');

Route::delete('replies/{reply}', 'RepliesController@destroy');
Route::patch('replies/{reply}', 'RepliesController@update');

Route::post('/posts/{tag}/{post}/subscriptions', 'PostSubscriptionsController@store')->middleware('auth');
Route::delete('/posts/{tag}/{post}/subscriptions', 'PostSubscriptionsController@destroy')->middleware('auth');

Route::get('/profiles/{user}/activity', 'ProfilesController@activity');
Route::get('/profiles/{user}', 'ProfilesController@show');

