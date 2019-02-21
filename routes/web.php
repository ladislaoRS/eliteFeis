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
    return redirect('/posts');
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
*/
Auth::routes(['verify' => true]);

/*
|--------------------------------------------------------------------------
| Posts Routes
|--------------------------------------------------------------------------
|
*/
Route::get('posts', 'PostsController@index');
Route::get('posts/create', 'PostsController@create')->middleware('verified');
Route::get('posts/{tag}/{post}', 'PostsController@show');
Route::get('posts/search', 'SearchController@show');
Route::delete('posts/{tag}/{post}', 'PostsController@destroy');
Route::post('posts', 'PostsController@store');
Route::get('posts/{tag}', 'PostsController@index');
Route::patch('posts/{tag}/{post}', 'PostsController@update');

/*
|--------------------------------------------------------------------------
| Posts Routes
|--------------------------------------------------------------------------
|
*/
Route::post('/posts/{tag}/{post}/replies', 'RepliesController@store');
Route::get('/posts/{tag}/{post}/replies', 'RepliesController@index');

/*
|--------------------------------------------------------------------------
| Favorites Routes
|--------------------------------------------------------------------------
|
*/
Route::post('/replies/{reply}/favorites', 'FavoritesController@store');
Route::delete('/replies/{reply}/favorites', 'FavoritesController@destroy');

/*
|--------------------------------------------------------------------------
| Replies Routes
|--------------------------------------------------------------------------
|
*/
Route::delete('replies/{reply}', 'RepliesController@destroy');
Route::patch('replies/{reply}', 'RepliesController@update');

/*
|--------------------------------------------------------------------------
| Susbscriptions Routes
|--------------------------------------------------------------------------
|
*/
Route::post('/posts/{tag}/{post}/subscriptions', 'PostSubscriptionsController@store')->middleware('auth');
Route::delete('/posts/{tag}/{post}/subscriptions', 'PostSubscriptionsController@destroy')->middleware('auth');

/*
|--------------------------------------------------------------------------
| PRofiles Routes
|--------------------------------------------------------------------------
|
*/
Route::get('/profiles/{user}/activity', 'ProfilesController@activity');
Route::get('/profiles/{user}', 'ProfilesController@show');

/*
|--------------------------------------------------------------------------
| Notifications Routes
|--------------------------------------------------------------------------
|
*/
Route::get('/profiles/{user}/notifications', 'UserNotificationsController@index');
Route::delete('/profiles/{user}/notifications/{notification}', 'UserNotificationsController@destroy');

/*
|--------------------------------------------------------------------------
| Api Users Routes
|--------------------------------------------------------------------------
|
*/
Route::get('api/users', 'Api\UsersController@index');
Route::post('api/users/{user}/avatar', 'Api\UserAvatarController@store')->middleware('auth')->name('avatar');

