<?php

namespace Database\Seeders;

use App\Models\KelasModel;
use App\Models\JurusanModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasRandomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < JurusanModel::all()->count(); $i++) {

            $tingkatanKelas = ["x", "XI", "XII"];
            for ($j=0; $j < 3; $j++) {
                $idKelas = "K-" . str_pad((($i * 3 + $j) + 1), 3, '0', STR_PAD_LEFT);
                $idJurusan = "J-" . str_pad(($i + 1), 3, '0', STR_PAD_LEFT);
                $singkatanKelas = JurusanModel::where('id_jurusan', $idJurusan)->first()->singkatan;

                KelasModel::create([
                    'id_kelas' => $idKelas,
                    'id_jurusan' => $idJurusan,
                    'nama_kelas' => $tingkatanKelas[$j].'-'.$singkatanKelas.'-1',
                ]);
            }
        }
    }
}
