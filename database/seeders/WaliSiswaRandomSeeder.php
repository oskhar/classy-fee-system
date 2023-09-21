<?php

namespace Database\Seeders;

use App\Models\WaliSiswaModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WaliSiswaRandomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Menentukan banyak data yang ditambahkan
         * ke dalam tabel wali siswa
         */
        $banyakData = 2160;

        /**
         * Melakukan penambahan data wali siswa
         * menggunakan costum factory
         */
        WaliSiswaModel::factory($banyakData)->create();
    }
}
