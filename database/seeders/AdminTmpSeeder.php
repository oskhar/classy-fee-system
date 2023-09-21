<?php

namespace Database\Seeders;

use App\Models\AdminModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminTmpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Mengisi data pada tabel admin
         * dengan data default untuk
         * sistem auth semetara
         */
        AdminModel::create([
            'id_admin' => 'J-001',
            'username' => 'admin',
            'password' => Hash::make('admin'),
        ]);
    }
}
