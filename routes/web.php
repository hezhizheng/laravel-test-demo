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

Route::get('/demo/encrypt', 'Demo\EncryptController@encrypt');
Route::any('/time', 'Demo\DebugController@time');
Route::any('/test-redis-lock', 'Demo\DebugController@testRedisLock');

Route::any('/dd', 'Demo\DebugController@dd');

Route::resource('/events', 'Demo\EventController');
Route::resource('/jobs', 'Demo\JobController');

Route::resource('/lock', 'Demo\LockController');
Route::resource('/users', 'Demo\UserController');

Route::resource('/order', 'Demo\OrderController');

Route::any('/free-pic', 'Demo\DebugController@freePic');
