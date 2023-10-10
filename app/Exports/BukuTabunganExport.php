<?php

namespace App\Exports;

use App\Models\SiswaModel;
use App\Models\Tabungan\BukuTabunganModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BukuTabunganExport implements FromCollection, WithHeadings, WithEvents, WithCustomStartCell, WithStyles
{
    protected $nomorRekening;

    public function __construct ($objectParam)
    {
    
        $this->nomorRekening = $objectParam['nomor_rekening'];
    
    }
    public function headings(): array
    {
        // Menyusun baris judul Anda
        return [
            'Nomor Rekening',
            'Debit',
            'Kredit',
            'Saldo',
            'Tanggal',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return BukuTabunganModel::select(
            'nomor_rekening',
            'debit',
            'kredit',
            'saldo',
            'tanggal',
        )->where('nomor_rekening', $this->nomorRekening)->get();
    }
    
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Menggabungkan kolom A sampai C pada baris 1
                $event->sheet->getDelegate()->mergeCells('A1:E3');
                
                // Menambahkan judul ke tengah-tengah sel yang digabungkan
                $event->sheet->setCellValue('A1', 'Buku Tabungan '.$this->nomorRekening.chr(10).'Excel ini merupakan file data untuk di-export-kan dari web Sekolah Triguna');
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
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(20);
        return [
            4    => ['font' => ['bold' => true]],
        ];
    }

    public function startCell(): string
    {
        return 'A4';
    }
}
