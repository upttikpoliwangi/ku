<?php

use Illuminate\Support\Facades\Route;
use Modules\Kui\Entities\Kegiatankerjasama;
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

// use Illuminate\Routing\Route;
use Modules\Kui\Http\Controllers\KegiatankerjasamaController;
use Modules\Kui\Http\Controllers\VisimisiController;

// Route::prefix('kui')->group(function() {
//     Route::get('/', 'KuiController@index');
// });

Route::prefix('kui')->group(function () {
    //kegiatan kerjasama
    Route::prefix('kegiatankerjasama')->group(function () {
        Route::get('/', 'KegiatankerjasamaController@index');
        Route::get('/create', 'KegiatankerjasamaController@create');
        Route::post('/store', 'KegiatankerjasamaController@store');
        Route::get('/edit/{id}', 'KegiatankerjasamaController@edit');
        Route::put('/update/{id}', 'KegiatankerjasamaController@update');
        Route::delete('/delete/{id}', 'KegiatankerjasamaController@destroy');
        Route::get('/view/{filename}', 'KegiatankerjasamaController@viewDocument');
    });
    // panduan
    Route::prefix('panduan')->group(function () {
        Route::get('/', 'PanduanController@index');
        Route::get('/create', 'PanduanController@create');
        Route::post('/store', 'PanduanController@store');
        Route::get('/edit/{id}', 'PanduanController@edit');
        Route::put('/update/{id}', 'PanduanController@update');
        Route::delete('/delete/{id}', 'PanduanController@destroy');
        Route::get('/view/{filename}', 'PanduanController@viewDocument');
    });
    // data kerjasama
    Route::prefix('datakerjasama')->group(function () {
        Route::get('/', 'KerjasamaController@index');
        Route::get('/create', 'KerjasamaController@create');
        Route::post('/store', 'KerjasamaController@store');
        Route::get('/edit/{id}', 'KerjasamaController@edit');
        Route::put('/update/{id}', 'KerjasamaController@update');
        Route::delete('/delete/{id}', 'KerjasamaController@destroy');
    });
    // struktur organisasi
    Route::prefix('strukturorganisasi')->group(function () {
        Route::get('/', 'StrukturorganisasiController@index');
        Route::get('/create', 'StrukturorganisasiController@create');
        Route::post('/store', 'StrukturorganisasiController@store');
        Route::get('/edit/{id}', 'StrukturorganisasiController@edit');
        Route::put('/update/{id}', 'StrukturorganisasiController@update');
        Route::delete('/delete/{id}', 'StrukturorganisasiController@destroy');
    });
    // visi dan misi
    Route::prefix('visimisi')->group(function () {
        Route::get('/', 'visimisiController@index');
        Route::get('/create', 'visimisiController@create');
        Route::post('/store', 'visimisiController@store');
        Route::get('/edit/{id}', 'visimisiController@edit');
        Route::put('/update/{id}', 'visimisiController@update');
        Route::delete('/delete/{id}', 'visimisiController@destroy');
    });
    // data file mou
    Route::prefix('datamou')->group(function () {
        Route::get('/', 'DatamouController@index');
        Route::get('/create', 'DatamouController@create');
        Route::post('/store', 'DatamouController@store');
        Route::get('/edit/{id}', 'DatamouController@edit');
        Route::put('/update/{id}', 'DatamouController@update');
        Route::delete('/delete/{id}', 'DatamouController@destroy');
        Route::get('/view/{id}', 'DatamouController@view');
        Route::get('/download/{id}', 'DatamouController@download');
    });
    Route::prefix('admin/kui')->group(function () {
        Route::get('/visimisi/create', [VisimisiController::class, 'create'])->name('kui.visimisi.create');
        Route::post('/visimisi/store', [VisimisiController::class, 'store'])->name('kui.visimisi.store');
        Route::get('/visimisi/edit/{id}', [VisimisiController::class, 'create'])->name('kui.visimisi.edit');
        Route::get('/landing/{slug}', [VisiMisiController::class, 'showBySlug'])->name('kui.landing.visimisi');
    });
    // data aktivitas
    Route::prefix('dataaktivitas')->group(function () { 
        Route::get('/', 'DataaktivitasController@index');
        Route::get('/create', 'DataaktivitasController@create');
        Route::post('/store', 'DataaktivitasController@store');
        Route::get('/edit/{id}', 'DataaktivitasController@edit');
        Route::put('/update/{id}', 'DataaktivitasController@update');
        Route::delete('/delete/{id}', 'DataaktivitasController@destroy');
        Route::get('/show/{id}', 'DataaktivitasController@show_dataaktivitas');
    });
});
