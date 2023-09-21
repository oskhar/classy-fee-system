<?php

namespace Database\Seeders;

use App\Models\SiswaModel;
use App\Models\WaliSiswaModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiswaRandomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Menentukan jumlah data yang diinginkan
         * untuk melakukan penambahan data
         * sebanyak jumlah data yang sesuai
         */
        $jumlahData = 2160; // Ganti dengan jumlah yang diinginkan

        /**
         * Melakukan perulangan sebanyak number jumlahData
         * yang ditentukan untuk melakukan penambahan
         * data yang relevan dengan ketentuan
         */
        for ($i = 0; $i < $jumlahData; $i++) {

            /**
             * Membuat id walisiswa berdasarkan banyaknya
             * jumlah data (count) pada tabel walisiswa
             */
            $banyakData = WaliSiswaModel::withTrashed()->count();
            $idWaliSiswa = "WS-" . str_pad(($banyakData + 1), 8, '0', STR_PAD_LEFT);

            /**
             * Membuat data wali siswa berdasarkan
             * idWaliSiswa yang sudah ditentukan
             */
            WaliSiswaModel::factory()->create([
                'id_wali_siswa' => $idWaliSiswa,
            ]);

            /**
             * Menggunakan idWali siswa untuk membuat data
             * siswa yang terhubung dengan wali siswa
             */
            SiswaModel::factory()->create([
                'id_wali_siswa' => $idWaliSiswa,
            ]);
        }
    }
}
