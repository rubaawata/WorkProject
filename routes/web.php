<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'MapController@index');
Route::get('/Two/{x1}/{x2}/{y1}/{y2}', 'DistanceController@distanceBetweenTwoChosenPoint');
Route::get('/one/{x1}/{x2}/{y1}/{y2}', 'DistanceController@distanceBetweenUserAndChosenPoint');
Route::resource('/provider', 'ProvidersController');
