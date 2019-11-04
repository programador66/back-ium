<?php


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


Route::prefix('cliente')->group( function(){
    Route::post('/cadastro','UserController@newUser');
    Route::post('/login', 'UserController@login');
    Route::get('/usuario', 'UserController@getUser');
});
// Route::middleware('auth:api')->get('/usuario', 'UserController@getUser');
