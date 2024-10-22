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
        Schema::create('master_data_siswa', function (Blueprint $table) {
            $table->string('nis', 30)->nullable();
            $table->foreign('nis')->references('nis')->on('tb_siswa')->onDelete('cascade')->onUpdate('cascade');

            $table->string('nisn', 30)->nullable();
            $table->foreign('nisn')->references('nisn')->on('tb_siswa')->onDelete('cascade')->onUpdate('cascade');

            $table->string('id_kelas', 10)->nullable();
            $table->foreign('id_kelas')->references('id_kelas')->on('tb_kelas')->onDelete('cascade')->onUpdate('cascade');

            $table->string('id_tahun_ajar', 10)->nullable();
            $table->foreign('id_tahun_ajar')->references('id_tahun_ajar')->on('tb_tahun_ajar')->onDelete('cascade')->onUpdate('cascade');

            $table->string('status_data')->default('Aktif');

            $table->timestamps();
            $table->softDeletes();
            
            $table->primary(['nis', 'nisn', 'id_kelas', 'id_tahun_ajar']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_data_siswa');
    }
};
