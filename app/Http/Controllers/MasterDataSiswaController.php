<?php

namespace App\Http\Controllers;

use App\Http\Requests\MasterDataSiswa\KelasDariTahunAjarRequest;
use App\Http\Requests\MasterDataSiswa\SiswaPekelasRequest;
use App\Http\Resources\MasterDataSiswaResource;
use App\Models\MasterDataSiswaModel;
use App\Models\SiswaModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MasterDataSiswaController extends Controller
{
    //
    public function getSiswaPerkelas(SiswaPekelasRequest $request): JsonResponse
    {
        /**
         * Query utama yang ditetapkan untuk melakukan
         * pengambilan data sesuai parameter tujuan
         */
        $query = MasterDataSiswaModel::select(
            'master_data_siswa.nis',
            'master_data_siswa.nisn',
            'master_data_siswa.id_kelas',
            'master_data_siswa.id_tahun_ajar',
            'tb_siswa.nama_siswa',
            'tb_siswa.status_data',
            'tb_kelas.nama_kelas',
            'tb_tahun_ajar.nama_tahun_ajar',
            'tb_tahun_ajar.semester'
        )->join('tb_siswa', 'master_data_siswa.nis', '=', 'tb_siswa.nis')
        ->join('tb_kelas', 'master_data_siswa.id_kelas', '=', 'tb_kelas.id_kelas')
        ->join('tb_tahun_ajar', 'master_data_siswa.id_tahun_ajar', '=', 'tb_tahun_ajar.id_tahun_ajar');

        if ($request->has('id_kelas') && $request->has('id_tahun_ajar')) {
            $query = $query->where('master_data_siswa.id_kelas', $request->id_kelas)
                        ->where('master_data_siswa.id_tahun_ajar', $request->id_tahun_ajar)
                        ->distinct();
        }

        $totalRecords = MasterDataSiswaModel::count();

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
                'nama_kelas',
                'nama_tahun_ajar',
                'semester'
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
            'data' => MasterDataSiswaResource::collection($data),
        ];

        /**
         * Mengembalikan data berdasarkan
         * resource yang sudah diatur
         */
        return response()->json($response)->setStatusCode(200);
    }

    public function getKelasDariTahunAjar (KelasDariTahunAjarRequest $request): JsonResponse
    {
        /**
         * Query utama yang ditetapkan untuk melakukan
         * pengambilan data sesuai parameter tujuan
         */
        $query = MasterDataSiswaModel::select(
            'tb_kelas.id_kelas',
            'tb_kelas.nama_kelas',
            'tb_tahun_ajar.nama_tahun_ajar'
        )->join('tb_kelas', 'master_data_siswa.id_kelas', '=', 'tb_kelas.id_kelas')
        ->join('tb_tahun_ajar', 'master_data_siswa.id_tahun_ajar', '=', 'tb_tahun_ajar.id_tahun_ajar');

        /**
         * Mengedit query sesuai kebutuhan
         */
        $query = $query
                    ->where('master_data_siswa.id_tahun_ajar', $request['id_tahun_ajar'])
                    ->distinct();

        /**
         * Mendapatkan data yang sudah difilter
         * dengan beberapa query laravel
         */
        $data = $query->get();

        /**
         * Mengembalikan data berdasarkan
         * resource yang sudah diatur
         */
        return (new MasterDataSiswaResource($data))->response()->setStatusCode(200);
    }
}
