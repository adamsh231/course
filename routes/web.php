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
    Route::get('/home', 'HomeController@home');
    Route::get('/profile', 'HomeController@profile');
    Route::put('/profile', 'HomeController@editProfile');
    Route::get('/kelompok', 'HomeController@kelompok');
    Route::get('/pertemuan/{id_pertemuan}', 'HomeController@pertemuan');
    Route::get('/pertemuan/{id_pertemuan}/materi', 'HomeController@materi');
    Route::get('/kuis/{id_pertemuan}', 'HomeController@kuis');
    Route::get('/latihan/{id_pertemuan}', 'HomeController@latihan');
    Route::post('/nilai/{kuis}', 'HomeController@nilai');
    Route::get('/logout', 'AuthController@logout');
    Route::post('/pertemuan/tugas/{presensi}', 'HomeController@addTugas');
    Route::group(['middleware' => ['isAdmin']], function () {
        Route::get('/admin', 'AdminController@administrator');
        Route::post('/admin/siswa', 'AdminDataController@addSiswa');
        Route::get('/admin/siswa/{siswa}', 'AdminDataController@getSiswaById');
        Route::put('/admin/siswa/{siswa}', 'AdminDataController@editSiswa');
        Route::delete('/admin/siswa/{siswa}', 'AdminDataController@deleteSiswa');
        Route::post('/admin/pertemuan', 'AdminDataController@addPertemuan');
        Route::get('/admin/pertemuan/{id_pertemuan}', 'AdminController@pertemuanDetail');
        Route::get('/admin/pertemuan/{pertemuan}/edit', 'AdminDataController@getPertemuanById');
        Route::put('/admin/pertemuan/{pertemuan}/edit', 'AdminDataController@editPertemuan');
        Route::delete('/admin/pertemuan/{pertemuan}', 'AdminDataController@deletePertemuan');
        Route::post('/admin/pertemuan/hadir', 'AdminController@hadir');
        Route::post('/admin/pertemuan/detail', 'AdminDetailController@addDetail');
        Route::get('/admin/pertemuan/detail/{detail}', 'AdminDetailController@getDetailById');
        Route::put('/admin/pertemuan/detail/{detail}', 'AdminDetailController@editDetail');
        Route::delete('/admin/pertemuan/detail/{detail}', 'AdminDetailController@deleteDetail');
        Route::post('/admin/pertemuan/detail/kegiatan', 'AdminDetailController@addKegiatan');
        Route::get('/admin/pertemuan/detail/kegiatan/{kegiatan}', 'AdminDetailController@getDeskripsiById');
        Route::put('/admin/pertemuan/detail/kegiatan/{kegiatan}', 'AdminDetailController@editDeskripsi');
        Route::delete('/admin/pertemuan/detail/kegiatan/{kegiatan}', 'AdminDetailController@deleteDeskripsi');
        Route::post('/admin/pertemuan/video', 'AdminDetailController@addVideo');
        Route::get('/admin/pertemuan/video/{video}', 'AdminDetailController@getVideoById');
        Route::put('/admin/pertemuan/video/{video}', 'AdminDetailController@editVideo');
        Route::delete('/admin/pertemuan/video/{video}', 'AdminDetailController@deleteVideo');
        Route::post('/admin/pertemuan/kuis/', 'AdminDetailController@addKuis');
        Route::put('/admin/pertemuan/kuis/{kuis}', 'AdminDetailController@editKuis');
        Route::delete('/admin/pertemuan/kuis/{kuis}', 'AdminDetailController@deleteKuis');
        Route::post('/admin/pertemuan/kuis/soal', 'AdminDetailController@addSoal');
        Route::post('/admin/pertemuan/latihan', 'AdminDetailController@addLatihan');
        Route::get('/admin/pertemuan/latihan/{latihan}', 'AdminDetailController@getLatihanById');
        Route::put('/admin/pertemuan/latihan/{latihan}', 'AdminDetailController@editLatihan');
        Route::delete('/admin/pertemuan/latihan/{latihan}', 'AdminDetailController@deleteLatihan');
        Route::get('/admin/pertemuan/kuis/soal/{soal}', 'AdminDetailController@getSoalById');
        Route::put('/admin/pertemuan/kuis/soal/{soal}', 'AdminDetailController@editSoal');
        Route::delete('/admin/pertemuan/kuis/soal/{soal}', 'AdminDetailController@deleteSoal');
        Route::post('/admin/pertemuan/kuis/aktivasi/{kuis}', 'AdminDetailController@aktivasiSoal');
        Route::post('/admin/siswa/acak', 'AdminController@acakTeam');
        Route::get('/admin/pertemuan/{id_pertemuan}/file', 'AdminController@filePertemuan');
        Route::post('/admin/pertemuan/{pertemuan}/file', 'AdminController@addFilePertemuan');
        Route::post('/admin/pertemuan/file/soal/{soal}', 'AdminController@addGambarPertemuan');
        Route::delete('/admin/pertemuan/file/soal/{soal}', 'AdminController@deleteGambarPertemuan');
        Route::get('/admin/nilai/{kuis?}', 'AdminController@nilai');
        Route::put('/admin/nilai/{nilai}', 'AdminDataController@editNilai');
        Route::delete('/admin/nilai/{nilai}', 'AdminDataController@deleteNilai');

        // Route::get('/artisan/migrate/fresh/seed', function(){
        //     Artisan::call('migrate:fresh --seed');
        //     return back();
        // });
    });
});

// Route::fallback(function () {
//     return redirect('/');
// });
