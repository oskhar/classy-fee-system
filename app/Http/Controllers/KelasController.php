<?php

namespace App\Http\Controllers;

use App\Http\Requests\KelasCreateRequest;
use App\Http\Requests\KelasUpdateRequest;
use App\Http\Resources\KelasResource;
use App\Models\KelasModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KelasController extends Controller
{
    // mendapatkan seluruh data
    public function get (): JsonResponse
    {
        $data = KelasModel::all();
        return KelasResource::collection($data)->response()->setStatusCode(200);
    }
    public function getUntukTabel (): JsonResponse
    {
        $data = KelasModel::select('tb_kelas.nama_kelas', 'tb_kelas.status_data', 'tb_kelas.id_kelas', 'tb_jurusan.nama_jurusan')
        ->join('tb_jurusan', 'tb_kelas.id_jurusan', '=', 'tb_jurusan.id_jurusan')
        ->get();
        return KelasResource::collection($data)->response()->setStatusCode(200);
    }
    public function create (KelasCreateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $banyakData = KelasModel::count();
        $data['id_kelas'] = "K-".str_pad(($banyakData+1), 3, '0', STR_PAD_LEFT);
        $kelas = new KelasModel($data);
        $kelas->save();
        return (new KelasResource(['nama_kelas' => $kelas->nama_kelas]))->response()->setStatusCode(201);
    }
    public function update (KelasUpdateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $kelas = KelasModel::find($data['id_kelas']);
        $kelas->fill($data);
        $kelas->save();
        return (new KelasResource(['nama_kelas' => $kelas->nama_kelas]))->response()->setStatusCode(201);
    }
    public function delete (String $id_kelas): JsonResponse
    {
        $kelas = KelasModel::where('id_kelas', $id_kelas)->first();
        $kelas->delete();
        return response()->json([
            'nama_kelas' => $kelas->nama_kelas,
        ]);
    }

}
