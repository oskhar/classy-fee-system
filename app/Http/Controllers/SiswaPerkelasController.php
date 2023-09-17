<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiswaCreateRequest;
use App\Http\Requests\SiswaReadRequest;
use App\Http\Requests\SiswaUpdateRequest;
use App\Http\Resources\SiswaResource;
use App\Models\SiswaModel;
use App\Models\WaliSiswaModel;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function get(SiswaReadRequest $request): JsonResponse
    {
        $query = SiswaModel::select(
            'nis',
            'nisn',
            'nama_siswa',
            'jenis_kelamin',
            'tempat_lahir',
            'tanggal_lahir',
            'status_data',
            );
    
        if ($request->has('nis')) {
            $siswa = SiswaModel::select(
                'tb_siswa.nis',
                'tb_siswa.nisn',
                'tb_siswa.nama_siswa',
                'tb_siswa.jenis_kelamin',
                'tb_siswa.agama',
                'tb_siswa.tempat_lahir',
                'tb_siswa.tanggal_lahir',
                'tb_siswa.alamat',
                'tb_siswa.status_data',
                'tb_wali_siswa.nama_ayah',
                'tb_wali_siswa.pekerjaan_ayah',
                'tb_wali_siswa.penghasilan_ayah',
                'tb_wali_siswa.nama_ibu',
                'tb_wali_siswa.pekerjaan_ibu',
                'tb_wali_siswa.penghasilan_ibu',
                'tb_wali_siswa.telp_rumah',
            )->join('tb_wali_siswa', 'tb_siswa.id_wali_siswa', '=', 'tb_wali_siswa.id_wali_siswa')->where('tb_siswa.nis', $request->nis)->first();
            return (new SiswaResource($siswa))->response()->setStatusCode(200);
        }

        $totalRecords = SiswaModel::count();

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
                'jenis_kelamin',
                'tempat_lahir',
                'tanggal_lahir',
            ];

            if (isset($columns[$orderByColumn])) {
                $orderBy = $columns[$orderByColumn];
                $query = $query->orderBy($orderBy, $orderByDir);
            }
        }

        // Pencarian berdasarkan nama_siswa
        if ($request->has('search') && !empty($request->search['value'])) {
            $searchValue = $request->search['value'];
            $query = $query->where('nama_siswa', 'LIKE', '%' . $searchValue . '%');
            $filteredRecords = $query->count();
        } else {
            $filteredRecords = $totalRecords; // Jumlah total keseluruhan data
        }

        $data = $query->get();
        
        $response = [
            'draw' => intval($request->input('draw')), // Pastikan draw disertakan
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => SiswaResource::collection($data),
        ];
        
        return response()->json($response)->setStatusCode(200);
    }

    public function create(SiswaCreateRequest $request): JsonResponse
    {
        // Validasi data
        $data = $request->validated();

        // Check apakah data Siswa sudah digunakan
        $existingSiswaNis = SiswaModel::where('nis', $data['nis'])
            ->first();
        $existingSiswaNisn = SiswaModel::where('nisn', $data['nisn'])
            ->first();
        if ($existingSiswaNis || $existingSiswaNisn) {
            return response()->json([
                'errors' => [
                    'message' => [
                        'NIS atau NISN Siswa sudah pernah digunakan!'
                    ]
                ]
            ], 409);
        }

        // Check apakah data Siswa sudah ada di sampah
        $deletedSiswaNis = SiswaModel::onlyTrashed()->where('nis', $data['nis'])
            ->first();

        // Check apakah data Siswa sudah ada di sampah
        $deletedSiswaNisn = SiswaModel::onlyTrashed()->where('nisn', $data['nisn'])
            ->first();

        if ($deletedSiswaNis || $deletedSiswaNisn) {
            return (new SiswaResource([
                'errors' => [
                    'message' => [
                        'Data dengan nama jurusan serupa sudah ada di tempat sampah! Pulihkan?'
                    ]
                ],
                'nis' => $deletedSiswaNis->nis,
            ]))->response()->setStatusCode(201);
        }

        // Membuat id secara otomatis
        $banyakData = WaliSiswaModel::withTrashed()->count();
        $data['id_wali_siswa'] = "WS-" . str_pad(($banyakData + 1), 8, '0', STR_PAD_LEFT);

        // Insert data ke tabel
        $siswa = new SiswaModel([
            'nama_siswa' => $data['nama_siswa'],
            'nis' => $data['nis'],
            'nisn' => $data['nisn'],
            'agama' => $data['agama'],
            'tempat_lahir' => $data['tempat_lahir'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'alamat' => $data['alamat'],
            'status_data' => $data['status_data'],
            'id_wali_siswa' => $data['id_wali_siswa'],
        ]);
        $waliSiswa = new WaliSiswaModel([
            'id_wali_siswa' => $data['id_wali_siswa'],
            'nama_ayah' => $data['nama_ayah'],
            'pekerjaan_ayah' => $data['pekerjaan_ayah'],
            'penghasilan_ayah' => $data['penghasilan_ayah'],
            'nama_ibu' => $data['nama_ibu'],
            'pekerjaan_ibu' => $data['pekerjaan_ibu'],
            'penghasilan_ibu' => $data['penghasilan_ibu'],
            'telp_rumah' => $data['telp_rumah'],
        ]);

        // Wali siswa terlebih dahulu karena ketergantungan referensi foreign key
        $waliSiswa->save();
        $siswa->save();

        // Jika status data tidak aktif, set deleted_at agar tidak null (soft delete)
        if ($siswa->status_data == "Tidak Aktif") {
            (SiswaModel::find($data['id_wali_siswa']))
                ->delete();
            (WaliSiswaModel::find($data['id_wali_siswa']))
                ->delete();
        }

        // Kembalikan dengan respon
        return (new SiswaResource([
            'success' => [
                'message' => "Siswa $siswa->nama_siswa berhasil ditambahkan"
            ]
        ]))->response()->setStatusCode(201);
    }
    public function update (SiswaUpdateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $siswa = SiswaModel::where('nis', $data['nis'])->first();
        $waliSiswa = WaliSiswaModel::where('id_wali_siswa', $siswa['id_wali_siswa']);

        // Memeriksa apakah nama kelas sudah pernah digunakan
        $existingNis = SiswaModel::withTrashed()
            ->where('nis', $data['nis'])
            ->exists();

        // Jika sudah, kembalikan respons error
        if ($existingNis && $siswa['nis'] != $data['nis']) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => [
                        'NIS sudah digunakan'
                    ]
                ]
            ])->setStatusCode(400));
        }

        // Memeriksa apakah nama kelas sudah pernah digunakan
        $existingNISN = SiswaModel::withTrashed()
            ->where('nisn', $data['nisn'])
            ->exists();

        // Jika sudah, kembalikan respons error
        if ($existingNISN && $siswa['nisn'] != $data['nisn']) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => [
                        'NISN sudah digunakan'
                    ]
                ]
            ])->setStatusCode(400));
        }

        $siswa->update($data);

        // Insert data ke tabel
        $siswa->update([
            'nama_siswa' => $data['nama_siswa'],
            'nis' => $data['nis'],
            'nisn' => $data['nisn'],
            'agama' => $data['agama'],
            'tempat_lahir' => $data['tempat_lahir'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'alamat' => $data['alamat'],
            'status_data' => $data['status_data'],
            'id_wali_siswa' => $data['id_wali_siswa'],
        ]);
        $waliSiswa->update([
            'id_wali_siswa' => $data['id_wali_siswa'],
            'nama_ayah' => $data['nama_ayah'],
            'pekerjaan_ayah' => $data['pekerjaan_ayah'],
            'penghasilan_ayah' => $data['penghasilan_ayah'],
            'nama_ibu' => $data['nama_ibu'],
            'pekerjaan_ibu' => $data['pekerjaan_ibu'],
            'penghasilan_ibu' => $data['penghasilan_ibu'],
            'telp_rumah' => $data['telp_rumah'],
        ]);

        // Jika status data tidak aktif, set deleted_at agar tidak null (soft delete)
        if ($siswa->status_data == "Tidak Aktif") {
            (SiswaModel::find($data['nis']))
                ->delete();
            (WaliSiswaModel::find($data['id_wali_siswa']))
                ->delete();
        }
        
        return (new SiswaResource([
            'success' => [
                'message' => "Kelas $siswa->nama_kelas berhasil diubah"
            ]
        ]))->response()->setStatusCode(201);
    }

    public function delete(SiswaReadRequest $request): JsonResponse
    {
        $data = $request->validated();

        $siswa = SiswaModel::find($data['nis']);
        $waliSiswa = WaliSiswaModel::find($siswa->id_wali_siswa);
        
        if (!$siswa || !$waliSiswa) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => [
                        'Siswa not found'
                    ]
                ]
            ])->setStatusCode(404));
        }
        $siswa->update(['status_data' => 'Tidak Aktif']);
        $waliSiswa->update(['status_data' => 'Tidak Aktif']);
        $siswa->delete(); // Perform soft delete
        $waliSiswa->delete(); // Perform soft delete
        
        return (new SiswaResource([
            'success' => [
                'message' => "Siswa $siswa->nama_siswa berhasil dihapus"
            ]
        ]))->response()->setStatusCode(204);
    }

    public function restore(SiswaReadRequest $request): JsonResponse
    {
        $data = $request->validated();
        $siswa = SiswaModel::onlyTrashed()->find($data['nis']); // Ambil data yang sudah dihapus
        $waliSiswa = WaliSiswaModel::onlyTrashed()->find($siswa->id_wali_siswa);
        
        if (!$siswa || $waliSiswa) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => [
                        'Siswa not found'
                    ]
                ]
            ])->setStatusCode(404));
        }

        $siswa->update(['status_data' => 'Aktif']);
        $waliSiswa->update(['status_data' => 'Aktif']);
        $siswa->restore(); // Memulihkan data
        $waliSiswa->restore(); // Memulihkan data
        return (new SiswaResource([
            'success' => [
                'message' => "Siswa $siswa->nama_siswa berhasil dipulihkan"
            ]
        ]))->response()->setStatusCode(204);
    }

}
