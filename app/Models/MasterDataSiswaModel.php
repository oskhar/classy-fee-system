<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterDataSiswaModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Mengatur nama tabel database yang dituju.
     * 
     * @var string
     */
    protected $table = 'master_data_siswa';

    /**
     * Memperbolehkan penggunaan timestamps.
     * 
     * @var boolean
     */
    public $timestamps = true;
    protected $primaryKey = ['nis', 'nisn', 'id_kelas', 'id_tahun_ajar'];
    protected $keyType = "string";
    public $incrementing = false;

    /**
     * Atribut atau kolom yang boleh diubah.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nis',
        'nisn',
        'id_kelas',
        'id_tahun_ajar',
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
