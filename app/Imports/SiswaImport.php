<?php

namespace App\Imports;
use App\Models\MasterDataSiswaModel;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\SiswaModel;
use App\Models\WaliSiswaModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SiswaImport implements ToModel, WithStartRow
{
    private $id_kelas;
    private $id_tahun_ajar;

    public function __construct($id_kelas, $id_tahun_ajar)
    {
        $this->id_kelas = $id_kelas;
        $this->id_tahun_ajar = $id_tahun_ajar;
    }
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
            /**
             * Selanjutnya, impor data ke tabel WaliSiswaModel
             * (misalnya, kolom pertama adalah kolom nis di Excel)
             * 
             */
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
            $waliSiswa->save();
            
            /**
             * Melakukan tambah data ke tabel siswa
             * dengan data pada row excel yang
             * sesuai
             */
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

            /**
             * Menambahkan data master data setelah
             * data siswa berhasil ditambahkan
             */
            $masterDataSiswa = new MasterDataSiswaModel([
                'nis' => $row[0],
                'nisn' => $row[1],
                'id_tahun_ajar' => $this->id_tahun_ajar,
                'id_kelas' => $this->id_kelas,
            ]);
            $masterDataSiswa->save();

        } else {

            /**
             * Menambahkan data master data setelah
             * data siswa berhasil ditambahkan
             */
            $masterDataSiswa = new MasterDataSiswaModel([
                'nis' => $siswa->nis,
                'nisn' => $siswa->nisn,
                'id_tahun_ajar' => $this->id_tahun_ajar,
                'id_kelas' => $this->id_kelas,
            ]);
            $masterDataSiswa->save();
        }
        
        return $siswa;
    }
}
