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
        Schema::create('tb_siswa', function (Blueprint $table) {
            $table->string('nis')->primary();
            $table->string('nisn')->unique();

            $table->string('id_wali_siswa');
            $table->foreign('id_wali_siswa')->references('id_wali_siswa')->on('tb_wali_siswa')->onDelete('cascade');
            
            $table->string('nama_siswa');
            $table->string('jenis_kelamin');
            $table->string('agama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('alamat');

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
        Schema::dropIfExists('tb_siswa');
    }
};
