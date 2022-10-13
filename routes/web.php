<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes([
    'verify' => true,
    'logout' => true
]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return redirect('/home');
    });
    Route::get('{any}', "HomeController@index")->where('any', '.*');
});

