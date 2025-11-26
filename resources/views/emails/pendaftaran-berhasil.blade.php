<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Konfirmasi Pendaftaran PPDB</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #28a745; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background: #f8f9fa; }
        .info-box { background: white; padding: 15px; margin: 10px 0; border-left: 4px solid #28a745; }
        .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>SMK Bakti Nusantara 666</h1>
            <p>Konfirmasi Pendaftaran PPDB 2026/2027</p>
        </div>
        
        <div class="content">
            <h2>Selamat! Pendaftaran Anda Berhasil</h2>
            <p>Terima kasih <strong>{{ $pendaftar->nama_lengkap }}</strong>, pendaftaran PPDB Anda telah berhasil disubmit.</p>
            
            <div class="info-box">
                <h3>Detail Pendaftaran:</h3>
                <p><strong>Nama:</strong> {{ $pendaftar->nama_lengkap }}</p>
                <p><strong>NISN:</strong> {{ $pendaftar->nisn }}</p>
                <p><strong>Jurusan Pilihan:</strong> {{ $pendaftar->jurusan_pilihan }}</p>
                <p><strong>Tanggal Daftar:</strong> {{ $pendaftar->created_at->format('d/m/Y H:i') }}</p>
            </div>
            
            <p><strong>Langkah Selanjutnya:</strong></p>
            <ul>
                <li>Tunggu pengumuman hasil seleksi</li>
                <li>Pantau website sekolah untuk informasi terbaru</li>
                <li>Siapkan dokumen yang diperlukan</li>
            </ul>
            
            <p>Untuk informasi lebih lanjut, hubungi sekolah di nomor telepon yang tersedia.</p>
        </div>
        
        <div class="footer">
            <p>&copy; 2024 SMK Bakti Nusantara 666. Semua hak dilindungi.</p>
        </div>
    </div>
</body>
</html>