<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/lists', 'App\Http\Controllers\ApiController@index');
    Route::post('/lists', 'App\Http\Controllers\ApiController@store');
    Route::delete('/lists/{list}', 'App\Http\Controllers\ApiController@destroy');
    Route::get('/lists/{list}/games/{game}', 'App\Http\Controllers\ApiController@addGame');
    Route::delete('/lists/{list}/games/{game}', 'App\Http\Controllers\ApiController@removeGame');

});
