<?php

namespace Database\Seeders;

use App\Models\JurusanModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanNormalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        JurusanModel::create([
            'id_jurusan' => 'J-001',
            'nama_jurusan' => 'Ilmu Pengetahuan Alam',
            'singkatan' => 'IPA',
        ]);
        JurusanModel::create([
            'id_jurusan' => 'J-002',
            'nama_jurusan' => 'Ilmu Pengetahuan Sosial',
            'singkatan' => 'IPS',
        ]);
        JurusanModel::create([
            'id_jurusan' => 'J-003',
            'nama_jurusan' => 'Teknik Komputer Jaringan',
            'singkatan' => 'TKJ',
        ]);
        JurusanModel::create([
            'id_jurusan' => 'J-004',
            'nama_jurusan' => 'Multimedia',
            'singkatan' => 'MM',
        ]);
        JurusanModel::create([
            'id_jurusan' => 'J-005',
            'nama_jurusan' => 'Rekayasa Perangkat Lunak',
            'singkatan' => 'RPL',
        ]);
        JurusanModel::create([
            'id_jurusan' => 'J-006',
            'nama_jurusan' => 'Pariwisata',
            'singkatan' => 'PW',
        ]);
        JurusanModel::create([
            'id_jurusan' => 'J-007',
            'nama_jurusan' => 'Tata Boga',
            'singkatan' => 'TB',
        ]);
        JurusanModel::create([
            'id_jurusan' => 'J-008',
            'nama_jurusan' => 'Teknik Otomotif',
            'singkatan' => 'TO',
        ]);
        JurusanModel::create([
            'id_jurusan' => 'J-009',
            'nama_jurusan' => 'Pemasaran',
            'singkatan' => 'PS',
        ]);
    }
}
