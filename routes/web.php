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

 //!pass data pertemuan
Route::group(['middleware' => ['islogin']], function () {
    //!DONE
    Route::get('/home', 'HomeController@home');
    //!DONE
    Route::get('/pertemuan/{id_pertemuan}', 'HomeController@pertemuan');

    Route::group(['middleware' => ['isAdmin']], function () {
        //!DONE
        Route::get('/admin', 'AdminController@administrator');
        //!DONE
        Route::get('/admin/pertemuan/{id_pertemuan}', 'AdminController@pertemuanDetail');
        //!DONE
        Route::get('/admin/add/siswa', function () {
            return view('admin_add_siswa', ['pertemuan' => App\Pertemuan::all()]);
        });
        //!DONE
        Route::post('/admin/add/siswa', 'AuthController@register');
    });

    //! Unnecessary
    Route::get('/logout', 'AuthController@logout');
});
