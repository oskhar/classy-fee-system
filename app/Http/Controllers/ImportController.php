<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SiswaImport;

class ImportController extends Controller
{
    public function importSiswa(Request $request): JsonResponse
    {
        $file = $request->file('excel_file');
        $id_kelas = $request->id_kelas;
        $id_tahun_ajar = $request->id_tahun_ajar;

        if (!$file || !$id_kelas || !$id_tahun_ajar) {
            return response()->json([
                'error' => 'Data tidak lengkap.'
            ])->setStatusCode(400);
        }

        try {
            $siswaImport = new SiswaImport($id_kelas, $id_tahun_ajar);
            Excel::import($siswaImport, $file);
            
            return response()->json([
                'success' => [
                    "message" => "Data berhasil diimport"
                ]
            ])->setStatusCode(200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Terjadi kesalahan saat mengimpor data.'
            ])->setStatusCode(500);
        }
    }
}
