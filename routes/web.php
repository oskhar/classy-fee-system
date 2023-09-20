<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportController;
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
    return view('auth.login');
})->name('login');

Route::group(['prefix' => 'siswa'], function ($router) {
    /**
     * Route untuk halaman dashboard
     * 
     */
    Route::get('/', function () {
        return view('siswa.home');
    })->name('siswa.home');

    /**
     * Router untuk halaman data siswa
     * 
     */
    Route::get('/pembayaran-spp', function () {
        return view('siswa.pembayaran_spp.read');
    })->name('siswa.pembayaran_spp');

    /**
     * Router untuk halaman data siswa
     * 
     */
    Route::get('/e-raport', function () {
        return view('siswa.e-raport.read');
    })->name('siswa.e-raport');
});

Route::group(['prefix' => 'admin'], function ($router) {
    /**
     * Route untuk halaman dashboard
     * 
     */
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::get('/home-keuangan-sekolah', function () {
        return view('admin.home_keuangan_sekolah');
    })->name('admin.home_keuangan_sekolah');

    /**
     * Router untuk halaman data siswa
     * 
     */
    Route::get('/data-siswa', function () {
        return view('admin.data_siswa.read');
    })->name('admin.data_siswa');
    Route::get('/data-siswa-create', function () {
        return view('admin.data_siswa.create');
    })->name('admin.data_siswa_create');
    Route::get('/data-siswa-update/{id}', function () {
        return view('admin.data_siswa.update');
    })->name('admin.data_siswa_update');
    Route::get('/data-siswa-import/', function () {
        return view('admin.data_siswa.import');
    })->name('admin.data_siswa_import');
    Route::get('/data-siswa-detail/{id}', function () {
        return view('admin.data_siswa.detail');
    })->name('admin.data_siswa_detail');

    /**
     * Router untuk halaman data jurusan
     * 
     */
    Route::get('/data-jurusan', function () {
        return view('admin.data_jurusan.read');
    })->name('admin.data_jurusan');
    Route::get('/data-jurusan-create', function () {
        return view('admin.data_jurusan.create');
    })->name('admin.data_jurusan_create');
    Route::get('/data-jurusan-update/{id}', function () {
        return view('admin.data_jurusan.update');
    })->name('admin.data_jurusan_update');

    /**
     * Router untuk halaman data kelas
     * 
     */
    Route::get('/data-kelas', function () {
        return view('admin.data_kelas.read');
    })->name('admin.data_kelas');
    Route::get('/data-kelas-create', function () {
        return view('admin.data_kelas.create');
    })->name('admin.data_kelas_create');
    Route::get('/data-kelas-update/{id}', function () {
        return view('admin.data_kelas.update');
    })->name('admin.data_kelas_update');

    /**
     * Router untuk halaman data tahun ajar
     * 
     */
    Route::get('/data-tahun-ajar', function () {
        return view('admin.data_tahun_ajar.read');
    })->name('admin.data_tahun_ajar');
    Route::get('/data-tahun-ajar-create', function () {
        return view('admin.data_tahun_ajar.create');
    })->name('admin.data_tahun_ajar_create');
    Route::get('/data-tahun-ajar-update/{id}', function () {
        return view('admin.data_tahun_ajar.update');
    })->name('admin.data_tahun_ajar_update');

    /**
     * Router untuk halaman data pembayaran spp
     * 
     */
    Route::get('/data-pembayaran-spp', function () {
        return view('admin.data_pembayaran_spp.read');
    })->name('admin.data_pembayaran_spp');
    Route::get('/data-pembayaran-spp-create', function () {
        return view('admin.data_pembayaran_spp.create');
    })->name('admin.data_pembayaran_spp_create');

    /**
     * Router untuk halaman cetak laporan
     * 
     */
    Route::get('/cetak-laporan-siswa', function () {
        return view('admin.cetak.laporan_siswa');
    })->name('admin.cetak.laporan_siswa');
});

Route::get('/export/siswa', [ExportController::class, 'exportSiswaExcel'])->name('export.siswa');
