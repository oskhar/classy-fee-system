<?php

namespace App\Http\Controllers;

use App\Http\Requests\JurusanReadRequest;
use App\Http\Resources\KelasResource;
use App\Models\JurusanModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    // mendapatkan seluruh data
    public function get (): JsonResponse
    {
        $data = JurusanModel::all();
        return KelasResource::collection($data)->response()->setStatusCode(200);
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

        // Pencarian berdasarkan nama_kelas
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
            'data' => KelasResource::collection($data),
        ];
        
        return response()->json($response)->setStatusCode(200);
    }
    public function getUntukInputOption (): JsonResponse
    {
        $data = JurusanModel::select("id_jurusan", "nama_jurusan")->get();
        return KelasResource::collection($data)->response()->setStatusCode(200);
    }
}
