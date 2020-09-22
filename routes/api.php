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


Route::prefix('snippets')->middleware('auth:api')->group(function() {
    Route::get('/', "SnippetController@index");
    Route::post('/', "SnippetController@store");

    Route::prefix('{snippet}')->group(function() {
        Route::get('/', "SnippetController@show");
        Route::patch('/', "SnippetController@update");
        Route::put('/', "SnippetController@update");
        Route::delete('/', "SnippetController@destroy");
    });
});

Route::prefix('users')->middleware('auth:api')->group(function() {
    Route::get('/', "UserController@index");
    Route::post('/', "UserController@store");

    Route::prefix('{user}')->group(function() {
        Route::get('/', "UserController@show");
        Route::patch('/', "UserController@update");
        Route::put('/', "UserController@update");
        Route::delete('/', "UserController@destroy");
    });
});
