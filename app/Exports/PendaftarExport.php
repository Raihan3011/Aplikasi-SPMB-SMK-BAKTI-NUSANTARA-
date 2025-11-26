<?php

namespace App\Exports;

use App\Models\Pendaftar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PendaftarExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Pendaftar::query();
        
        if (isset($this->filters['status']) && $this->filters['status']) {
            $query->where('status_verifikasi', $this->filters['status']);
        }
        
        if (isset($this->filters['jurusan']) && $this->filters['jurusan']) {
            $query->where('jurusan_pilihan', $this->filters['jurusan']);
        }
        
        return $query->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Lengkap',
            'NISN',
            'Email',
            'No. Telepon',
            'Jurusan Pilihan',
            'Asal Sekolah',
            'Status Verifikasi',
            'Tanggal Daftar'
        ];
    }

    public function map($pendaftar): array
    {
        static $no = 1;
        
        $statusMap = [
            'pending' => 'Pending',
            'verified' => 'Terverifikasi', 
            'rejected' => 'Ditolak'
        ];
        
        return [
            $no++,
            $pendaftar->nama_lengkap ?? '-',
            $pendaftar->nisn ?? '-',
            $pendaftar->email ?? '-',
            $pendaftar->no_telepon ?? '-',
            $pendaftar->jurusan_pilihan ?? '-',
            $pendaftar->asal_sekolah ?? '-',
            $statusMap[$pendaftar->status_verifikasi] ?? 'Pending',
            $pendaftar->created_at ? $pendaftar->created_at->format('d/m/Y H:i') : '-'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}