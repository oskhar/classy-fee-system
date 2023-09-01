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

            $table->string('nama_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->integer('penghasilan_ayah')->nullable();
            
            $table->string('nama_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->integer('penghasilan_ibu')->nullable();

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
        // Data yang akan dihapus saat migration:rollback
        Schema::dropIfExists('tb_wali_siswa');
    }
};
