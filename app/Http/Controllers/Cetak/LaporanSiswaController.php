<?php

namespace App\Http\Controllers\Cetak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SiswaExport;

class ExportController extends Controller
{
    public function exportSiswaExcel()
    {
        return Excel::download(new SiswaExport, 'data_siswa.xlsx');
    }
}
