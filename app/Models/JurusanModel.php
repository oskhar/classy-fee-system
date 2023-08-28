<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JurusanModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Mengatur nama tabel database yang dituju.
     * 
     * @var string
     * @var string
     * @var string
     */
    protected $table = 'tb_jurusan';
    protected $primaryKey = 'id_jurusan';
    protected $keyType = "string";

    /**
     * Memperbolehkan penggunaan timestamps.
     * 
     * @var boolean
     */
    public $timestamps = true;

    /**
     * Atribut atau kolom yang boleh diubah.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_jurusan',
        'nama_jurusan',
        'singkatan',
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