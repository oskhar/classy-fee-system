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
        Schema::create('tb_buku_tabungan', function (Blueprint $table) {
            $table->id('id_buku_tabungan');
            $table->string('nomor_rekening');
            $table->foreign('nomor_rekening')->references('nomor_rekening')->on('tb_rekening')->onDelete('cascade')->onUpdate('cascade');

            $table->bigInteger('debit');
            $table->bigInteger('kredit');
            $table->bigInteger('saldo');

            $table->date('tanggal');

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
        Schema::dropIfExists('tb_buku_tabungan');
    }
};
