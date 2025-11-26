<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tagihan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftar_id')->constrained('pendaftars')->onDelete('cascade');
            $table->string('nomor_tagihan')->unique();
            $table->decimal('jumlah', 10, 2);
            $table->text('keterangan')->nullable();
            $table->enum('status', ['belum_bayar', 'lunas'])->default('belum_bayar');
            $table->date('tanggal_jatuh_tempo');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tagihan');
    }
};