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
        Schema::create('tb_transaksi_tabungan', function (Blueprint $table) {
            $table->string('id_transaksi_tabungan')->primary();

            $table->string('id_administrator');
            $table->foreign('id_administrator')->references('id_administrator')->on('tb_administrator')->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('nomor_rekening');
            $table->foreign('nomor_rekening')->references('nomor_rekening')->on('tb_rekening')->onDelete('cascade')->onUpdate('cascade');

            $table->string('jenis_transaksi');
            $table->date('tanggal_transaksi');
            $table->bigInteger('nominal');


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
        Schema::dropIfExists('tb_transaksi_tabungan');
    }
};
