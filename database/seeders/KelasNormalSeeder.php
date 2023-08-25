<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\KelasModel;
use \App\Models\JurusanModel;

class KelasNormalSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        KelasModel::create([
            'id_kelas' => 'K-001',
            'id_jurusan' => 'J-001',
            'nama_kelas' => 'X-IPA-1',
        ]);
        KelasModel::create([
            'id_kelas' => 'K-002',
            'id_jurusan' => 'J-001',
            'nama_kelas' => 'X-IPA-2',
        ]);
        KelasModel::create([
            'id_kelas' => 'K-003',
            'id_jurusan' => 'J-001',
            'nama_kelas' => 'X-IPA-3',
        ]);
        KelasModel::create([
            'id_kelas' => 'K-004',
            'id_jurusan' => 'J-001',
            'nama_kelas' => 'XI-IPA-1',
        ]);
        KelasModel::create([
            'id_kelas' => 'K-005',
            'id_jurusan' => 'J-001',
            'nama_kelas' => 'XI-IPA-2',
        ]);
        KelasModel::create([
            'id_kelas' => 'K-006',
            'id_jurusan' => 'J-001',
            'nama_kelas' => 'XI-IPA-3',
        ]);
        KelasModel::create([
            'id_kelas' => 'K-007',
            'id_jurusan' => 'J-001',
            'nama_kelas' => 'XII-IPA-1',
        ]);
        KelasModel::create([
            'id_kelas' => 'K-008',
            'id_jurusan' => 'J-001',
            'nama_kelas' => 'XII-IPA-2',
        ]);
        KelasModel::create([
            'id_kelas' => 'K-009',
            'id_jurusan' => 'J-001',
            'nama_kelas' => 'XII-IPA-3',
        ]);
        KelasModel::create([
            'id_kelas' => 'K-010',
            'id_jurusan' => 'J-002',
            'nama_kelas' => 'X-IPS-1',
        ]);
        KelasModel::create([
            'id_kelas' => 'K-011',
            'id_jurusan' => 'J-002',
            'nama_kelas' => 'X-IPS-2',
        ]);
        KelasModel::create([
            'id_kelas' => 'K-012',
            'id_jurusan' => 'J-002',
            'nama_kelas' => 'X-IPS-3',
        ]);
        KelasModel::create([
            'id_kelas' => 'K-013',
            'id_jurusan' => 'J-002',
            'nama_kelas' => 'XI-IPS-1',
        ]);
        KelasModel::create([
            'id_kelas' => 'K-014',
            'id_jurusan' => 'J-002',
            'nama_kelas' => 'XI-IPS-2',
        ]);
        KelasModel::create([
            'id_kelas' => 'K-015',
            'id_jurusan' => 'J-002',
            'nama_kelas' => 'XI-IPS-3',
        ]);
        KelasModel::create([
            'id_kelas' => 'K-016',
            'id_jurusan' => 'J-002',
            'nama_kelas' => 'XII-IPS-1',
        ]);
        KelasModel::create([
            'id_kelas' => 'K-017',
            'id_jurusan' => 'J-002',
            'nama_kelas' => 'XII-IPS-2',
        ]);
        KelasModel::create([
            'id_kelas' => 'K-018',
            'id_jurusan' => 'J-002',
            'nama_kelas' => 'XII-IPS-3',
        ]);
        KelasModel::create([
            'id_kelas' => 'K-019',
            'id_jurusan' => 'J-003',
            'nama_kelas' => 'X-TKJ-1',
        ]);
        KelasModel::create([
            'id_kelas' => 'K-020',
            'id_jurusan' => 'J-003',
            'nama_kelas' => 'X-TKJ-2',
        ]);
        KelasModel::create([
            'id_kelas' => 'K-021',
            'id_jurusan' => 'J-003',
            'nama_kelas' => 'XI-TKJ-1',
        ]);
        KelasModel::create([
            'id_kelas' => 'K-022',
            'id_jurusan' => 'J-003',
            'nama_kelas' => 'XI-TKJ-2',
        ]);
        KelasModel::create([
            'id_kelas' => 'K-023',
            'id_jurusan' => 'J-003',
            'nama_kelas' => 'XII-TKJ-1',
        ]);
        KelasModel::create([
            'id_kelas' => 'K-024',
            'id_jurusan' => 'J-003',
            'nama_kelas' => 'XII-TKJ-2',
        ]);
        KelasModel::create([
            'id_kelas' => 'K-025',
            'id_jurusan' => 'J-004',
            'nama_kelas' => 'X-MM-1',
        ]);
        KelasModel::create([
            'id_kelas' => 'K-026',
            'id_jurusan' => 'J-004',
            'nama_kelas' => 'X-MM-2',
        ]);
        KelasModel::create([
            'id_kelas' => 'K-027',
            'id_jurusan' => 'J-004',
            'nama_kelas' => 'XI-MM-1',
        ]);
        KelasModel::create([
            'id_kelas' => 'K-028',
            'id_jurusan' => 'J-004',
            'nama_kelas' => 'XI-MM-2',
        ]);
        KelasModel::create([
            'id_kelas' => 'K-029',
            'id_jurusan' => 'J-004',
            'nama_kelas' => 'XII-MM-1',
        ]);
        KelasModel::create([
            'id_kelas' => 'K-030',
            'id_jurusan' => 'J-004',
            'nama_kelas' => 'XII-MM-2',
        ]);
    }
}