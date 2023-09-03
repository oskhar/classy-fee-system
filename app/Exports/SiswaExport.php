<?php

namespace App\Exports;

use App\Models\SiswaModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        // Menyusun baris judul Anda
        return [
            'NIS',
            'NISN',
            'Nama Siswa',
            'Jenis Kelamin',
            'Agama',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Alamat',
            'Status Data',
            'Nama Ayah',
            'Pekerjaan Ayah',
            'Penghasilan Ayah',
            'Nama Ibu',
            'Pekerjaan Ibu',
            'Penghasilan Ibu',
            'Telp Rumah',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return SiswaModel::select(
            'tb_siswa.nis',
            'tb_siswa.nisn',
            'tb_siswa.nama_siswa',
            'tb_siswa.jenis_kelamin',
            'tb_siswa.agama',
            'tb_siswa.tempat_lahir',
            'tb_siswa.tanggal_lahir',
            'tb_siswa.alamat',
            'tb_siswa.status_data',
            'tb_wali_siswa.nama_ayah',
            'tb_wali_siswa.pekerjaan_ayah',
            'tb_wali_siswa.penghasilan_ayah',
            'tb_wali_siswa.nama_ibu',
            'tb_wali_siswa.pekerjaan_ibu',
            'tb_wali_siswa.penghasilan_ibu',
            'tb_wali_siswa.telp_rumah',
        )->join('tb_wali_siswa', 'tb_siswa.id_wali_siswa', '=', 'tb_wali_siswa.id_wali_siswa')->get();
    }
}
