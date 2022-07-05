<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->namespace('Api\v1')->group(function (){
    Route::get('/index'                             , 'IndexController@index');
    Route::post('/login'                            , 'UserController@login');
    Route::post('/register'                         , 'UserController@register');
    Route::get('/register'                          , 'UserController@getregister');
    Route::get('/product'                           , 'ProductController@index');
    Route::get('/product/search'                    , 'ProductController@sproduct');
    Route::get('/product/variety'                   , 'ProductController@variety');
    Route::get('/product/topview'                   , 'ProductController@topview');
    Route::get('/product/{slug}'                    , 'ProductController@subproduct');
    Route::get('/supplier'                          , 'SupplierController@index');
    Route::get('/supplier/{slug}'                   , 'SupplierController@subsupplier');
    Route::get('/technicalunit'                     , 'TechnicalunitController@index');
    Route::get('/technicalunit/{slug}'              , 'TechnicalunitController@subtechnical');
    Route::get('/market/sell'                       , 'MarketController@sell');
    Route::get('/market/buy'                        , 'MarketController@buy');
    Route::get('/market/{slug}'                     , 'MarketController@submarket');
    Route::post('remember'                          , 'UserController@remember');
    Route::post('/token'                            , 'UserController@token');
    Route::get('/search/unicode'                    , 'SearchController@searchunicode');
    Route::get('/filter/product'                    , 'SearchController@productfilter');
    Route::get('/filter/supplier'                   , 'SearchController@supplierfilter');
    Route::get('/filter/technical'                  , 'SearchController@technicalfilter');
    Route::get('/filter/offersell'                  , 'SearchController@sellfilter');
    Route::get('/filter/offerbuy'                   , 'SearchController@buyfilter');
    Route::get('/filter/state'                      , 'SearchController@state');
    Route::post('comment'                           , 'CommentController@comment');
    Route::post('rate-number'                       , 'CommentController@commentrate');
    Route::get('carbrand'                           , 'IndexController@carbrand');
    Route::get('carproduct'                         , 'IndexController@carproduct');
    Route::post('carmodel'                          , 'IndexController@carmodel');
    Route::get('brand'                              , 'IndexController@brand');
    Route::get('brand/{slug}'                       , 'IndexController@subbrand');
    Route::get('productgroup'                       , 'IndexController@productgroup');
    Route::get('productvariety/{slug}/{id}'         , 'ProductController@subproductvariety');


    Route::middleware('auth:api')->group(function (){

        Route::post('/recoverpass'                      , 'UserController@recoverpass');
        Route::get('/profile'                           , 'UserController@profile');
        Route::get('bmpsupplier'                        , 'SupplierController@bmpsupplier');
        Route::get('bmptechnical'                       , 'TechnicalunitController@bmptechnical');
        Route::get('bmpsell'                            , 'MarketController@bmpsell');
        Route::get('bmpmarket'                          , 'MarketController@bmpmarket');
        Route::post('/supplier/store'                   , 'SupplierController@store');
        Route::post('/supplier/edit/{id}'               , 'SupplierController@updatesupplier');
        Route::post('/supplier/carsupplierstore'        , 'SupplierController@carsupplierstore');
        Route::post('/technicalunit/store'              , 'TechnicalunitController@store');
        Route::post('/technicalunit/edit/{id}'          , 'TechnicalunitController@updatetechnical');
        Route::post('/technicalunit/cartechnicalstore'  , 'TechnicalunitController@cartechnicalstore');
        Route::post('/product/create/productvariety'    , 'ProductController@createproductvariety');
        Route::get('productvariety'                     , 'ProductController@productvariety');
        Route::post('/offer/store'                      , 'OfferController@store');
        Route::post('/offer/edit/{id}'                  , 'OfferController@update');
        Route::post('/offer/carofferstore'              , 'OfferController@carofferstore');
        Route::post('/user/update'                      , 'UserController@update');
        Route::post('/technicalunit/delete'             , 'TechnicalunitController@technicaldelete');
        Route::delete('/supplier/delete'                , 'SupplierController@supplierdelete');
        Route::delete('/technical/delete'               , 'TechnicalunitController@technicaldelete');
        Route::get('/mark'                              , 'IndexController@markuser');
        Route::post('/mark'                             , 'IndexController@markusercreate');
        Route::delete('/unmark/{id}'                    , 'IndexController@markdelete');
        Route::delete('/productvariety/delete/{id}'     , 'ProductController@productbrandvaritydelete');

        Route::delete('/supplier/carsupplierdelete/{id}'        , 'SupplierController@carsupplierdelete' )->name('carsupplierdelete');
        Route::delete('/technicalunit/cartechnicaldelete/{id}'  , 'TechnicalunitController@cartechnicaldelete' )->name('cartechnicaldelete');
        Route::delete('/offer/carofferdelete/{id}'              , 'OfferController@carofferdelete')->name('carofferdelete');

    });

});
