<?php

namespace Database\Seeders;

use App\Models\Tabungan\RekeningModel;
use App\Models\SiswaModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RekeningRandomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Menentukan banyak data yang ditambahkan
         * ke dalam tabel reking tabungan
         */
        $dataSiswa = SiswaModel::all();

        /**
         * Melakukan penambahan data reking
         * menggunakan costum factory
         */
        foreach ($dataSiswa as $data) {
            RekeningModel::factory()->create([
                'nis' => $data->nis,
            ]);
        }
    }
}
