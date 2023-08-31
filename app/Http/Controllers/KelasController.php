<?php

namespace App\Http\Controllers;

use App\Http\Requests\KelasCreateRequest;
use App\Http\Requests\KelasReadRequest;
use App\Http\Requests\KelasUpdateRequest;
use App\Http\Resources\KelasResource;
use App\Models\KelasModel;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KelasController extends Controller
{
    public function get(KelasReadRequest $request): JsonResponse
    {
        $query = KelasModel::select(
            'tb_kelas.id_kelas',
            'tb_kelas.nama_kelas',
            'tb_kelas.status_data',
            'tb_jurusan.id_jurusan',
            'tb_jurusan.nama_jurusan'
            )->join('tb_jurusan', 'tb_kelas.id_jurusan', '=', 'tb_jurusan.id_jurusan');
    
        if ($request->has('id_kelas')) {
            $kelas = $query->find($request->id_kelas);
            return (new KelasResource($kelas))->response()->setStatusCode(200);
        }

        $totalRecords = KelasModel::count();

        if ($request->has('start') && $request->has('length')) {
            $query = $query->offset($request->start)
                ->limit($request->length);
        }

        // Penyortiran (Ordering) berdasarkan kolom yang dipilih
        if ($request->has('order') && count($request->order) > 0) {
            $orderByColumn = $request->order[0]['column'];
            $orderByDir = $request->order[0]['dir'];

            $columns = [
                'id_kelas',
                'nama_kelas',
                'nama_jurusan'
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
            'data' => KelasResource::collection($data),
        ];
        
        return response()->json($response)->setStatusCode(200);
    }

    public function create(KelasCreateRequest $request): JsonResponse
    {
        // Validasi data
        $data = $request->validated();

        // Check apakah data kelas sudah digunakan
        $existingKelas = KelasModel::where('nama_kelas', $data['nama_kelas'])
            ->first();
        if ($existingKelas) {
            return response()->json([
                'errors' => [
                    'message' => [
                        'Nama kelas sudah pernah digunakan!'
                    ]
                ]
            ], 409);
        }

        // Check apakah data kelas sudah ada di sampah
        $deletedKelas = KelasModel::onlyTrashed()->where('nama_kelas', $data['nama_kelas'])
            ->first();

        if ($deletedKelas) {
            return (new KelasResource([
                'errors' => [
                    'message' => [
                        'Data dengan nama jurusan serupa sudah ada di tempat sampah! Pulihkan?'
                    ]
                ],
                'id_kelas' => $deletedKelas->id_kelas,
            ]))->response()->setStatusCode(201);
        }

        // Membuat id secara otomatis
        $banyakData = KelasModel::withTrashed()->count();
        $data['id_kelas'] = "K-" . str_pad(($banyakData + 1), 3, '0', STR_PAD_LEFT);

        // Insert data ke tabel
        $kelas = new KelasModel($data);
        $kelas->save();

        // Jika status data tidak aktif, set deleted_at agar tidak null (soft delete)
        if ($kelas->status_data == "Tidak Aktif") {
            (KelasModel::find($data['id_kelas']))
                ->delete();
        }

        // Kembalikan dengan respon
        return (new KelasResource([
            'success' => [
                'message' => "Kelas $kelas->nama_kelas berhasil ditambahkan"
            ]
        ]))->response()->setStatusCode(201);
    }

    public function update (KelasUpdateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $kelas = KelasModel::where('id_kelas', $data['id_kelas'])->first();

        // Memeriksa apakah nama kelas sudah pernah digunakan
        $existingKelas = KelasModel::withTrashed()
            ->where('nama_kelas', $data['nama_kelas'])
            ->exists();

        // Jika sudah, kembalikan respons error
        if ($existingKelas && $kelas['nama_kelas'] != $data['nama_kelas']) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => [
                        'Nama kelas sudah digunakan'
                    ]
                ]
            ])->setStatusCode(400));
        }

        $kelas->update($data);

        // Jika status data tidak aktif, set deleted_at agar tidak null (soft delete)
        if ($kelas->status_data == "Tidak Aktif") {
            (KelasModel::find($data['id_kelas']))
                ->delete();
        }
        
        return (new KelasResource([
            'success' => [
                'message' => "Kelas $kelas->nama_kelas berhasil diubah"
            ]
        ]))->response()->setStatusCode(201);
    }

    public function delete(KelasReadRequest $request): JsonResponse
    {
        $data = $request->validated();

        $kelas = KelasModel::where('id_kelas', $data['id_kelas'])->first();
        
        if (!$kelas) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => [
                        'Kelas not found'
                    ]
                ]
            ])->setStatusCode(404));
        }
    
        $kelas->update(['status_data' => 'Tidak Aktif']);
        $kelas->delete(); // Perform soft delete
        
        return (new KelasResource([
            'success' => [
                'message' => "Kelas $kelas->nama_kelas berhasil dihapus"
            ]
        ]))->response()->setStatusCode(200);
    }

    public function restore(KelasReadRequest $request): JsonResponse
    {
        $data = $request->validated();
        $kelas = kelasModel::onlyTrashed()->find($data['id_kelas']); // Ambil data yang sudah dihapus
        
        if (!$kelas) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => [
                        'Kelas not found'
                    ]
                ]
            ])->setStatusCode(404));
        }
        $kelas->update(['status_data' => 'Aktif']);
        $kelas->restore(); // Memulihkan data
        return (new KelasResource([
            'success' => [
                'message' => "Kelas $kelas->nama_kelas berhasil dipulihkan"
            ]
        ]))->response()->setStatusCode(200);
    }

}
