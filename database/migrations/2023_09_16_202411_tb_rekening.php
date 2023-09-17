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
        Schema::create('tb_rekening', function (Blueprint $table) {
            $table->string('nomor_rekening')->primary();

            $table->string('nis');
            $table->foreign('nis')->references('nis')->on('master_data_siswa')->onDelete('cascade');
            $table->date('tanggal_buka');
            $table->date('tanggal_tutup');
            $table->bigInteger('setoran_awal');
            $table->bigInteger('saldo');


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
        Schema::dropIfExists('tb_rekening');
    }
};
