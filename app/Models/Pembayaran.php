<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    
    protected $fillable = [
        'tagihan_id',
        'bukti_pembayaran',
        'jumlah_bayar',
        'tanggal_bayar',
        'metode_pembayaran',
        'keterangan',
        'status_verifikasi',
        'catatan_verifikasi'
    ];

    protected $casts = [
        'tanggal_bayar' => 'date',
        'jumlah_bayar' => 'decimal:2'
    ];

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class);
    }
}