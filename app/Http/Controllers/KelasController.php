<?php

namespace App\Http\Controllers;

use App\Http\Resources\KelasResource;
use App\Models\KelasModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    // mendapatkan seluruh data
    public function getDetail (): JsonResponse
    {
        $dataKelas = KelasModel::all();
        return KelasResource::collection($dataKelas)->response()->setStatusCode(200);
    }
    public function getUntukTabel (): JsonResponse
    {
        $dataKelas = KelasModel::select('tb_kelas.nama_kelas', 'tb_kelas.status_data', 'tb_kelas.id_kelas', 'tb_jurusan.nama_jurusan')
        ->join('tb_jurusan', 'tb_kelas.id_jurusan', '=', 'tb_jurusan.id_jurusan')
        ->get();
        return KelasResource::collection($dataKelas)->response()->setStatusCode(200);
    }
    public function create (): JsonResponse
    {
        $dataKelas = KelasModel::select('tb_kelas.nama_kelas', 'tb_kelas.status_data', 'tb_kelas.id_kelas', 'tb_jurusan.nama_jurusan')
        ->join('tb_jurusan', 'tb_kelas.id_jurusan', '=', 'tb_jurusan.id_jurusan')
        ->get();
        return KelasResource::collection($dataKelas)->response()->setStatusCode(200);
    }

}
