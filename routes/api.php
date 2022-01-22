<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->namespace('Api\v1')->group(function (){

    Route::get('/'           , 'IndexController@index');
    Route::post('/login'     , 'UserController@login');
    Route::post('/register'  , 'UserController@register');

    Route::middleware('auth:api')->group(function (){
        Route::get('/user' , function (){
            return auth()->user();
        });
    });

});
