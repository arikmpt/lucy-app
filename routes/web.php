<?php

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

Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
    Route::get('/', 'AuthController@indexLogin')->name('auth.index');
    Route::get('/register', 'AuthController@indexRegister')->name('auth.register.index');

    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('/', 'ProfileController@index')->name('index');
    });

    Route::group(['prefix' => 'biodata', 'as' => 'biodata.'], function () {
        Route::get('/', 'BiodataController@index')->name('index');
    });
});


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {

    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('/login', 'AuthController@indexLogin')->name('index');
    });

    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
        Route::get('/', 'DashboardController@index')->name('index');
    });

    Route::group(['prefix' => 'mahasiswa', 'as' => 'mahasiswa.'], function () {
        Route::get('/', 'MahasiswaController@index')->name('index');
    });

    Route::group(['prefix' => 'operator', 'as' => 'operator.'], function () {
        Route::get('/', 'OperatorController@index')->name('index');
    });

    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('/', 'ProfileController@index')->name('index');
    });
});