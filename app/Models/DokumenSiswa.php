<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenSiswa extends Model
{
    protected $table = 'dokumen_siswa';
    
    protected $fillable = [
        'pendaftar_id',
        'foto_siswa',
        'kartu_keluarga', 
        'akta_kelahiran',
        'ijazah_smp',
        'surat_sehat',
        'surat_kelakuan'
    ];
    
    public function pendaftar()
    {
        return $this->belongsTo(Pendaftar::class);
    }
}
