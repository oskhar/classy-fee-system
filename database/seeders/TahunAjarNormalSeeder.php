<?php

namespace Database\Seeders;

use App\Models\TahunAjarModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TahunAjarNormalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        TahunAjarModel::create([
            'id_tahun_ajar' => 'TA-001',
            'nama_tahun_ajar' => '2021/2022',
            'semester' => 'Ganjil',
        ]);
        TahunAjarModel::create([
            'id_tahun_ajar' => 'TA-002',
            'nama_tahun_ajar' => '2021/2022',
            'semester' => 'Genap',
        ]);
        TahunAjarModel::create([
            'id_tahun_ajar' => 'TA-003',
            'nama_tahun_ajar' => '2022/2023',
            'semester' => 'Ganjil',
        ]);
        TahunAjarModel::create([
            'id_tahun_ajar' => 'TA-004',
            'nama_tahun_ajar' => '2022/2023',
            'semester' => 'Genap',
        ]);
        TahunAjarModel::create([
            'id_tahun_ajar' => 'TA-005',
            'nama_tahun_ajar' => '2023/2024',
            'semester' => 'Ganjil',
        ]);
        TahunAjarModel::create([
            'id_tahun_ajar' => 'TA-006',
            'nama_tahun_ajar' => '2023/2024',
            'semester' => 'Genap',
        ]);
    }
}