<?php

namespace App\Http\Controllers;

use App\Http\Resources\MasterDataSiswaResource;
use App\Models\MasterDataSiswaModel;
use App\Models\SiswaModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MasterDataSiswaController extends Controller
{
    //
    public function getDataSiswaPerkelas(Request $request): JsonResponse
    {
        /**
         * Query utama yang ditetapkan untuk melakukan
         * pengambilan data sesuai parameter tujuan
         */
        $query = MasterDataSiswaModel::select(
            'master_data_siswa.nis',
            'master_data_siswa.id_kelas',
            'master_data_siswa.id_tahun_ajar'
        )->join('tb_siswa', 'master_data_siswa.nis', '=', 'tb_siswa.nis')
        ->join('tb_kelas', 'master_data_siswa.id_kelas', '=', 'tb_siswa.id_kelas')
        ->join('tb_tahun_ajar', 'master_data_siswa.id_tahun_ajar', '=', 'tb_siswa.id_tahun_ajar');

        $data = $query->get();
        
        $response = [
            // 'draw' => intval($request->input('draw')),
            // 'recordsTotal' => $totalRecords,
            // 'recordsFiltered' => $filteredRecords,
            'data' => MasterDataSiswaResource::collection($data),
        ];
        
        return response()->json($response)->setStatusCode(200);
    }
}
