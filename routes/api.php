<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/subscribers','User\HomeControllerApi@index')->name('all_subscriber');
Route::get('/subscribers/{id}','User\HomeControllerApi@show')->name('subscriber');
Route::post('/subscribers/add','User\HomeControllerApi@store')->name('create_subscriber');
Route::put('/subscribers/edit/{id}','User\HomeControllerApi@update')->name('update_subscriber');
Route::delete('/subscribers/{id}','User\HomeControllerApi@destroy')->name('delete_subscriber');
