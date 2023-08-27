<?php

namespace App\Http\Controllers;

use App\Http\Requests\JurusanDeleteRequest;
use App\Http\Requests\JurusanReadRequest;
use App\Http\Resources\JurusanResource;
use App\Models\JurusanModel;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    // mendapatkan seluruh data
    public function get (): JsonResponse
    {
        $data = JurusanModel::all();
        return JurusanResource::collection($data)->response()->setStatusCode(200);
    }
    public function getUntukTabel(JurusanReadRequest $request): JsonResponse
    {
        $query = JurusanModel::select(
            'id_jurusan',
            'nama_jurusan',
            'singkatan',
            'status_data',);

        $totalRecords = JurusanModel::count();

        if ($request->has('start') && $request->has('length')) {
            $query = $query->offset($request->start)
                ->limit($request->length);
        }

        // Pencarian berdasarkan nama_jurusan
        if ($request->has('search') && !empty($request->search['value'])) {
            $searchValue = $request->search['value'];
            $query = $query->where('nama_jurusan', 'LIKE', '%' . $searchValue . '%');
            $filteredRecords = $query->count();
        } else {
            $filteredRecords = $totalRecords; // Jumlah total keseluruhan data
        }

        $data = $query->get();
        
        $response = [
            'draw' => intval($request->input('draw')), // Pastikan draw disertakan
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => JurusanResource::collection($data),
        ];
        
        return response()->json($response)->setStatusCode(200);
    }
    public function delete(JurusanDeleteRequest $request): JsonResponse
    {
        $data = $request->validated();

        $jurusan = JurusanModel::where('id_jurusan', $data['id_jurusan'])->first();
        $jurusan->fill(['status_data' => 'Tidak Aktif']);
        
        if (!$jurusan) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => [
                        'jurusan not found'
                    ]
                ]
            ])->setStatusCode(404));
        }
    
        $jurusan->delete(); // Perform soft delete
        
        return (new JurusanResource(['nama_jurusan' => $jurusan->nama_jurusan]))->response()->setStatusCode(200);
    }
    public function getUntukInputOption (): JsonResponse
    {
        $data = JurusanModel::select("id_jurusan", "nama_jurusan")->get();
        return JurusanResource::collection($data)->response()->setStatusCode(200);
    }
}
