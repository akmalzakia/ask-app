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

Route::get('/','ForumController@index')->name('index');
Route::get('/questions','ForumController@questions_view')->name('questions');
// Route::get('/search','ForumController@search')->name('search');
Route::get('/questions/oldest/{search?}','ForumController@questions_view')->name('oldest');
Route::get('/questions/newest/{search?}','ForumController@questions_view')->name('newest');
Route::get('/post/{id}','ForumController@post_view')->name('post_view');
Route::get('/post/{id}/oldest/','ForumController@post_view')->name('oldest-ans');
Route::get('/post/{id}/newest','ForumController@post_view')->name('newest-ans');

// Route::get('search','ForumController@search');
Route::group(['middleware'=>'auth'],function(){
	Route::get('/newpost', 'ForumController@addpost_view')->name('newpost');
	Route::get('/home','HomeController@index')->name('home');
	Route::post('post','ForumController@post')->name('post');
	Route::post('answer/{id}','ForumController@answer')->name('answer');
	Route::get('edit-post/{id}','ForumController@post_view')->name('edit-post');
	Route::get('edit-ans/{id}/{ans_id}','ForumController@post_view')->name('edit-ans');
	Route::put('update-post/{id}','ForumController@update')->name('update-post');
	Route::put('update-ans/{id}/{ans_id}','ForumController@update')->name('update-ans');
	Route::get('delete/{id}/{ans_id?}','ForumController@delete')->name('delete');
});

Auth::routes();
