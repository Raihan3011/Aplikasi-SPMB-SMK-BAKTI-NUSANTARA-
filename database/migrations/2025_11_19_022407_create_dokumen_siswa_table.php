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
        Schema::create('dokumen_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftar_id')->constrained('pendaftars')->onDelete('cascade');
            $table->string('foto_siswa')->nullable();
            $table->string('kartu_keluarga')->nullable();
            $table->string('akta_kelahiran')->nullable();
            $table->string('ijazah_smp')->nullable();
            $table->string('skhun')->nullable();
            $table->string('surat_sehat')->nullable();
            $table->string('surat_kelakuan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_siswa');
    }
};
