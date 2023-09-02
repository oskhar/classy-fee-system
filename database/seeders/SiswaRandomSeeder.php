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
        // Jumlah data yang ingin Anda buat
        $jumlahData = 2160; // Ganti dengan jumlah yang diinginkan

        for ($i = 0; $i < $jumlahData; $i++) {

            $banyakData = WaliSiswaModel::withTrashed()->count();
            $idWaliSiswa = "WS-" . str_pad(($banyakData + 1), 8, '0', STR_PAD_LEFT);

            // Membuat data wali siswa
            WaliSiswaModel::factory()->create([
                'id_wali_siswa' => $idWaliSiswa,
            ]);

            // Menggunakan ID wali siswa yang baru saja dibuat untuk membuat data siswa
            SiswaModel::factory()->create([
                'id_wali_siswa' => $idWaliSiswa,
            ]);
        }
    }
}
