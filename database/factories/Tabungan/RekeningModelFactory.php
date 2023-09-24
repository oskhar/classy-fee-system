<?php

namespace Database\Factories\Tabungan;

use Illuminate\Database\Eloquent\Factories\Factory;

class RekeningModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nomor_rekening' => $this->faker->unique()->numerify('########'),
            'nis' => $this->faker->unique()->numerify('########'),
            'tanggal_buka' => $this->faker->date,
            'tanggal_tutup' => $this->faker->date,
            'setoran_awal' => $this->faker->numberBetween(1, 10000) * 1000,
            'saldo' => $this->faker->numberBetween(1, 10000) * 1000,
        ];
    }
}
