<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
Route::group(['prefix'=>'admin','middleware'=>  ['auth'] ], function () {
    // Route::get('/home','Admin\HomeController@index')->name('admin_home');
    Route::get('/home','HomeController@index')->name('admin_home');
    Route::post('/file/upload','Admin\HomeController@file_upload')->name('admin_file_upload');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
