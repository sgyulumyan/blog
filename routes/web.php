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
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');
Route::post('/avatar', 'HomeController@avatar_add');

Route::get('/blog', 'BlogController@index');
Route::get('read_more/{id}', 'BlogController@read_more');
Route::post('/readmore/addcomment', 'BlogController@readmore_addcomment');


Route::post('/home/post/add', 'PostController@add');
// Route::post('/home/post/add', 'PostController@store');
Route::post('/post/edit', 'PostController@edit');
Route::post('/post/delete', 'PostController@delete');
Route::get('/search', 'BlogController@search');


Route::post('/home/comment/add', 'CommentController@add');
Route::post('/comment/edit', 'CommentController@edit');
Route::post('/comment/delete', 'CommentController@delete');