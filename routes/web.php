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

    Route::prefix('golongan')->group(function(){
        Route::get('/', 'GolonganController@index');
        Route::post('/store-golongan/{id?}', 'GolonganController@store');
        Route::get('/delete-golongan/{id?}', 'GolonganController@delete');
    });

    Route::prefix('divisi')->group(function(){
        Route::get('/', 'DivisiController@index')->name('divisi');
        Route::get('/form-divisi/{id?}', 'DivisiController@formDivisi')->name('form-divisi');
        Route::post('/save-divisi/{id?}', 'DivisiController@saveDivisi');
    });

    Route::prefix('gaji')->group(function(){
        Route::get('/', 'GajiController@index')->name('gaji');
        Route::get('/form-gaji/{id?}', 'GajiController@formGaji')->name('form-gaji');
        Route::post('/save-gaji/{id?}', 'GajiController@saveGaji');
    });

    Route::prefix('detail-gaji')->group(function(){
        Route::get('/', 'DetailGajiController@index')->name('detail-gaji');
        // Route::get('/form-detail-gaji/{id?}', 'DetailGajiController@formGaji')->name('form-detail-gaji');
        Route::post('/generate-detail-gaji', 'DetailGajiController@GenerateGaji');
        Route::get('/{id?}', 'DetailGajiController@detailGaji')->name('detail-gaji-karyawan');
    });

    Route::prefix('potongan')->group(function(){
        Route::get('/', 'PotonganController@index')->name('potongan');
        Route::get('/form-potongan/{id?}', 'PotonganController@formPotongan')->name('form-potongan');
        Route::post('/save-potongan/{id?}', 'PotonganController@savePotongan');
    });
});

// Route::get('/example-page', function () {
//     return view('layout-admin.example-page-content');
// });