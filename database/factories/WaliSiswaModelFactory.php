<?php

    namespace Database\Factories;

    use Illuminate\Database\Eloquent\Factories\Factory;

    /**
     * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WaliSiswaModel>
     */
    class WaliSiswaModelFactory extends Factory
    {
        /**
         * Define the model's default state.
         *
         * @return array<string, mixed>
         */
        public function definition(): array
        {
            return [
                'nama_ayah' => $this->faker->name,
                'pekerjaan_ayah' => $this->faker->jobTitle,
                'penghasilan_ayah' => $this->faker->numberBetween(1000000, 10000000),
                'nama_ibu' => $this->faker->name,
                'pekerjaan_ibu' => $this->faker->jobTitle,
                'penghasilan_ibu' => $this->faker->numberBetween(1000000, 10000000),
                'telp_rumah' => $this->faker->phoneNumber,
            ];
        }
    }
