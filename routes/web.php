<?php

/*
|--------------------------------------------------------------------------
|   Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

Route::get('/', function(){

    return view('welcome');
})->name('home');

Route::get('/dashboard', ['as'=>'dashboard', 'uses'=>'HomeController@index']);

Route::get('/post/{id}', ['as'=>'posts.show', 'uses'=>'PostsController@show']);

Route::group(['middleware'=>'verified'], function(){

    Route::resource('posts', 'PostsController', ['except' => ['show']]);

    Route::resource('users', 'UsersController');

    Route::resource('categories', 'CategoriesController');

    Route::resource('media', 'MediaController');
    Route::post('media/bulk-delete', ['as'=>'media.destroyMany', 'uses'=>'MediaController@destroyMany']);

    Route::resource('comments', 'PostCommentsController');

    Route::resource('comment/replies', 'CommentRepliesController');

    Route::post('comment/reply', 'CommentRepliesController@createReply');
});
