<?php

namespace App\Http\Controllers;

use App\Http\Requests\KelasCreateRequest;
use App\Http\Requests\KelasDeleteRequest;
use App\Http\Requests\KelasFindRequest;
use App\Http\Requests\KelasReadRequest;
use App\Http\Requests\KelasUpdateRequest;
use App\Http\Resources\KelasResource;
use App\Models\KelasModel;
use Illuminate\Http\Exceptions\HttpResponseException;
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
    public function getUntukTabel(KelasReadRequest $request): JsonResponse
    {
        $query = KelasModel::select(
            'tb_kelas.id_kelas',
            'tb_kelas.nama_kelas',
            'tb_kelas.status_data',
            'tb_jurusan.nama_jurusan'
            )->join('tb_jurusan', 'tb_kelas.id_jurusan', '=', 'tb_jurusan.id_jurusan');

        $totalRecords = KelasModel::count();

        if ($request->has('start') && $request->has('length')) {
            $query = $query->offset($request->start)
                ->limit($request->length);
        }

        // Pencarian berdasarkan nama_kelas
        if ($request->has('search') && !empty($request->search['value'])) {
            $searchValue = $request->search['value'];
            $query = $query->where('tb_kelas.nama_kelas', 'LIKE', '%' . $searchValue . '%');
            $filteredRecords = $query->count();
        } else {
            $filteredRecords = $totalRecords; // Jumlah total keseluruhan data
        }

        $data = $query->get();
        
        $response = [
            'draw' => intval($request->input('draw')), // Pastikan draw disertakan
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => KelasResource::collection($data),
        ];
        
        return response()->json($response)->setStatusCode(200);
    }
    public function create (KelasCreateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $banyakData = KelasModel::withTrashed()->count();
        $data['id_kelas'] = "K-".str_pad(($banyakData+1), 3, '0', STR_PAD_LEFT);
        $kelas = new KelasModel($data);
        $kelas->save();
        return (new KelasResource(['nama_kelas' => $kelas->nama_kelas]))->response()->setStatusCode(201);
    }
    public function update (KelasUpdateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $kelas = KelasModel::where('id_kelas', $data['id_kelas'])->first();
        $kelas->fill($data);
        $kelas->save();
        return (new KelasResource(['nama_kelas' => $kelas->nama_kelas]))->response()->setStatusCode(201);
    }
    public function delete(KelasDeleteRequest $request): JsonResponse
    {
        $data = $request->validated();

        $kelas = KelasModel::where('id_kelas', $data['id_kelas'])->first();
        $kelas->fill(['status_data' => 'Tidak Aktif']);
        
        if (!$kelas) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => [
                        'Kelas not found'
                    ]
                ]
            ])->setStatusCode(404));
        }
    
        $kelas->delete(); // Perform soft delete
        
        return (new KelasResource(['nama_kelas' => $kelas->nama_kelas]))->response()->setStatusCode(200);
    }
    public function find(KelasFindRequest $request): JsonResponse
    {
        $data = $request->validated();
        $kelas = KelasModel::select(
            'id_kelas',
            'nama_kelas',
            'status_data',
            'id_jurusan')
            ->where('id_kelas', $data['id_kelas'])
            ->first();
        
        return (new KelasResource($kelas))->response()->setStatusCode(200);
    }

}
