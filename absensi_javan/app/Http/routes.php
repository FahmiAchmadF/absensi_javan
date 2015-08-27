<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('index', 'AbsensiController@index');

Route::get('indexjammasukterlambat', 'AbsensiController@indexjammasukterlambat');

Route::get('indexjamkeluar', 'AbsensiController@indexjamkeluar');

Route::get('indexnama', 'AbsensiController@indexnama');

Route::get('indextidakmasuk', 'AbsensiController@indextidakmasuk');

Route::get('angularjs', 'AbsensiController@cobaangularjs');