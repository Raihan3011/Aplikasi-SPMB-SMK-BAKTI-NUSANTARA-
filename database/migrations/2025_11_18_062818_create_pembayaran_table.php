<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tagihan_id')->constrained('tagihan')->onDelete('cascade');
            $table->string('bukti_pembayaran')->nullable();
            $table->decimal('jumlah_bayar', 10, 2);
            $table->date('tanggal_bayar');
            $table->string('metode_pembayaran');
            $table->text('keterangan')->nullable();
            $table->enum('status_verifikasi', ['pending', 'verified', 'rejected'])->default('pending');
            $table->text('catatan_verifikasi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};