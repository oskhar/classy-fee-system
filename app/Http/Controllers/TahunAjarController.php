<?php

namespace App\Http\Controllers;

use App\Http\Requests\TahunAjarCreateRequest;
use App\Http\Requests\TahunAjarReadRequest;
use App\Http\Requests\TahunAjarUpdateRequest;
use App\Http\Resources\TahunAjarResource;
use App\Models\TahunAjarModel;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class TahunAjarController extends Controller
{
    public function get(TahunAjarReadRequest $request): JsonResponse
    {
        $query = TahunAjarModel::select(
            'id_tahun_ajar',
            'nama_tahun_ajar',
            'semester',
            'status_data');

        $totalRecords = TahunAjarModel::count();
    
        if ($request->has('id_tahun_ajar')) {
            $tahunAjar = $query->find($request->id_tahun_ajar);
            return (new TahunAjarResource($tahunAjar))->response()->setStatusCode(200);
        }

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
            ->where('semester', $data['semester'])
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
            ->where('semester', $data['semester'])
            ->first();

        if ($deletedTahunAjar) {
            return (new TahunAjarResource([
                'errors' => [
                    'message' => [
                        'Data dengan nama jurusan serupa sudah ada di tempat sampah! Pulihkan?'
                    ]
                ],
                'id_tahun_ajar' => $deletedTahunAjar->id_tahun_ajar,
            ]))->response()->setStatusCode(201);
        }

        // Membuat id secara otomatis
        $banyakData = TahunAjarModel::withTrashed()->count();
        $data['id_tahun_ajar'] = "TA-" . str_pad(($banyakData + 1), 3, '0', STR_PAD_LEFT);

        // Insert data ke tabel
        $tahunAjar = new TahunAjarModel($data);
        $tahunAjar->save();

        // Jika status data tidak aktif, set deleted_at agar tidak null (soft delete)
        if ($tahunAjar->status_data == "Tidak Aktif") {
            (TahunAjarModel::find($data['id_tahun_ajar']))
                ->delete();
        }

        // Kembalikan dengan respon
        return (new TahunAjarResource([
            'success' => [
                'message' => "Tahun ajar $tahunAjar->nama_tahun_ajar berhasil ditambahkan"
            ]
        ]))->response()->setStatusCode(201);
    }

    public function update (TahunAjarUpdateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $tahunAjar = TahunAjarModel::where('id_tahun_ajar', $data['id_tahun_ajar'])->first();

        // Memeriksa apakah nama kelas sudah pernah digunakan
        $existingTahunAjar = TahunAjarModel::withTrashed()
            ->where('nama_tahun_ajar', $data['nama_tahun_ajar'])
            ->exists();

        // Jika sudah, kembalikan respons error
        if ($existingTahunAjar && $tahunAjar['nama_tahun_ajar'] != $data['nama_tahun_ajar']) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => [
                        'Nama kelas sudah digunakan'
                    ]
                ]
            ])->setStatusCode(400));
        }

        $tahunAjar->update($data);

        // Jika status data tidak aktif, set deleted_at agar tidak null (soft delete)
        if ($tahunAjar->status_data == "Tidak Aktif") {
            (TahunAjarModel::find($data['id_tahun_ajar']))
                ->delete();
        }
        
        return (new TahunAjarResource([
            'success' => [
                'message' => "Tahun ajar $tahunAjar->nama_tahun_ajar berhasil diubah"
            ]
        ]))->response()->setStatusCode(201);
    }

    public function delete(TahunAjarReadRequest $request): JsonResponse
    {
        $data = $request->validated();

        $tahunAjar = TahunAjarModel::where('id_tahun_ajar', $data['id_tahun_ajar'])->first();
        
        if (!$tahunAjar) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => [
                        'Kelas not found'
                    ]
                ]
            ])->setStatusCode(404));
        }
    
        $tahunAjar->update(['status_data' => 'Tidak Aktif']);
        $tahunAjar->delete(); // Perform soft delete
        
        return (new TahunAjarResource([
            'success' => [
                'message' => "Tahun ajar $tahunAjar->nama_tahun_ajar berhasil dihapus"
            ]
        ]))->response()->setStatusCode(200);
    }

    public function restore(TahunAjarReadRequest $request): JsonResponse
    {
        $data = $request->validated();
        $tahunAjar = TahunAjarModel::onlyTrashed()->find($data['id_tahun_ajar']); // Ambil data yang sudah dihapus
        
        if (!$tahunAjar) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => [
                        'Kelas not found'
                    ]
                ]
            ])->setStatusCode(404));
        }
        
        $tahunAjar->update(['status_data' => 'Aktif']);
        $tahunAjar->restore(); // Memulihkan data
        return (new TahunAjarResource([
            'success' => [
                'message' => "Tahun ajar $tahunAjar->nama_tahun_ajar berhasil dipulihkan"
            ]
        ]))->response()->setStatusCode(200);
    }
}
