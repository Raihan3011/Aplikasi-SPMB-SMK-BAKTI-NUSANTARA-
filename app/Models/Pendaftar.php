<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    protected $fillable = [
        'nama_lengkap', 'nisn', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin',
        'agama', 'alamat', 'no_telepon', 'email', 'asal_sekolah', 'jurusan_pilihan',
        'nama_orangtua', 'pekerjaan_orangtua', 'no_telepon_orangtua', 'status_verifikasi', 'password'
    ];
    
    protected $casts = [
        'no_telepon' => 'string',
        'no_telepon_orangtua' => 'string',
        'nisn' => 'string'
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_pilihan', 'kode_jurusan');
    }

    public function tagihan()
    {
        return $this->hasMany(Tagihan::class);
    }
    
    public function dokumen()
    {
        return $this->hasOne(DokumenSiswa::class);
    }
}
