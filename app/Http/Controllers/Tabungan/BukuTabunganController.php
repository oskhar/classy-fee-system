<?php

namespace App\Http\Controllers\Tabungan;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tabungan\BukuTabunganCreateRequest;
use App\Http\Requests\Tabungan\BukuTabunganReadRequest;
use App\Http\Resources\Tabungan\RekeningResource;
use App\Models\Tabungan\BukuTabunganModel;
use App\Models\Tabungan\RekeningModel;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BukuTabunganController extends Controller
{
    protected $currentDate;

    public function __construct()
    {
        $this->currentDate = Carbon::now();
    }
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

    public function create(BukuTabunganCreateRequest $request)
    {
        // Validasi data
        $data = $request->validated();

        /**
         * Membuat data saldo sebelumnya
         */
        $rekening = RekeningModel::where('nomor_rekening', $data['nomor_rekening'])->first();
        $saldoSebelumnya = $rekening->saldo;
        $saldoHasil = $saldoSebelumnya + ($data['debit']-$data['kredit']);
        $rekening->update(['saldo' => $saldoHasil]);


        /**
         * Membuat object data untuk mengisi buku tabungan
         * sebagai tanda setoran awal
         */
        $dataBukuTabungan = [
            "nomor_rekening" => $data['nomor_rekening'],
            "debit" => $data['debit'],
            "kredit" => $data['kredit'],
            "saldo" => $saldoHasil,
            "tanggal" => $this->currentDate->format('Y-m-d'),
        ];

        // Insert data ke tabel
        $bukuTabungan = new BukuTabunganModel($dataBukuTabungan);
        $bukuTabungan->save();

        // Kembalikan dengan respon
        return (new RekeningResource([
            'success' => [
                'message' => "Data tabungan dengan nomor $rekening->nomor_rekening berhasil ditambahkan"
            ]
        ]))->response()->setStatusCode(201);
    }
}
