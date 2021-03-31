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


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index');

Route::resource('users', 'UserController');

Route::get('cache', 'CachingTestController@index');
Route::get('last-modified.js', 'CachingTestController@lastModified')->name('cache.last_modified');
Route::get('etag.js', 'CachingTestController@etag')->name('cache.etag')->middleware('etag');
Route::get('expires.js', 'CachingTestController@expires')->name('cache.expires');
Route::get('cache-control.js', 'CachingTestController@cacheControl')->name('cache.cache_control');
