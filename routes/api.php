<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::post('login', 'App\Http\Controllers\API\UserController@login');
Route::post('register', 'App\Http\Controllers\API\UserController@register');

Route::resource('company', 'App\Http\Controllers\CompanyController');
Route::group(['middleware' => 'auth:api'], function () {
    Route::resource('vendor', 'App\Http\Controllers\VendorController');
    Route::resource('DID', 'App\Http\Controllers\DIDController');
});
