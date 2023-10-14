<?php

use App\Http\Controllers\ExportController;
use App\Http\Controllers\MasterDataSiswaController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\Tabungan\BukuTabunganController;
use App\Http\Controllers\Tabungan\RekeningController;
use App\Http\Controllers\Tabungan\TransaksiTabunganController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\TahunAjarController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImportController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/me', [AuthController::class, 'me']);

});

Route::group(['middleware' => 'apiauthmid'], function ($router) {
    // START DATA SISWA
    Route::get('/siswa', [SiswaController::class, 'get']);
    Route::post('/siswa', [SiswaController::class, 'create']);
    Route::put('/siswa', [SiswaController::class, 'update']);
    Route::put('/siswa/pulihkan', [SiswaController::class, 'restore']);
    Route::delete('/siswa', [SiswaController::class, 'delete']);

    Route::get('/siswa/perkelas', [MasterDataSiswaController::class, 'getSiswaPerkelas']);
    // END DATA SISWA

    // START DATA KELAS
    Route::get('/kelas', [KelasController::class, 'get']);
    Route::post('/kelas', [KelasController::class, 'create']);
    Route::put('/kelas', [KelasController::class, 'update']);
    Route::put('/kelas/pulihkan', [KelasController::class, 'restore']);
    Route::delete('/kelas', [KelasController::class, 'delete']);

    Route::get('/kelas/dari-tahun-ajar', [MasterDataSiswaController::class, 'getKelasDariTahunAjar']);
    // END DATA KELAS

    // START DATA JURUSAN
    Route::get('/jurusan', [JurusanController::class, 'get']);
    Route::get('/jurusan/untuk-input-option', [JurusanController::class, 'getUntukInputOption']);
    Route::post('/jurusan', [JurusanController::class, 'create']);
    Route::put('/jurusan', [JurusanController::class, 'update']);
    Route::put('/jurusan/pulihkan', [JurusanController::class, 'restore']);
    Route::delete('/jurusan', [JurusanController::class, 'delete']);
    // END DATA JURUSAN

    // START DATA TAHUN AJAR
    Route::get('/tahun-ajar', [TahunAjarController::class, 'get']);
    Route::post('/tahun-ajar', [TahunAjarController::class, 'create']);
    Route::put('/tahun-ajar', [TahunAjarController::class, 'update']);
    Route::put('/tahun-ajar/pulihkan', [TahunAjarController::class, 'restore']);
    Route::delete('/tahun-ajar', [TahunAjarController::class, 'delete']);
    // END DATA TAHUN AJAR

    // START DATA REKENING
    Route::get('/rekening', [RekeningController::class, 'get']);
    Route::get('/rekening/siswa-belum-terdaftar', [RekeningController::class, 'getSiswaBelumTerdaftar']);
    Route::post('/rekening', [RekeningController::class, 'create']);
    // END DATA REKENING

    // START BUKU TABUNGAN
    Route::get('/buku-tabungan', [BukuTabunganController::class, 'get']);
    // END BUKU TABUNGAN
    
    // START BUKU TABUNGAN
    Route::get('/transaksi-tabungan', [TransaksiTabunganController::class, 'get']);
    Route::post('/transaksi-tabungan', [TransaksiTabunganController::class, 'create']);
    // END BUKU TABUNGAN

    // EXPORT IMPORT DATA SISWA
    Route::post('/import/siswa', [ImportController::class, 'importSiswa'])->name('import.siswa');

});