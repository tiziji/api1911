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
Route::get('/wx/token','TestController@getAccessToken');
Route::get('/wx/token2','TestController@getAccessToken2');
Route::get('/wx/token3','TestController@getAccessToken3');
Route::get('/test1','TestController@test1');
Route::get('/test2','TestController@test2');
Route::get('/jiami','TestController@jiami');
Route::get('/aes','TestController@aes');
Route::get('/sign','TestController@sign');
Route::get('/aessign','TestController@aessign');

