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
Route::match(['post', 'get'], '/', [\App\Http\Controllers\AuthController::class, 'login']);
Route::match(['post', 'get'], '/register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index']);

Route::group(['prefix' => 'karyawan'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\KaryawanController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Admin\KaryawanController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Admin\KaryawanController::class, 'create']);
    Route::get( '/edit/{id}', [\App\Http\Controllers\Admin\KaryawanController::class, 'edit_page']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\KaryawanController::class, 'patch']);
    Route::post( '/delete', [\App\Http\Controllers\Admin\KaryawanController::class, 'destroy']);
});

Route::group(['prefix' => 'peserta'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\PesertaController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Admin\PesertaController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Admin\PesertaController::class, 'create']);
    Route::get( '/edit/{id}', [\App\Http\Controllers\Admin\PesertaController::class, 'edit_page']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\PesertaController::class, 'patch']);
    Route::post( '/delete', [\App\Http\Controllers\Admin\PesertaController::class, 'destroy']);
});

Route::group(['prefix' => 'divisi'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\BagianController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Admin\BagianController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Admin\BagianController::class, 'create']);
    Route::get( '/edit/{id}', [\App\Http\Controllers\Admin\BagianController::class, 'edit_page']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\BagianController::class, 'patch']);
    Route::post( '/delete', [\App\Http\Controllers\Admin\BagianController::class, 'destroy']);
});

Route::group(['prefix' => 'kegiatan'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\KegiatanController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Admin\KegiatanController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Admin\KegiatanController::class, 'create']);
    Route::get( '/edit/{id}', [\App\Http\Controllers\Admin\KegiatanController::class, 'edit_page']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\KegiatanController::class, 'patch']);
    Route::post( '/delete', [\App\Http\Controllers\Admin\KegiatanController::class, 'destroy']);
    Route::get( '/cetak', [\App\Http\Controllers\Laporan\KegiatanController::class, 'cetak']);
});

Route::group(['prefix' => 'pengajuan'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\PengajuanController::class, 'index']);
    Route::match(['post', 'get'], '/{id}', [\App\Http\Controllers\Admin\PengajuanController::class, 'detail']);
});

Route::group(['prefix' => 'pengajuan-magang'], function () {
    Route::get( '/', [\App\Http\Controllers\Peserta\PengajuanController::class, 'index']);
    Route::get( '/{id}/detail', [\App\Http\Controllers\Peserta\PengajuanController::class, 'detail']);
    Route::get( '/tambah', [\App\Http\Controllers\Peserta\PengajuanController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Peserta\PengajuanController::class, 'create']);
});

Route::group(['prefix' => 'peserta-bimbingan'], function () {
    Route::get( '/', [\App\Http\Controllers\Pembimbing\PesertaController::class, 'index']);
    Route::get( '/{id}/detail', [\App\Http\Controllers\Pembimbing\PesertaController::class, 'detail']);
    Route::post( '/{id}/nilai', [\App\Http\Controllers\Pembimbing\PesertaController::class, 'nilai']);
});

Route::group(['prefix' => 'laporan-peserta'], function () {
    Route::get( '/', [\App\Http\Controllers\Laporan\PesertaController::class, 'index']);
    Route::get( '/cetak', [\App\Http\Controllers\Laporan\PesertaController::class, 'cetak']);
});

Route::group(['prefix' => 'laporan-kegiatan'], function () {
    Route::get( '/', [\App\Http\Controllers\Laporan\KegiatanPesertaController::class, 'index']);
    Route::get( '/data', [\App\Http\Controllers\Laporan\KegiatanPesertaController::class, 'laporan_kegiatan']);
    Route::get( '/cetak', [\App\Http\Controllers\Laporan\KegiatanPesertaController::class, 'cetak']);
});
