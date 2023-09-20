<?php

namespace Database\Factories;


use App\Models\KelasModel;
use App\Models\SiswaModel;
use App\Models\TahunAjarModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class MasterDataSiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nis' => SiswaModel::all()->random()->nis,
            'nisn' => SiswaModel::all()->random()->nisn,
            'id_kelas' => KelasModel::all()->random()->id_kelas,
            'id_tahun_ajar' => TahunAjarModel::all()->random()->id_tahun_ajar,
        ];
    }
}
