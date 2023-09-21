<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KelasModel;
use App\Models\SiswaModel;
use App\Models\MasterDataSiswaModel;

class MasterDataSiswaRandomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        /**
         * Mendapatakan beberapa informasi yang
         * dibutuhkan untuk melakukan mengisi
         * data dari tabel master_data_siswa
         */
        $banyakKelas = KelasModel::count();
        $banyakSiswa = SiswaModel::count();
        $pembagianKelasSiswa = ceil($banyakSiswa / $banyakKelas);
        $dataKelas = KelasModel::all();

        /**
         * Inisialisasi variabel jumlah siswa
         * yang telah ditempatkan
         */
        $siswaDitempatkan = 0;

        /**
         * Melakukan perulangan untuk membuat
         * data sebanyak jumlah data siswa
         */
        foreach ($dataKelas as $kelas) {
            /**
             * Mengambil siswa sesuai jumlah yang
             * akan ditempatkan dalam kelas ini
             */
            $siswa = SiswaModel::skip($siswaDitempatkan)->take($pembagianKelasSiswa)->get();

            foreach ($siswa as $data) {
                MasterDataSiswaModel::create([
                    'nis' => $data->nis,
                    'nisn' => $data->nisn,
                    'id_kelas' => $kelas->id_kelas, // Menggunakan ID kelas saat ini
                    'id_tahun_ajar' => 'TA-001', // Sesuaikan dengan tahun ajar siswa
                ]);
            }

            /**
             * Mengupdate variabel jumlah siswa
             * yang telah ditempatkan
             */
            $siswaDitempatkan += $pembagianKelasSiswa;
        }
    }
}
