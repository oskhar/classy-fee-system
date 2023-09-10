<?php

namespace App\Exports;

use App\Models\SiswaModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SiswaExport implements FromCollection, WithHeadings, WithEvents, WithCustomStartCell, WithStyles
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
    
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Menggabungkan kolom A sampai C pada baris 1
                $event->sheet->getDelegate()->mergeCells('A1:P3');
                
                // Menambahkan judul ke tengah-tengah sel yang digabungkan
                $event->sheet->setCellValue('A1', 'Data Siswa SMK Triguna Utama'.chr(10).'Excel ini merupakan file data untuk di-export-kan dari web');
                $event->sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Mengatur "wrap text" atau "teks berjalan otomatis" untuk kolom yang membutuhkan
        $sheet->getStyle(1)->getAlignment()->setWrapText(true);
        $sheet->getColumnDimension('A')->setWidth(15);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(14);
        $sheet->getColumnDimension('E')->setWidth(14);
        $sheet->getColumnDimension('F')->setWidth(14);
        $sheet->getColumnDimension('G')->setWidth(14);
        $sheet->getColumnDimension('H')->setWidth(14);
        $sheet->getColumnDimension('I')->setWidth(14);
        $sheet->getColumnDimension('J')->setWidth(14);
        $sheet->getColumnDimension('K')->setWidth(20);
        $sheet->getColumnDimension('L')->setWidth(20);
        $sheet->getColumnDimension('M')->setWidth(20);
        $sheet->getColumnDimension('N')->setWidth(20);
        $sheet->getColumnDimension('O')->setWidth(20);
        $sheet->getColumnDimension('P')->setWidth(20);
        return [
            4    => ['font' => ['bold' => true]],
        ];
    }

    public function startCell(): string
    {
        return 'A4';
    }
}
