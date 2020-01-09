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

//Route::get('/demo/encrypt', function () {
//    dd(2353425);
//});

Route::get('/demo/encrypt','Demo\EncryptController@encrypt');
//Route::get('/demo/encrypt',['uses' => '\Demo\EncryptController@encrypt']);
