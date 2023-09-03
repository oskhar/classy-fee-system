<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ImportController;
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
    return view('login');
})->name('login');

// Route untuk halaman dashboard
Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('dashboard');

// Router untuk halaman data siswa
Route::get('/admin/data-siswa', function () {
    return view('admin.data_siswa.read');
})->name('admin.data_siswa');
Route::get('/admin/data-siswa-create', function () {
    return view('admin.data_siswa.create');
})->name('admin.data_siswa_create');
Route::get('/admin/data-siswa-update/{id}', function () {
    return view('admin.data_siswa.update');
})->name('admin.data_siswa_update');
Route::get('/admin/data-siswa-import/', function () {
    return view('admin.data_siswa.import');
})->name('admin.data_siswa_import');

// Router untuk halaman data jurusan
Route::get('/admin/data-jurusan', function () {
    return view('admin.data_jurusan.read');
})->name('admin.data_jurusan');
Route::get('/admin/data-jurusan-create', function () {
    return view('admin.data_jurusan.create');
})->name('admin.data_jurusan_create');
Route::get('/admin/data-jurusan-update/{id}', function () {
    return view('admin.data_jurusan.update');
})->name('admin.data_jurusan_update');

// Router untuk halaman data kelas
Route::get('/admin/data-kelas', function () {
    return view('admin.data_kelas.read');
})->name('admin.data_kelas');
Route::get('/admin/data-kelas-create', function () {
    return view('admin.data_kelas.create');
})->name('admin.data_kelas_create');
Route::get('/admin/data-kelas-update/{id}', function () {
    return view('admin.data_kelas.update');
})->name('admin.data_kelas_update');

// Router untuk halaman data tahun ajar
Route::get('/admin/data-tahun-ajar', function () {
    return view('admin.data_tahun_ajar.read');
})->name('admin.data_tahun_ajar');
Route::get('/admin/data-tahun-ajar-create', function () {
    return view('admin.data_tahun_ajar.create');
})->name('admin.data_tahun_ajar_create');
Route::get('/admin/data-tahun-ajar-update/{id}', function () {
    return view('admin.data_tahun_ajar.update');
})->name('admin.data_tahun_ajar_update');

// Router untuk export excel
Route::get('/export/siswa', [ExportController::class, 'exportSiswaExcel'])->name('export.siswa');

Route::post('/import/siswa', [ImportController::class, 'importSiswa'])->name('import.siswa');
