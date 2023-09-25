<?php

namespace App\Http\Controllers\Tabungan;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tabungan\BukuTabunganReadRequest;
use App\Http\Resources\Tabungan\RekeningResource;
use App\Models\Tabungan\BukuTabunganModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BukuTabunganController extends Controller
{
    public function get(BukuTabunganReadRequest $request): JsonResponse
    {
        /**
         * Menetapkan query utama sebagai wadah
         * mengelola query untuk mendapatkan
         * data yang dibutuhkan client
         */
        $query = BukuTabunganModel::select(
            'id_buku_tabungan',
            'nomor_rekening',
            'debit',
            'kredit',
            'saldo',
            'tanggal',
            'status_data'
            );

        /**
         * Mengambil seluruh data yang sesuai dengan data
         * berdasarkan nomor rekening yang dipilih
         */
        if ($request->has('nomor_rekening')) {
            $data = $query->where('nomor_rekening', $request->nomor_rekening)
                        ->get();

            /**
             * Mengembalikan respon berupa array dari
             * data tabungan siswa yang dipilih
             */
            return response()->json(['data' => $data])->setStatusCode(200);
        }

        if ($request->has('id_kelas') && $request->has('id_tahun_ajar')) {
            $query = $query->where('master_data_siswa.id_kelas', $request->id_kelas)
                        ->where('master_data_siswa.id_tahun_ajar', $request->id_tahun_ajar)
                        ->distinct();
        }

        $totalRecords = BukuTabunganModel::count();

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
