<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SiswaImport;

class ImportController extends Controller
{
    //
    public function importSiswa(Request $request)
    {
        $file = $request->file('excel_file'); // Ambil file Excel dari form input

        // Proses impor file Excel dengan menggunakan kelas SiswaImport
        Excel::import(new SiswaImport, $file);

        return redirect()->back()->with('success', 'Data Siswa berhasil diimpor.'); // Redirect ke halaman sebelumnya dengan pesan sukses
    }
}
