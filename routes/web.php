<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/questions','ForumController@questions_view')->name('questions');
Route::get('/search','ForumController@search')->name('search');
Route::get('/oldest','ForumController@oldest')->name('oldest');
Route::get('/newest','ForumController@questions_view')->name('newest');

// Route::get('search','ForumController@search');
Route::group(['middleware'=>'auth'],function(){
	Route::get('/newpost', 'ForumController@addpost_view')->name('newpost');
	Route::get('/home','HomeController@index')->name('home');
	Route::post('post','ForumController@post')->name('post');
});

Auth::routes();
