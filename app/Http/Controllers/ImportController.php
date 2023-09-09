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

        if (!$file) {
            return response()->json([
                'error' => 'File tidak ditemukan.'
            ])->setStatusCode(400);
        }

        try {
            Excel::import(new SiswaImport, $file);
            
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
