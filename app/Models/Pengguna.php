<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pengguna';

    protected $fillable = [
        'nama_pengguna',
        'email',
        'password_hash',
        'role',
        'status',
        'verifikasi_admin',
        'remember_token',
    ];

    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    // Role constants
    const ROLE_CALON_SISWA = 'calon_siswa';
    const ROLE_ADMIN_PANITIA = 'admin_panitia';
    const ROLE_VERIFIKATOR = 'verifikator_administrasi';
    const ROLE_KEUANGAN = 'keuangan';
    const ROLE_KEPALA_SEKOLAH = 'kepala_sekolah';

    // Status constants
    const STATUS_AKTIF = 'aktif';
    const STATUS_NONAKTIF = 'nonaktif';

    public function isCalon()
    {
        return $this->role === self::ROLE_CALON_SISWA;
    }

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN_PANITIA;
    }

    public function isVerifikator()
    {
        return $this->role === self::ROLE_VERIFIKATOR;
    }

    public function isKeuangan()
    {
        return $this->role === self::ROLE_KEUANGAN;
    }

    public function isKepalaSekolah()
    {
        return $this->role === self::ROLE_KEPALA_SEKOLAH;
    }

    public function isAktif()
    {
        return $this->status === self::STATUS_AKTIF;
    }
}