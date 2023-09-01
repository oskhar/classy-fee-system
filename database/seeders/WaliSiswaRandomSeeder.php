<?php

namespace Database\Seeders;

use App\Models\WaliSiswaModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WaliSiswaRandomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WaliSiswaModel::factory(2160)->create();
    }
}
