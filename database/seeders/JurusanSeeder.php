<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        $jurusans = [
            [
                'kode_jurusan' => 'RPL',
                'nama_jurusan' => 'Rekayasa Perangkat Lunak',
            ],
            [
                'kode_jurusan' => 'DKV',
                'nama_jurusan' => 'Desain Komunikasi Visual',
            ],
            [
                'kode_jurusan' => 'AKL',
                'nama_jurusan' => 'Akuntansi dan Keuangan Lembaga',
            ],
            [
                'kode_jurusan' => 'ANI',
                'nama_jurusan' => 'Animasi',
            ],
            [
                'kode_jurusan' => 'BDP',
                'nama_jurusan' => 'Bisnis Daring dan Pemasaran',
            ],
        ];

        foreach ($jurusans as $jurusan) {
            Jurusan::updateOrCreate(
                ['kode_jurusan' => $jurusan['kode_jurusan']],
                $jurusan
            );
        }
    }
}