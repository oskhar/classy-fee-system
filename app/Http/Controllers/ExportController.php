<?php

namespace App\Http\Controllers;

use App\Exports\SiswaPerkelasExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SiswaExport;

class ExportController extends Controller
{
    public function exportSiswaExcel()
    {
        return Excel::download(new SiswaExport, 'data_siswa.xlsx');
    }
    public function exportSiswaPerkelasExcel(Request $request)
    {
        return Excel::download(new SiswaPerkelasExport($request->id_kelas, $request->id_tahun_ajar, $request->nama_kelas), 'data_siswa_'.$request->nama_kelas.'.xlsx');
    }
}
