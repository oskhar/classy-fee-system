<?php

namespace Database\Seeders;

use App\Models\Tabungan\BukuTabunganModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BukuTabunganRandomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        BukuTabunganModel::created([
            'id_buku_tabungan' => 1,
            'nomor_rekening' => '01768026',
            'debit' => 1000000,
            'kredit' => 0,
            'saldo' => 1000000,
            'tanggal' => '2021-2-20',
        ]);
        BukuTabunganModel::created([
            'id_buku_tabungan' => 1,
            'nomor_rekening' => '01768026',
            'debit' => 6000000,
            'kredit' => 0,
            'saldo' => 7000000,
            'tanggal' => '2021-4-20',
        ]);
        BukuTabunganModel::created([
            'id_buku_tabungan' => 1,
            'nomor_rekening' => '01768026',
            'debit' => 0,
            'kredit' => 2000000,
            'saldo' => 5000000,
            'tanggal' => '2021-6-20',
        ]);
        BukuTabunganModel::created([
            'id_buku_tabungan' => 1,
            'nomor_rekening' => '01768026',
            'debit' => 0,
            'kredit' => 655000,
            'saldo' => 4345000,
            'tanggal' => '2021-8-20',
        ]);
    }
}
