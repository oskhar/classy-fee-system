<?php

use App\Http\Controllers\SiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\TahunAjarController;

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

// START DATA SISWA
Route::get('/siswa', [SiswaController::class, 'get']);
Route::post('/siswa', [SiswaController::class, 'create']);
Route::put('/siswa', [SiswaController::class, 'update']);
Route::put('/siswa/pulihkan', [SiswaController::class, 'restore']);
Route::delete('/siswa', [SiswaController::class, 'delete']);
// END DATA SISWA

// START DATA KELAS
Route::get('/kelas', [KelasController::class, 'get']);
Route::post('/kelas', [KelasController::class, 'create']);
Route::put('/kelas', [KelasController::class, 'update']);
Route::put('/kelas/pulihkan', [KelasController::class, 'restore']);
Route::delete('/kelas', [KelasController::class, 'delete']);
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