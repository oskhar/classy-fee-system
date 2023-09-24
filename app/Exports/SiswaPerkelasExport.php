<?php

namespace App\Exports;

use App\Models\MasterDataSiswaModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SiswaPerkelasExport implements FromCollection, WithHeadings, WithEvents, WithCustomStartCell, WithStyles
{
    protected $idKelas;
    protected $idTahunAjar;
    protected $namaKelas;

    public function __construct ($idKelas, $idTahunAjar, $namaKelas)
    {
    
        $this->idKelas = $idKelas;
        $this->idTahunAjar = $idTahunAjar;
        $this->namaKelas = $namaKelas;
    
    }

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
            'nama_kelas',
            'nama_tahun_ajar',
            'semester'
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return MasterDataSiswaModel::select(
            'tb_siswa.nis',
            'tb_siswa.nisn',
            'tb_siswa.nama_siswa',
            'tb_siswa.jenis_kelamin',
            'tb_siswa.agama',
            'tb_siswa.tempat_lahir',
            'tb_siswa.tanggal_lahir',
            'tb_siswa.alamat',
            'tb_siswa.status_data',
            'tb_kelas.nama_kelas',
            'tb_tahun_ajar.nama_tahun_ajar',
            'tb_tahun_ajar.semester'
        )->join('tb_siswa', 'master_data_siswa.nis', '=', 'tb_siswa.nis')
        ->join('tb_kelas', 'master_data_siswa.id_kelas', '=', 'tb_kelas.id_kelas')
        ->join('tb_tahun_ajar', 'master_data_siswa.id_tahun_ajar', '=', 'tb_tahun_ajar.id_tahun_ajar')->where('master_data_siswa.id_kelas', $this->idKelas)
        ->where('master_data_siswa.id_tahun_ajar', $this->idTahunAjar)
        ->get();
    }
    
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Menggabungkan kolom A sampai C pada baris 1
                $event->sheet->getDelegate()->mergeCells('A1:L3');
                
                // Menambahkan judul ke tengah-tengah sel yang digabungkan
                $event->sheet->setCellValue('A1', 'Data Siswa SMA/SMK Triguna Utama'.chr(10).'Excel ini berisi data siswa dari kelas '.$this->namaKelas.' SMA/SMK Triguna Utama');
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
        $sheet->getColumnDimension('H')->setWidth(20);
        $sheet->getColumnDimension('I')->setWidth(14);
        $sheet->getColumnDimension('J')->setWidth(14);
        $sheet->getColumnDimension('K')->setWidth(20);
        $sheet->getColumnDimension('L')->setWidth(20);
        return [
            4    => ['font' => ['bold' => true]],
        ];
    }

    public function startCell(): string
    {
        return 'A4';
    }
}
