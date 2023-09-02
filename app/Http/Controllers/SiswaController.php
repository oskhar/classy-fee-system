<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiswaReadRequest;
use App\Http\Resources\SiswaResource;
use App\Models\SiswaModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function get(SiswaReadRequest $request): JsonResponse
    {
        $query = SiswaModel::select(
            'nis',
            'nisn',
            'nama_siswa',
            'jenis_kelamin',
            'tempat_lahir',
            'tanggal_lahir',
            'status_data',
            );
    
        if ($request->has('id_siswa')) {
            $kelas = $query->find($request->id_siswa);
            return (new SiswaResource($kelas))->response()->setStatusCode(200);
        }

        $totalRecords = SiswaModel::count();

        if ($request->has('start') && $request->has('length')) {
            $query = $query->offset($request->start)
                ->limit($request->length);
        }

        // Penyortiran (Ordering) berdasarkan kolom yang dipilih
        if ($request->has('order') && count($request->order) > 0) {
            $orderByColumn = $request->order[0]['column'];
            $orderByDir = $request->order[0]['dir'];

            $columns = [
                'nis',
                'nisn',
                'nama_siswa',
                'jenis_kelamin',
                'tempat_lahir',
                'tanggal_lahir',
            ];

            if (isset($columns[$orderByColumn])) {
                $orderBy = $columns[$orderByColumn];
                $query = $query->orderBy($orderBy, $orderByDir);
            }
        }

        // Pencarian berdasarkan nama_siswa
        if ($request->has('search') && !empty($request->search['value'])) {
            $searchValue = $request->search['value'];
            $query = $query->where('nama_siswa', 'LIKE', '%' . $searchValue . '%');
            $filteredRecords = $query->count();
        } else {
            $filteredRecords = $totalRecords; // Jumlah total keseluruhan data
        }

        $data = $query->get();
        
        $response = [
            'draw' => intval($request->input('draw')), // Pastikan draw disertakan
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => SiswaResource::collection($data),
        ];
        
        return response()->json($response)->setStatusCode(200);
    }
}
