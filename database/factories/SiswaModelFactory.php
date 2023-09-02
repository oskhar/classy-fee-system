<?php

namespace Database\Factories;

use App\Models\WaliSiswaModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SiswaModel>
 */
class SiswaModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nis' => $this->faker->unique()->numerify('########'), // Menghasilkan string angka acak dengan 8 digit
            'nisn' => $this->faker->unique()->numerify('########'), // Menghasilkan string angka acak dengan 8 digit
            'nama_siswa' => $this->faker->unique()->name,
            'jenis_kelamin' => $this->faker->randomElement(['Pria', 'Wanita']),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Konghucu', 'Hindu', 'Buddha']),
            'tempat_lahir' => $this->faker->city,
            'tanggal_lahir' => $this->faker->date,
            'alamat' => $this->faker->address,
        ];
    }
}
