<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Status Pendaftaran PPDB</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: {{ $status === 'diterima' ? '#28a745' : '#dc3545' }}; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background: #f8f9fa; }
        .info-box { background: white; padding: 15px; margin: 10px 0; border-left: 4px solid {{ $status === 'diterima' ? '#28a745' : '#dc3545' }}; }
        .status-badge { 
            display: inline-block; 
            padding: 8px 16px; 
            border-radius: 20px; 
            color: white; 
            font-weight: bold;
            background: {{ $status === 'diterima' ? '#28a745' : '#dc3545' }};
        }
        .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>SMK Bakti Nusantara 666</h1>
            <p>Pemberitahuan Status Pendaftaran PPDB 2026/2027</p>
        </div>
        
        <div class="content">
            @if($status === 'diterima')
                <h2>🎉 Selamat! Anda Diterima!</h2>
                <p>Kepada <strong>{{ $pendaftar->nama_lengkap }}</strong>,</p>
                <p>Kami dengan senang hati memberitahukan bahwa Anda telah <span class="status-badge">DITERIMA</span> sebagai siswa baru di SMK Bakti Nusantara 666.</p>
            @else
                <h2>Pemberitahuan Status Pendaftaran</h2>
                <p>Kepada <strong>{{ $pendaftar->nama_lengkap }}</strong>,</p>
                <p>Status pendaftaran Anda: <span class="status-badge">{{ strtoupper($status) }}</span></p>
            @endif
            
            <div class="info-box">
                <h3>Detail Pendaftaran:</h3>
                <p><strong>Nama:</strong> {{ $pendaftar->nama_lengkap }}</p>
                <p><strong>NISN:</strong> {{ $pendaftar->nisn }}</p>
                <p><strong>Jurusan:</strong> {{ $pendaftar->jurusan_pilihan }}</p>
                <p><strong>Status:</strong> {{ ucfirst($status) }}</p>
            </div>
            
            @if($keterangan)
                <div class="info-box">
                    <h3>Keterangan:</h3>
                    <p>{{ $keterangan }}</p>
                </div>
            @endif
            
            @if($status === 'diterima')
                <p><strong>Langkah Selanjutnya:</strong></p>
                <ul>
                    <li>Lakukan daftar ulang sesuai jadwal yang ditentukan</li>
                    <li>Siapkan dokumen asli yang diperlukan</li>
                    <li>Datang ke sekolah untuk verifikasi dokumen</li>
                    <li>Lakukan pembayaran biaya pendaftaran</li>
                </ul>
            @endif
            
            <p>Untuk informasi lebih lanjut, silakan hubungi sekolah atau kunjungi website resmi kami.</p>
        </div>
        
        <div class="footer">
            <p>&copy; 2024 SMK Bakti Nusantara 666. Semua hak dilindungi.</p>
        </div>
    </div>
</body>
</html>