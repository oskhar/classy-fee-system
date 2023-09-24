<?php

namespace Database\Seeders;

use App\Models\TahunAjarModel;
use Illuminate\Database\Seeder;
use App\Models\KelasModel;
use App\Models\SiswaModel;
use App\Models\MasterDataSiswaModel;

class MasterDataSiswaRandomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        /**
         * Mendapatakan beberapa informasi yang
         * dibutuhkan untuk melakukan mengisi
         * data dari tabel master_data_siswa
         */
        $siswa = SiswaModel::all();
        $kelas = KelasModel::all();
        $tahunAjar = TahunAjarModel::where('semester', 'Ganjil')->get();

        /**
         * Menghitung banyak data dari
         * masing masing tabel
         */
        $totalSiswa = count($siswa);
        $totalKelas = count($kelas);
        $totalTahunAjar = count($tahunAjar);

        $siswaPerKelasPerTahun = ceil($totalSiswa / ($totalKelas * $totalTahunAjar));


        /**
         * Inisialisasi variabel jumlah siswa
         * yang telah ditempatkan
         */
        $siswaIndex = 0;

        /**
         * Melakukan perulangan untuk membuat
         * data sebanyak jumlah data siswa
         */
        foreach ($tahunAjar as $tahun) {
            foreach ($kelas as $dataKelas) {
                /**
                 * Mengambil siswa sesuai jumlah yang
                 * akan ditempatkan dalam dataKelas ini
                 */
                if (is_object($dataKelas)) {
                    $siswaTerpilih = $siswa->slice($siswaIndex, $siswaPerKelasPerTahun);

                    foreach ($siswaTerpilih as $data) {
                        MasterDataSiswaModel::create([
                            'nis' => $data->nis,
                            'nisn' => $data->nisn,
                            'id_kelas' => $dataKelas->id_kelas,
                            'id_tahun_ajar' => $tahun->id_tahun_ajar,
                        ]);
                    }
                }

                /**
                 * Mengupdate variabel jumlah siswa
                 * yang telah ditempatkan
                 */
                $siswaIndex += $siswaPerKelasPerTahun;
            }
        }
        
        /**
         * Ulangi lagi pada tahun ajar genap
         */
        $tahunAjar = TahunAjarModel::where('semester', 'Genap')->get();

        /**
         * Inisialisasi variabel jumlah siswa
         * yang telah ditempatkan
         */
        $siswaIndex = 0;

        /**
         * Melakukan perulangan untuk membuat
         * data sebanyak jumlah data siswa
         */
        foreach ($tahunAjar as $tahun) {
            foreach ($kelas as $dataKelas) {
                /**
                 * Mengambil siswa sesuai jumlah yang
                 * akan ditempatkan dalam dataKelas ini
                 */
                if (is_object($dataKelas)) {
                    $siswaTerpilih = $siswa->slice($siswaIndex, $siswaPerKelasPerTahun);

                    foreach ($siswaTerpilih as $data) {
                        MasterDataSiswaModel::create([
                            'nis' => $data->nis,
                            'nisn' => $data->nisn,
                            'id_kelas' => $dataKelas->id_kelas,
                            'id_tahun_ajar' => $tahun->id_tahun_ajar,
                        ]);
                    }
                }

                /**
                 * Mengupdate variabel jumlah siswa
                 * yang telah ditempatkan
                 */
                $siswaIndex += $siswaPerKelasPerTahun;
            }
        }
    }
}
