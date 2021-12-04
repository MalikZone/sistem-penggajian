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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('admin')->group(function(){
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::prefix('karyawan')->group(function(){
        Route::get('/', 'KaryawanController@index')->name('karyawan');
        Route::get('/form-karyawan/{id?}', 'KaryawanController@formKaryawan')->name('form-karyawan');
        Route::post('/save-karyawan/{id?}', 'KaryawanController@saveKaryawan');
        // Route::delete('/delete-karyawan/{id}', 'KaryawanController@deleteKaryawan');
    });

    Route::prefix('absensi')->group(function(){
        Route::get('/', 'AbsensiController@index')->name('absensi');
        Route::get('/form-absensi/{id?}', 'AbsensiController@formAbsensi')->name('form-absensi');
        Route::post('/save-absensi/{id?}', 'AbsensiController@saveAbsensi');
    });

    Route::prefix('divisi')->group(function(){
        Route::get('/', 'DivisiController@index')->name('divisi');
        Route::get('/form-divisi/{id?}', 'DivisiController@formDivisi')->name('form-divisi');
        Route::post('/save-divisi/{id?}', 'DivisiController@saveDivisi');
    });
});

// Route::get('/example-page', function () {
//     return view('layout-admin.example-page-content');
// });