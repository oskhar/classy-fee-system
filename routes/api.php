<?php

use App\Http\Controllers\JurusanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;

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

Route::get('/kelas', [KelasController::class, 'get']);
Route::post('/kelas', [KelasController::class, 'create']);
Route::get('/kelas/untuk-tabel', [KelasController::class, 'getUntukTabel']);

Route::get('/jurusan', [JurusanController::class, 'get']);
Route::get('/jurusan/untuk-input-option', [JurusanController::class, 'getUntukInputOption']);
