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
Route::group(['namespace' => 'Site'] , function () {
    Route::get('/', 'IndexController@index')->name('/');
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Auth'] , function (){
    // Authentication Routes...
    Route::get('login'      , 'LoginController@showLoginuserForm')->name('loginuser');
    Route::get('remember'   , 'LoginController@showLoginrememberForm')->name('remember');
    Route::post('login-user', 'LoginController@loginuser')->name('login-user');
    Route::get('logout'     , 'LoginController@logout')->name('logout');

    // Registration Routes...
    Route::get('register'   , 'RegisterController@showRegistrationuserForm');
    Route::post('register'  , 'RegisterController@registeruser')->name('register');
    Route::get('token'      , 'TokenController@showToken')->name('phone.token');
    Route::post('token'     , 'TokenController@token')->name('verify.phone.token');
    Route::get('welcome'    , 'WelcomeController@index' )->name('welcome');

});
