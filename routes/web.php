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
    Route::post('/register/store', 'AuthController@register')->name('auth.register.store');
    Route::post('/login', 'AuthController@login')->name('auth.login');

    Route::group(['middleware' => 'auth'], function () {
        Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
            Route::get('/', 'ProfileController@index')->name('index');
            Route::put('/update', 'ProfileController@update')->name('update');
            Route::put('/change-password', 'ProfileController@changePassword')->name('change_password');
        });
    
        Route::group(['prefix' => 'biodata', 'as' => 'biodata.'], function () {
            Route::get('/', 'BiodataController@index')->name('index');
        });

        Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
            Route::get('/logout', 'AuthController@logout')->name('logout');
        });
    });
});


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {

    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('/login', 'AuthController@indexLogin')->name('index');
        Route::post('/login/process', 'AuthController@login')->name('login');
    });

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
            Route::get('/logout', 'AuthController@logout')->name('logout');
        });
    
        Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
            Route::get('/', 'DashboardController@index')->name('index');
        });
    
        Route::group(['prefix' => 'mahasiswa', 'as' => 'mahasiswa.'], function () {
            Route::get('/', 'MahasiswaController@index')->name('index');
            Route::get('/new', 'MahasiswaController@new')->name('new');
        });
    
        Route::group(['prefix' => 'school', 'as' => 'school.'], function () {
            Route::group(['prefix' => 'district', 'as' => 'district.'], function () {
                Route::get('/', 'SchoolDistrictController@index')->name('index');
                Route::post('/store', 'SchoolDistrictController@store')->name('store');
                Route::delete('/destroy', 'SchoolDistrictController@destroy')->name('destroy');
                Route::get('/edit/{id}', 'SchoolDistrictController@edit')->name('edit');
                Route::post('/update', 'SchoolDistrictController@update')->name('update');
            });
            Route::group(['prefix' => 'major', 'as' => 'major.'], function () {
                Route::get('/', 'SchoolMajorController@index')->name('index');
                Route::post('/store', 'SchoolMajorController@store')->name('store');
                Route::delete('/destroy', 'SchoolMajorController@destroy')->name('destroy');
                Route::get('/edit/{id}', 'SchoolMajorController@edit')->name('edit');
                Route::post('/update', 'SchoolMajorController@update')->name('update');
            });
        });
    
        Route::group(['prefix' => 'operator', 'as' => 'operator.'], function () {
            Route::get('/', 'OperatorController@index')->name('index');
            Route::post('/store', 'OperatorController@store')->name('store');
            Route::delete('/destroy', 'OperatorController@destroy')->name('destroy');
            Route::get('/edit/{id}', 'OperatorController@edit')->name('edit');
            Route::post('/update', 'OperatorController@update')->name('update');
        });
    
        Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
            Route::get('/', 'ProfileController@index')->name('index');
            Route::put('/update', 'ProfileController@update')->name('update');
            Route::put('/change-password', 'ProfileController@changePassword')->name('change_password');
        });
    });
});