<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabel yang akan dibuat saat migration
        Schema::create('tb_wali_siswa', function (Blueprint $table) {
            $table->string('id_wali_siswa')->primary();

            $table->string('nama_ayah');
            $table->string('pekerjaan_ayah');
            $table->string('penghasilan_ayah');
            
            $table->string('nama_ibu');
            $table->string('pekerjaan_ibu');
            $table->string('pnghasilann_ibu');

            $table->string('telp_rumah');

            $table->string('status_data')->default('Aktif');

            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
