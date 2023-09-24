<?php

namespace App\Http\Controllers\Tabungan;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tabungan\RekeningReadRequest;
use App\Http\Resources\Tabungan\RekeningResource;
use App\Models\Tabungan\RekeningModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RekeningController extends Controller
{
    public function get(RekeningReadRequest $request): JsonResponse
    {
        $query = RekeningModel::select(
            'tb_rekening.nomor_rekening',
            'tb_siswa.nis',
            'tb_siswa.nama_siswa',
            'tb_rekening.saldo',
            'master_data_siswa.status_data'
            )->join('master_data_siswa', 'tb_rekening.nis', '=', 'master_data_siswa.nis')
            ->join('tb_siswa', 'tb_rekening.nis', '=', 'tb_siswa.nis');

        if ($request->has('id_kelas') && $request->has('id_tahun_ajar')) {
            $query = $query->where('master_data_siswa.id_kelas', $request->id_kelas)
                        ->where('master_data_siswa.id_tahun_ajar', $request->id_tahun_ajar)
                        ->distinct();
        }

        $totalRecords = RekeningModel::count();

        if ($request->has('start') && $request->has('length')) {
            $query = $query->offset($request->start)
                ->limit($request->length);
        }

        // Penyortiran (Ordering) berdasarkan kolom yang dipilih
        if ($request->has('order') && count($request->order) > 0) {
            $orderByColumn = $request->order[0]['column'];
            $orderByDir = $request->order[0]['dir'];

            $columns = [
                'nomor_rekening',
                'nis',
                'nama_siswa',
                'saldo'
            ];

            if (isset($columns[$orderByColumn])) {
                $orderBy = $columns[$orderByColumn];
                $query = $query->orderBy($orderBy, $orderByDir);
            }
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
            'data' => RekeningResource::collection($data),
        ];
        
        return response()->json($response)->setStatusCode(200);
    }
}
