<?php

namespace App\Http\Controllers;

use App\Http\Requests\JurusanCreateRequest;
use App\Http\Requests\JurusanFindRequest;
use App\Http\Requests\JurusanReadRequest;
use App\Http\Requests\JurusanUpdateRequest;
use App\Http\Resources\JurusanResource;
use App\Models\JurusanModel;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    // mendapatkan seluruh data
    public function get (): JsonResponse
    {
        $data = JurusanModel::all();
        return JurusanResource::collection($data)->response()->setStatusCode(200);
    }
    public function getUntukTabel(JurusanReadRequest $request): JsonResponse
    {
        $query = JurusanModel::select(
            'id_jurusan',
            'nama_jurusan',
            'singkatan',
            'status_data');

        $totalRecords = JurusanModel::count();

        if ($request->has('start') && $request->has('length')) {
            $query = $query->offset($request->start)
                ->limit($request->length);
        }

        // Penyortiran (Ordering) berdasarkan kolom yang dipilih
        if ($request->has('order') && count($request->order) > 0) {
            $orderByColumn = $request->order[0]['column'];
            $orderByDir = $request->order[0]['dir'];

            $columns = [
                'id_jurusan',
                'nama_jurusan',
                'singkatan'
            ];

            if (isset($columns[$orderByColumn])) {
                $orderBy = $columns[$orderByColumn];
                $query = $query->orderBy($orderBy, $orderByDir);
            }
        }

        // Pencarian berdasarkan nama_jurusan
        if ($request->has('search') && !empty($request->search['value'])) {
            $searchValue = $request->search['value'];
            $query = $query->where('nama_jurusan', 'LIKE', '%' . $searchValue . '%');
            $filteredRecords = $query->count();
        } else {
            $filteredRecords = $totalRecords; // Jumlah total keseluruhan data
        }

        $data = $query->get();
        
        $response = [
            'draw' => intval($request->input('draw')), // Pastikan draw disertakan
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => JurusanResource::collection($data),
        ];
        
        return response()->json($response)->setStatusCode(200);
    }

    public function create(JurusanCreateRequest $request): JsonResponse
    {
        // Validasi data
        $data = $request->validated();

        // Check apakah data jurusan sudah digunakan
        $existingJurusan = JurusanModel::where('nama_jurusan', $data['nama_jurusan'])->first();
        if ($existingJurusan) {
            return response()->json([
                'errors' => [
                    'message' => [
                        'Nama Jurusan sudah pernah digunakan!'
                    ]
                ]
            ], 409);
        }

        // Check apakah data Jurusan sudah ada di sampah
        $deletedJurusan = JurusanModel::onlyTrashed()->where('nama_jurusan', $data['nama_jurusan'])->first();
        if ($deletedJurusan) {
            return (new JurusanResource([
                'errors' => [
                    'message' => [
                        'Data dengan nama jurusan serupa sudah ada di tempat sampah! Pulihkan?'
                    ]
                ],
                'id_jurusan' => $deletedJurusan->id_jurusan,
            ]))->response()->setStatusCode(201);
        }

        // Membuat id secara otomatis
        $banyakData = JurusanModel::withTrashed()->count();
        $data['id_jurusan'] = "J-" . str_pad(($banyakData + 1), 3, '0', STR_PAD_LEFT);

        // Insert data ke tabel
        $jurusan = new JurusanModel($data);
        $jurusan->save();

        // Jika status data tidak aktif, set deleted_at agar tidak null (soft delete)
        if ($jurusan->status_data == "Tidak Aktif") {
            (JurusanModel::find($data['id_jurusan']))
                ->delete();
        }

        // Kembalikan dengan respon
        return (new JurusanResource(['nama_jurusan' => $jurusan->nama_jurusan]))->response()->setStatusCode(201);
    }

    public function update (JurusanUpdateRequest $request): JsonResponse
    {
        // Periksa validasi data
        $data = $request->validated();

        // Ambil data jurusan serupa
        $jurusan = JurusanModel::where('id_jurusan', $data['id_jurusan'])->first();

        // Memeriksa apakah nama jurusan sudah pernah digunakan
        $existingJurusan = JurusanModel::withTrashed()
            ->where('nama_jurusan', $data['nama_jurusan'])
            ->exists();

        // Jika sudah, kembalikan respons error
        if ($existingJurusan && $jurusan['nama_jurusan'] != $data['nama_jurusan']) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => [
                        'Nama jurusan sudah digunakan'
                    ]
                ]
            ])->setStatusCode(400));
        }

        $jurusan->update($data);

        // Jika status data tidak aktif, set deleted_at agar tidak null (soft delete)
        if ($jurusan->status_data == "Tidak Aktif") {
            (JurusanModel::find($data['id_jurusan']))
                ->delete();
        }

        return (new JurusanResource(['nama_jurusan' => $jurusan->nama_jurusan]))->response()->setStatusCode(201);
    }

    public function delete(JurusanFindRequest $request): JsonResponse
    {
        $data = $request->validated();

        $jurusan = JurusanModel::where('id_jurusan', $data['id_jurusan'])->first();
        $jurusan->update(['status_data' => 'Tidak Aktif']);
        
        if (!$jurusan) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => [
                        'jurusan not found'
                    ]
                ]
            ])->setStatusCode(404));
        }
    
        $jurusan->delete(); // Perform soft delete
        
        return (new JurusanResource(['nama_jurusan' => $jurusan->nama_jurusan]))->response()->setStatusCode(200);
    }

    public function restore(JurusanFindRequest $request): JsonResponse
    {
        $data = $request->validated();
        $jurusan = JurusanModel::onlyTrashed()->find($data['id_jurusan']); // Ambil data yang sudah dihapus
        $jurusan->update(['status_data' => 'Aktif']);
        $jurusan->restore(); // Memulihkan data
        return (new JurusanResource(['nama_jurusan' => $jurusan->nama_jurusan]))->response()->setStatusCode(200);
    }

    public function find(JurusanFindRequest $request): JsonResponse
    {
        $data = $request->validated();
        $jurusan = JurusanModel::select(
            'id_jurusan',
            'nama_jurusan',
            'singkatan',
            'status_data')
            ->where('id_jurusan', $data['id_jurusan'])
            ->first();
        
        return (new JurusanResource($jurusan))->response()->setStatusCode(200);
    }

    public function getUntukInputOption (): JsonResponse
    {
        $data = JurusanModel::select("id_jurusan", "nama_jurusan")->get();
        return JurusanResource::collection($data)->response()->setStatusCode(200);
    }
}
