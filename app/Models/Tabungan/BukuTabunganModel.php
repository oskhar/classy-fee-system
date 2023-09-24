<?php

namespace App\Models\Tabungan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BukuTabunganModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Mengatur nama tabel database yang dituju.
     * 
     * @var string
     */
    protected $table = 'tb_buku_tabungan';

    /**
     * Memperbolehkan penggunaan timestamps.
     * 
     * @var boolean
     */
    public $timestamps = true;
    protected $primaryKey = 'id_buku_tabungan';

    /**
     * Atribut atau kolom yang boleh diubah.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_buku_tabungan',
        'nomor_rekening',
        'debit',
        'kredit',
        'saldo',
        'tanggal',
    ];

    /**
     * Atribut atau kolom yang boleh diubah.
     *
     * @var array<int, string>
     */
    protected $dates = [
        'deleted_at',
    ];
}
