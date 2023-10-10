<?php

namespace App\Http\Controllers;

use App\Exports\BukuTabunganExport;
use App\Exports\SiswaPerkelasExport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SiswaExport;

class ExportController extends Controller
{
    protected $currentTime;

    public function __construct ()
    {
        /**
         * Mendapatkan tanggal sekarang dengan
         * waktu dan zona waktu yang aktif
         */
        $now = Carbon::now();

        /**
         * Mendapatkan tanggal sekarang dalam format
         * tertentu (contoh: Y-m-d H-i-s)
         */
        $this->currentTime = $now->format('Y-m-d_H-i-s');
    }
    public function exportSiswaExcel()
    {
        /**
         * Mengatur nama file excel
         * yang akan diexport
         */
        $namaFileExcel = 'data_siswa'. $this->currentTime .'.xlsx';
        return Excel::download(new SiswaExport, $namaFileExcel);
    }
    public function exportSiswaPerkelasExcel(Request $request)
    {
        /**
         * Mengatur nama file excel
         * yang akan diexport
         */
        $namaFileExcel = 'data_siswa_'.$request->nama_kelas .'_'. $this->currentTime .'.xlsx';

        /**
         * Mengatur data request yang dibutuhkan dalam
         * mengatur data yang akan di-Export ke excel
         */
        $requestDataExcel = [
            "idKelas" => $request->id_kelas == 'undefined' ? null : $request->id_kelas,
            "idTahunAjar" => $request->id_tahun_ajar == 'undefined' ? null : $request->id_tahun_ajar,
            "namaKelas" => $request->nama_kelas == 'undefined' ? null : $request->nama_kela
        ];

        /**
         * Mengembalikan data response
         * berupa file exccel
         */
        return Excel::download(new SiswaPerkelasExport($requestDataExcel), $namaFileExcel);
    }
    public function exportBukuTabungan(Request $request)
    {
        /**
         * Mengatur nama file excel
         * yang akan diexport
         */
        $namaFileExcel = 'buku_tabungan_'.$request->nomor_rekening .'_'. $this->currentTime .'.xlsx';

        /**
         * Mengatur data request yang dibutuhkan dalam
         * mengatur data yang akan di-Export ke excel
         */
        $requestDataExcel = [
            "nomor_rekening" => $request->nomor_rekening
        ];

        /**
         * Mengembalikan data response
         * berupa file exccel
         */
        return Excel::download(new BukuTabunganExport($requestDataExcel), $namaFileExcel);
    }
}
