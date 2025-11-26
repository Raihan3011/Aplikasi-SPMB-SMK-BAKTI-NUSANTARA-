<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $table = 'tagihan';
    
    protected $fillable = [
        'pendaftar_id',
        'nomor_tagihan',
        'jumlah',
        'keterangan',
        'status',
        'tanggal_jatuh_tempo'
    ];

    protected $casts = [
        'tanggal_jatuh_tempo' => 'date',
        'jumlah' => 'decimal:2'
    ];

    public function pendaftar()
    {
        return $this->belongsTo(Pendaftar::class);
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function generateNomorTagihan()
    {
        $tahun = date('Y');
        $bulan = date('m');
        $lastTagihan = self::whereYear('created_at', $tahun)
                          ->whereMonth('created_at', $bulan)
                          ->orderBy('id', 'desc')
                          ->first();
        
        $urutan = $lastTagihan ? (int)substr($lastTagihan->nomor_tagihan, -4) + 1 : 1;
        
        return 'TGH' . $tahun . $bulan . str_pad($urutan, 4, '0', STR_PAD_LEFT);
    }
}