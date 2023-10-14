<?php

namespace App\Http\Controllers\Tabungan;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tabungan\RekeningCreateRequest;
use App\Http\Requests\Tabungan\RekeningReadRequest;
use App\Http\Resources\Tabungan\RekeningResource;
use App\Models\MasterDataSiswaModel;
use App\Models\Tabungan\BukuTabunganModel;
use App\Models\Tabungan\RekeningModel;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RekeningController extends Controller
{
    protected $currentDate;

    public function __construct()
    {
        $this->currentDate = Carbon::now();
    }

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

        if ($request->has('id_kelas')) {
            $query = $query
                        ->where('master_data_siswa.id_kelas', 'LIKE', '%'. $request->id_kelas .'%')
                        ->distinct();
        }

        if ($request->has('id_tahun_ajar')) {
            $query = $query
                        ->where('master_data_siswa.id_tahun_ajar', 'LIKE', '%'. $request->id_tahun_ajar .'%')
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

    public function getSiswaBelumTerdaftar (): JsonResponse
    {
        /**
         * Membuat query dasar sebagai acuan utama
         * dalam mengambil data tabungan siswa
         */
        $query = MasterDataSiswaModel::select(
            'tb_siswa.nis',
            'tb_siswa.nama_siswa'
        )->join('tb_siswa', 'tb_siswa.nis', '=', 'master_data_siswa.nis')
        ->leftJoin('tb_rekening', 'tb_siswa.nis', '=', 'tb_rekening.nis')
        ->whereNull('tb_rekening.nis');

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
        $deletedJurusan = RekeningModel::onlyTrashed()->where('nis', $data['nis'])->first();
        if ($deletedJurusan) {
            return (new RekeningResource([
                'errors' => [
                    'message' => [
                        'Data dengan nama jurusan serupa sudah ada di tempat sampah! Pulihkan?'
                    ]
                ],
                'nis' => $deletedJurusan->nis,
            ]))->response()->setStatusCode(200);
        }

        // Membuat id secara otomatis
        $banyakData = RekeningModel::withTrashed()->count();
        $data['nomor_rekening'] = "NR-" . str_pad(($banyakData + 1), 9, '0', STR_PAD_LEFT);
        $data['tanggal_buka'] = $this->currentDate->format('Y-m-d');
        $data['saldo'] = $data['setoran_awal'];

        // Insert data ke tabel
        $jurusan = new RekeningModel($data);
        $jurusan->save();

        /**
         * Membuat object data untuk mengisi buku tabungan
         * sebagai tanda setoran awal
         */
        $dataBukuTabungan = [
            "id_buku_tabungan",
            "nomor_rekening" => $data['nomor_rekening'],
            "debit" => $data['setoran_awal'],
            "kredit" => 0,
            "saldo" => $data['setoran_awal'],
            "tanggal" => $this->currentDate->format('Y-m-d'),
        ];

        // Insert data ke tabel
        $jurusan = new BukuTabunganModel($dataBukuTabungan);
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
