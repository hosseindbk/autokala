<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->namespace('Api\v1')->group(function (){

    Route::get('/index'         , 'IndexController@index');
    Route::post('/login'        , 'UserController@login');
    Route::post('/register'     , 'UserController@register');
    Route::get('/register'      , 'UserController@getregister');
    Route::get('/product'       , 'ProductController@index');
    Route::get('/supplier'      , 'SupplierController@index');
    Route::get('/technicalunit' , 'TechnicalunitController@index');

    Route::middleware('auth:api')->group(function (){
        Route::post('/token'         , 'UserController@token');

        Route::get('/user' , function (){
            return auth()->user();
        });
    });

});
