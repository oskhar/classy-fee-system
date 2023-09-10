<?php

namespace App\Imports;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\SiswaModel;
use App\Models\WaliSiswaModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SiswaImport implements ToModel, WithStartRow
{
    /**
     * Menentukan baris pertama yang akan dibaca (baris judul diabaikan).
     *
     * @return int
     */
    public function startRow(): int
    {
        return 5; // Mulai membaca data dari baris kedua (abaikan baris judul)
    }
    public function model(array $row)
    {
        // Cek apakah data siswa sudah ada berdasarkan nis (misalnya, kolom nis di Excel adalah kolom pertama)
        $siswa = SiswaModel::where('nis', $row[0])->first();
        $banyakData = WaliSiswaModel::withTrashed()->count();
        $idWaliSiswa = "WS-" . str_pad(($banyakData + 1), 8, '0', STR_PAD_LEFT);


        // Jika data siswa tidak ditemukan, maka buat data siswa baru
        if (!$siswa) {
            // Selanjutnya, impor data ke tabel WaliSiswaModel (misalnya, kolom pertama adalah kolom nis di Excel)
            $waliSiswa = new WaliSiswaModel([
                'nama_ayah' => $row[9],
                'pekerjaan_ayah' => $row[10],
                'penghasilan_ayah' => $row[11],
                'nama_ibu' => $row[12],
                'pekerjaan_ibu' => $row[13],
                'penghasilan_ibu' => $row[14],
                'status_data' => $row[8],
                'telp_rumah' => $row[15],
                'id_wali_siswa' => $idWaliSiswa
            ]);

            // Simpan data ke tabel WaliSiswaModel
            $waliSiswa->save();
            
            $siswa = new SiswaModel([
                'nis' => $row[0],
                'nisn' => $row[1],
                'nama_siswa' => $row[2],
                'jenis_kelamin' => $row[3],
                'agama' => $row[4],
                'tempat_lahir' => $row[5],
                'tanggal_lahir' => $row[6],
                'alamat' => $row[7],
                'status_data' => $row[8],
                'id_wali_siswa' => $idWaliSiswa
            ]);

            $siswa->save();
        }
        
        return $siswa;
    }
}
