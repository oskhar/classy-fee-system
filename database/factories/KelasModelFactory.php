<?php

namespace Database\Factories;

use App\Models\JurusanModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KelasModel>
 */
class KelasModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_kelas' => $this->faker->unique()->name,
            'nama_kelas' => $this->faker->unique()->name,
            'id_jurusan' => JurusanModel::all()->random()->id_jurusan,
        ];
    }
}
