<?php

namespace App\Http\Controllers;

use App\Http\Requests\TahunAjarCreateRequest;
use App\Http\Requests\TahunAjarFindRequest;
use App\Http\Requests\TahunAjarReadRequest;
use App\Http\Resources\TahunAjarResource;
use App\Models\TahunAjarModel;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class TahunAjarController extends Controller
{
    public function getUntukTabel(TahunAjarReadRequest $request): JsonResponse
    {
        $query = TahunAjarModel::select(
            'id_tahun_ajar',
            'nama_tahun_ajar',
            'semester',
            'status_data');

        $totalRecords = TahunAjarModel::count();

        if ($request->has('start') && $request->has('length')) {
            $query = $query->offset($request->start)
                ->limit($request->length);
        }

        // Penyortiran (Ordering) berdasarkan kolom yang dipilih
        if ($request->has('order') && count($request->order) > 0) {
            $orderByColumn = $request->order[0]['column'];
            $orderByDir = $request->order[0]['dir'];

            $columns = [
                'id_tahun_ajar',
                'nama_tahun_ajar',
                'semester'
            ];

            if (isset($columns[$orderByColumn])) {
                $orderBy = $columns[$orderByColumn];
                $query = $query->orderBy($orderBy, $orderByDir);
            }
        }

        // Pencarian berdasarkan nama_tahun_ajar
        if ($request->has('search') && !empty($request->search['value'])) {
            $searchValue = $request->search['value'];
            $query = $query->where('nama_tahun_ajar', 'LIKE', '%' . $searchValue . '%');
            $filteredRecords = $query->count();
        } else {
            $filteredRecords = $totalRecords; // Jumlah total keseluruhan data
        }

        $data = $query->get();
        
        $response = [
            'draw' => intval($request->input('draw')), // Pastikan draw disertakan
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => TahunAjarResource::collection($data),
        ];
        
        return response()->json($response)->setStatusCode(200);
    }

    public function create(TahunAjarCreateRequest $request): JsonResponse
    {
        // Validasi data
        $data = $request->validated();

        // Check apakah data tahun ajar sudah digunakan
        $existingTahunAjar = TahunAjarModel::where('nama_tahun_ajar', $data['nama_tahun_ajar'])
            ->first();
        if ($existingTahunAjar) {
            return response()->json([
                'errors' => [
                    'message' => [
                        'Nama tahun ajar sudah pernah digunakan!'
                    ]
                ]
            ], 409);
        }

        // Check apakah data tahun ajar sudah ada di sampah
        $deletedTahunAjar = TahunAjarModel::onlyTrashed()->where('nama_tahun_ajar', $data['nama_tahun_ajar'])
            ->first();

        if ($deletedTahunAjar) {
            return (new TahunAjarResource([
                'errors' => 'Data dengan nama tahun ajar serupa sudah ada di tempat sampah! Pulihkan?',
                'id_tahun_ajar' => $deletedTahunAjar->id_tahun_ajar,
            ]))->response()->setStatusCode(201);
        }

        // Membuat id secara otomatis
        $banyakData = TahunAjarModel::withTrashed()->count();
        $data['id_tahun_ajar'] = "K-" . str_pad(($banyakData + 1), 3, '0', STR_PAD_LEFT);

        // Insert data ke tabel
        $tahunAjar = new TahunAjarModel($data);
        $tahunAjar->save();

        // Jika status data tidak aktif, set deleted_at agar tidak null (soft delete)
        if ($tahunAjar->status_data == "Tidak Aktif") {
            (TahunAjarModel::find($data['id_tahun_ajar']))
                ->delete();
        }

        // Kembalikan dengan respon
        return (new TahunAjarResource(['nama_tahun_ajar' => $tahunAjar->nama_tahun_ajar]))->response()->setStatusCode(201);
    }

    public function delete(TahunAjarFindRequest $request): JsonResponse
    {
        $data = $request->validated();

        $kelas = TahunAjarModel::where('id_tahun_ajar', $data['id_tahun_ajar'])->first();
        $kelas->update(['status_data' => 'Tidak Aktif']);
        
        if (!$kelas) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => [
                        'Kelas not found'
                    ]
                ]
            ])->setStatusCode(404));
        }
    
        $kelas->delete(); // Perform soft delete
        
        return (new TahunAjarResource(['nama_tahun_ajar' => $kelas->nama_tahun_ajar]))->response()->setStatusCode(200);
    }

    public function restore(TahunAjarFindRequest $request): JsonResponse
    {
        $data = $request->validated();
        $kelas = TahunAjarModel::onlyTrashed()->find($data['id_tahun_ajar']); // Ambil data yang sudah dihapus
        $kelas->update(['status_data' => 'Aktif']);
        $kelas->restore(); // Memulihkan data
        return (new TahunAjarResource(['nama_tahun_ajar' => $kelas->nama_tahun_ajar]))->response()->setStatusCode(200);
    }
}
