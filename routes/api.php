<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->namespace('Api\v1')->group(function (){

    Route::get('/index'                 , 'IndexController@index');
    Route::post('/login'                , 'UserController@login');
    Route::post('/register'             , 'UserController@register');
    Route::get('/register'              , 'UserController@getregister');
    Route::get('/product'               , 'ProductController@index');
    Route::get('/product/variety'       , 'ProductController@variety');
    Route::get('/product/topview'       , 'ProductController@topview');
    Route::get('/product/{slug}'        , 'ProductController@subproduct');
    Route::get('/supplier'              , 'SupplierController@index');
    Route::get('/supplier/{slug}'       , 'SupplierController@subsupplier');
    Route::get('/technicalunit'         , 'TechnicalunitController@index');
    Route::get('/technicalunit/{slug}'  , 'TechnicalunitController@subtechnical');
    Route::get('/market/sell'           , 'MarketController@sell');
    Route::get('/market/buy'            , 'MarketController@buy');
    Route::post('remember'              , 'UserController@remember');
    Route::post('/token'                , 'UserController@token');
    Route::post('/search/product'       , 'SearchController@product');
    Route::post('/search/unicode'       , 'SearchController@unicode');
    Route::post('/search/supplier'      , 'SearchController@supplier');
    Route::post('/search/technical'     , 'SearchController@technical');
    Route::post('/search/offersell'     , 'SearchController@offersell');
    Route::post('/search/offerbuy'      , 'SearchController@offerbuy');
    Route::get('/filter/product'        , 'SearchController@productfilter');
    Route::get('/filter/supplier'       , 'SearchController@supplierfilter');
    Route::get('/filter/technical'      , 'SearchController@technicalfilter');
    Route::get('/filter/offersell'      , 'SearchController@sellfilter');
    Route::get('/filter/offerbuy'       , 'SearchController@buyfilter');
    Route::get('/filter/state'          , 'SearchController@state');
    Route::post('comment'               , 'CommentController@comment');
    Route::post('rate-number'           , 'CommentController@commentrate');
    Route::get('carbrand'               , 'IndexController@carbrand');
    Route::get('carproduct'             , 'IndexController@carproduct');
    Route::post('carmodel'              , 'IndexController@carmodel');


Route::middleware('auth:api')->group(function (){
    Route::post('/recoverpass'                      , 'UserController@recoverpass');
    Route::get('/profile'                           , 'UserController@profile');
    Route::post('/supplier/store'                   , 'SupplierController@store');
    Route::post('/supplier/carsupplierstore'        , 'SupplierController@carsupplierstore');
    Route::post('/technicalunit/store'              , 'TechnicalunitController@store');
    Route::post('/technicalunit/cartechnicalstore'  , 'TechnicalunitController@cartechnicalstore');
    Route::post('/product/createproductvariety'     , 'ProductController@createproductvariety');
    Route::post('/offer/store'                      , 'OfferController@store');
    Route::post('/offer/carofferstore'              , 'OfferController@carofferstore');
    Route::post('/user/update'                      , 'UserController@update');
    Route::post('/technicalunit/delete'             , 'TechnicalunitController@technicaldelete');
    Route::delete('/supplier/delete'                , 'SupplierController@supplierdelete');
    Route::delete('/technical/delete'               , 'TechnicalunitController@technicaldelete');



    });

});
