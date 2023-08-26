<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('dashboard');

// Router untuk halaman data siswa
Route::get('/admin/data-siswa', function () {
    return view('admin.data_siswa');
})->name('admin.data_siswa');
Route::get('/admin/data-siswa-create', function () {
    return view('admin.data_siswa_create');
})->name('admin.data_siswa_create');
Route::get('/admin/data-siswa-update', function () {
    return view('admin.data_siswa_update');
})->name('admin.data_siswa_update');

// Router untuk halaman data kelas
Route::get('/admin/data-kelas', function () {
    return view('admin.data_kelas');
})->name('admin.data_kelas');
Route::get('/admin/data-kelas-create', function () {
    return view('admin.data_kelas_create');
})->name('admin.data_kelas_create');
Route::get('/admin/data-kelas-update/{a}', function () {
    return view('admin.data_kelas_update');
})->name('admin.data_kelas_update');