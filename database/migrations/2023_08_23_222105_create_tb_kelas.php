<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabel yang akan dibuat saat migration
        Schema::create('tb_kelas', function (Blueprint $table) {
            $table->string('id_kelas')->primary();

            $table->string('id_jurusan');
            $table->foreign('id_jurusan')->references('id_jurusan')->on('tb_jurusan')->onDelete('cascade');

            $table->string('nama_kelas')->unique();

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
        Schema::dropIfExists('tb_kelas');
    }
};