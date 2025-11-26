# Fitur Export Excel - Dashboard Verifikator

## Deskripsi
Fitur export Excel memungkinkan verifikator untuk mengunduh data pendaftar dalam format Excel (.xlsx) dengan filter yang dapat disesuaikan.

## Fitur yang Tersedia

### 1. Export Excel
- **Tombol**: "Export Excel" di dashboard verifikator
- **Format**: File .xlsx
- **Nama File**: `data-pendaftar-YYYY-MM-DD-HH-mm-ss.xlsx`
- **Filter**: Mendukung filter berdasarkan jurusan dan status verifikasi

### 2. Print
- **Tombol**: "Print" di dashboard verifikator  
- **Fungsi**: Mencetak halaman dengan styling yang dioptimalkan untuk print
- **Elemen yang disembunyikan**: Tombol, filter, dan elemen navigasi

## Kolom Data Export

1. **No** - Nomor urut
2. **Nama Lengkap** - Nama lengkap pendaftar
3. **NISN** - Nomor Induk Siswa Nasional
4. **Email** - Alamat email pendaftar
5. **No. Telepon** - Nomor telepon pendaftar
6. **Jurusan Pilihan** - Kode jurusan yang dipilih
7. **Asal Sekolah** - Nama sekolah asal
8. **Status Verifikasi** - Status (Pending/Terverifikasi/Ditolak)
9. **Tanggal Daftar** - Tanggal dan waktu pendaftaran

## Cara Penggunaan

### Export dengan Filter
1. Pilih filter jurusan (opsional)
2. Pilih filter status (opsional)
3. Klik tombol "Export Excel"
4. File akan otomatis terunduh

### Export Semua Data
1. Pastikan semua filter kosong (pilih "Semua Jurusan" dan "Semua Status")
2. Klik tombol "Export Excel"
3. File akan berisi semua data pendaftar

### Print Data
1. Atur filter sesuai kebutuhan
2. Klik tombol "Print"
3. Dialog print browser akan muncul

## File Terkait

- **Export Class**: `app/Exports/PendaftarExport.php`
- **Route**: `/export/pendaftar` (GET)
- **View**: `resources/views/verifikator/dashboard.blade.php`
- **Config**: `config/excel.php`

## Dependencies

- **Laravel Excel**: `maatwebsite/excel ^3.1`
- **PhpSpreadsheet**: Otomatis terinstall dengan Laravel Excel

## Troubleshooting

### Error "Class not found"
```bash
composer dump-autoload
```

### Error "Excel config not found"
```bash
php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider" --tag=config
```

### Memory limit untuk file besar
Tambahkan di `.env`:
```
MEMORY_LIMIT=512M
```

## Keamanan

- Route dilindungi dengan middleware session
- Hanya user dengan role `verifikator_administrasi` yang dapat mengakses
- Data yang diekspor sesuai dengan filter yang diterapkan