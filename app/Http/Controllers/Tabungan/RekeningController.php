<?php

namespace App\Http\Controllers\Tabungan;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tabungan\RekeningCreateRequest;
use App\Http\Requests\Tabungan\RekeningReadRequest;
use App\Http\Resources\Tabungan\RekeningResource;
use App\Models\Tabungan\RekeningModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RekeningController extends Controller
{
    public function get(RekeningReadRequest $request): JsonResponse
    {
        /**
         * Membuat query awal yang dijadikan pedoman dalam
         * menumpuk query tambahan untuk mengambil data
         */
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

    public function getSiswaBelumDaftar (): JsonResponse
    {
        /**
         * Membuat query dasar sebagai acuan utama
         * dalam mengambil data tabungan siswa
         */
        $query = RekeningModel::select(
            'tb_siswa.nis',
            'tb_siswa.nama_siswa'
        )->join('tb_siswa', 'tb_siswa.nis', 'NOT LIKE', 'tb_rekening.nis');

        /**
         * Mengambil seluruh data berdasarkan
         * query yang sudah diseleksi
         */
        $data = $query->get();

        /**
         * Mengembalikan response data berupa
         * data berbentuk json
         */
        return (new RekeningResource([
            'data' => $data
        ]))->response()->setStatusCode(200);
    }

    public function create(RekeningCreateRequest $request): JsonResponse
    {
        // Validasi data
        $data = $request->validated();

        // Check apakah data jurusan sudah digunakan
        $existingSiswa = RekeningModel::where('nis', $data['nis'])->first();
        if ($existingSiswa) {
            return response()->json([
                'errors' => [
                    'message' => [
                        'Siswa ini sudah pernah mendaftar sebelumnya! tolong pilih siswa yang lain'
                    ]
                ]
            ], 400);
        }

        // Check apakah data Jurusan sudah ada di sampah
        $deletedJurusan = RekeningModel::onlyTrashed()->where('nama_jurusan', $data['nama_jurusan'])->first();
        if ($deletedJurusan) {
            return (new RekeningResource([
                'errors' => [
                    'message' => [
                        'Data dengan nama jurusan serupa sudah ada di tempat sampah! Pulihkan?'
                    ]
                ],
                'id_jurusan' => $deletedJurusan->id_jurusan,
            ]))->response()->setStatusCode(200);
        }

        // Membuat id secara otomatis
        $banyakData = RekeningModel::withTrashed()->count();
        $data['id_jurusan'] = "J-" . str_pad(($banyakData + 1), 3, '0', STR_PAD_LEFT);

        // Insert data ke tabel
        $jurusan = new RekeningModel($data);
        $jurusan->save();

        // Jika status data tidak aktif, set deleted_at agar tidak null (soft delete)
        if ($jurusan->status_data == "Tidak Aktif") {
            (RekeningModel::find($data['id_jurusan']))
                ->delete();
        }

        // Kembalikan dengan respon
        return (new RekeningResource([
            'success' => [
                'message' => "Jurusan $jurusan->nama_jurusan berhasil ditambahkan"
            ]
        ]))->response()->setStatusCode(201);
    }
}
