<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;

class PenggunaSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'nama_pengguna' => 'Admin Panitia',
                'email' => 'admin@smkbaktinusantara666.sch.id',
                'password_hash' => Hash::make('admin123'),
                'role' => 'admin_panitia',
                'status' => 'aktif',
            ],
            [
                'nama_pengguna' => 'Verifikator Admin',
                'email' => 'verifikator@smkbaktinusantara666.sch.id',
                'password_hash' => Hash::make('verif123'),
                'role' => 'verifikator_administrasi',
                'status' => 'aktif',
            ],
            [
                'nama_pengguna' => 'Staff Keuangan',
                'email' => 'keuangan@smkbaktinusantara666.sch.id',
                'password_hash' => Hash::make('keuangan123'),
                'role' => 'keuangan',
                'status' => 'aktif',
            ],
            [
                'nama_pengguna' => 'Kepala Sekolah',
                'email' => 'kepsek@smkbaktinusantara666.sch.id',
                'password_hash' => Hash::make('kepsek123'),
                'role' => 'kepala_sekolah',
                'status' => 'aktif',
            ],
        ];

        foreach ($users as $user) {
            Pengguna::create($user);
        }
    }
}