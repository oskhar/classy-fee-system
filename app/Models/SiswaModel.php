<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiswaModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Mengatur nama tabel database yang dituju.
     * 
     * @var string
     */
    protected $table = 'tb_siswa';

    /**
     * Memperbolehkan penggunaan timestamps.
     * 
     * @var boolean
     */
    public $timestamps = true;
    protected $primaryKey = 'nis';
    protected $keyType = "string";

    /**
     * Atribut atau kolom yang boleh diubah.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nis',
        'nisn',
        'id_wali_siswa',
        'nama',
        'jenis_kelamin',
        'agama',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'status_data',
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
