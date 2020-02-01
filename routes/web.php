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

Route::get('/', ['as'=>'home', 'uses'=>'HomeController@index'])->middleware('verified');

/*
*--------------------------------------------------------------------------
*   Posts
*--------------------------------------------------------------------------
*/

Route::get('/post/{id}', ['as'=>'post.show', 'uses'=>'AdminPostsController@show']);
Route::get('/posts/', ['as'=>'post.index', 'uses'=>'AdminPostsController@index']);
Route::get('/posts/{id}', ['as'=>'post.edit', 'uses'=>'AdminPostsController@edit']);
Route::get('/posts/{id}', ['as'=>'post.create', 'uses'=>'AdminPostsController@create']);
Route::patch('/posts/{id}', ['as'=>'post.create', 'uses'=>'AdminPostsController@create']);

Route::resource('/posts', 'AdminPostsController');

Route::group(['middleware'=>'admin'], function(){

    Route::get('/admin', function(){

        return view('layouts.admin');
    })->name('dashboard');

    Route::resource('admin/users', 'AdminUsersController');



    Route::resource('admin/categories', 'AdminCategoriesController');

    Route::resource('admin/media', 'AdminMediaController');
    Route::post('admin/media-bulkdelete', ['as'=>'media.bulkdelete', 'uses'=>'AdminMediaController@destroyMany']);

    Route::resource('admin/comments', 'PostCommentsController');

    Route::resource('admin/comment/replies', 'CommentRepliesController');
});

Route::group(['middleware'=>'auth'], function(){

    Route::post('comment/reply', 'CommentRepliesController@createReply');
});
