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
Route::group(['middleware' => ['islogout']], function () {
    Route::get('/', function () {
        return view('landing');
    });
    Route::get('/login', function () {
        return view('login');
    });
    Route::post('/login', 'AuthController@login');
    Route::get('/register', function () {
        return view('register');
    });
    Route::post('/register', 'AuthController@register');
});

Route::group(['middleware' => ['islogin']], function () {
    Route::get('/home', function () {
        return view('home');
    });
    Route::get('/pertemuan', function () {
        return view('pertemuan');
    });

    Route::get('/admin', 'AdminController@administrator');
    Route::get('/admin/pertemuan/{pertemuan}', 'AdminController@pertemuanDetail');

    Route::get('/logout', 'AuthController@logout');
});
