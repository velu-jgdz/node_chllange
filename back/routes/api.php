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

Route::post('register', 'Api\UserController@register')->name('register');
Route::post('login', 'Api\UserController@login')->name('login');
Route::post('createaccount', 'Api\AccountController@addAccount')->name('createaccount');
Route::post('myaccount', 'Api\AccountController@myAccounts')->name('myaccount');
Route::post('checkaccount', 'Api\AccountController@checkAccount')->name('checkaccount');
Route::post('addtransaction', 'Api\AccountController@createTransaction')->name('addtransaction');