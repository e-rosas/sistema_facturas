<?php
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
Route::group(['middleware' => 'auth'], function () {
    Route::apiResource('insurances', 'InsuranceController');
    Route::post('insurances/find', 'InsuranceController@find')->name('insurances.find');
    Route::post('insurances/select', 'InsuranceController@select')->name('insurances.select');
});