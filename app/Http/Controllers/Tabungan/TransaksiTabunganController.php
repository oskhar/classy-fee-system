<?php

namespace App\Http\Controllers\Tabungan;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tabungan\TransaksiTabunganCreateRequest;
use App\Http\Requests\Tabungan\TransaksiTabunganReadRequest;
use App\Http\Resources\Tabungan\TransaksiTabunganResource;
use App\Models\Tabungan\BukuTabunganModel;
use App\Models\Tabungan\RekeningModel;
use App\Models\Tabungan\TransaksiTabunganModel;
use Carbon\Carbon;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransaksiTabunganController extends Controller
{
    protected $currentDate;

    public function __construct()
    {
        $this->currentDate = Carbon::now();
    }

    public function get(TransaksiTabunganReadRequest $request): JsonResponse
    {
        /**
         * Membuat query awal yang dijadikan pedoman dalam
         * menumpuk query tambahan untuk mengambil data
         */
        $query = TransaksiTabunganModel::select(
            'tb_transaksi_tabungan.id_transaksi_tabungan',
            'tb_transaksi_tabungan.nomor_rekening',
            'tb_transaksi_tabungan.jenis_transaksi',
            'tb_transaksi_tabungan.tanggal_transaksi',
            'tb_transaksi_tabungan.nominal',
            'tb_administrator.hak_akses',
            'tb_transaksi_tabungan.status_data'
            )->join('tb_administrator', 'tb_administrator.id_administrator', '=', 'tb_transaksi_tabungan.id_administrator');

        $totalRecords = TransaksiTabunganModel::count();

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
                'jenis_transaksi',
                'tanggal_transaksi',
                'nominal',
                'hak_akses',
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
            'data' => TransaksiTabunganResource::collection($data),
        ];
        
        return response()->json($response)->setStatusCode(200);
    }

    public function create(TransaksiTabunganCreateRequest $request)
    {
        // Validasi data
        $data = $request->validated();

        /**
         * Membuat data saldo sebelumnya
         */
        $rekening = RekeningModel::where('nomor_rekening', $data['nomor_rekening'])->first();

        $saldoSebelumnya = $rekening->saldo;
        $saldoHasil = $data['jenis_transaksi'] == "debit" ? $saldoSebelumnya + $data['nominal'] : $saldoSebelumnya - $data['nominal'];

        if ($saldoHasil < 0) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => [
                        'Pengurangan saldo melebihi saldo saat ini!'
                    ]
                ]
            ])->setStatusCode(400));
        }

        $rekening->update(['saldo' => $saldoHasil]);


        /**
         * Membuat object data untuk mengisi buku tabungan
         * sebagai tanda setoran awal
         */
        $dataBukuTabungan = [
            "nomor_rekening" => $data['nomor_rekening'],
            "saldo" => $saldoHasil,
            $data['jenis_transaksi'] => $data['nominal'],
            "tanggal" => $this->currentDate->format('Y-m-d'),
        ];

        // Insert data ke tabel
        $bukuTabungan = new BukuTabunganModel($dataBukuTabungan);
        $bukuTabungan->save();

        /**
         * Membuat object data untuk mengisi buku tabungan
         * sebagai tanda setoran awal
         */
        $banyakDataTransaksi = TransaksiTabunganModel::withTrashed()->where("tanggal_transaksi", $this->currentDate->format('Y-m-d'))->count();
        $generateIdAdministrator = "P-";
        $generateIdAdministrator .= $data['jenis_transaksi'] == "debit" ? "01-":"02-";
        $generateIdAdministrator .= substr($this->currentDate->format('Y-m-d'), -2)."-";
        $generateIdAdministrator .= str_pad($banyakDataTransaksi, 4, '0', STR_PAD_LEFT);
        $dataRekeningTabungan = [
            "id_transaksi_tabungan" => $generateIdAdministrator,
            "id_administrator" => $data['id_administrator'],
            "nomor_rekening" => $data['nomor_rekening'],
            "jenis_transaksi" => $data['jenis_transaksi'],
            "tanggal_transaksi" => $this->currentDate->format('Y-m-d'),
            "nominal" => $data['nominal'],
        ];

        // Insert data ke tabel
        $transaksiTabungan = new TransaksiTabunganModel($dataRekeningTabungan);
        $transaksiTabungan->save();

        // Kembalikan dengan respon
        return (new TransaksiTabunganResource([
            'success' => [
                'message' => "Data tabungan dengan nomor $rekening->nomor_rekening berhasil ditambahkan"
            ]
        ]))->response()->setStatusCode(201);
    }

}
