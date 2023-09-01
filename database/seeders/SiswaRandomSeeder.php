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
            // Membuat data wali siswa
            $waliSiswa = WaliSiswaModel::factory()->create();

            // Menggunakan ID wali siswa yang baru saja dibuat untuk membuat data siswa
            SiswaModel::factory()->create([
                'id_wali_siswa' => $waliSiswa->id_wali_siswa,
            ]);
        }
    }
}
