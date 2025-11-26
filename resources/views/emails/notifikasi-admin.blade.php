<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pendaftar Baru PPDB</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #dc3545; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background: #f8f9fa; }
        .info-box { background: white; padding: 15px; margin: 10px 0; border-left: 4px solid #dc3545; }
        .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>SMK Bakti Nusantara 666</h1>
            <p>Notifikasi Pendaftar Baru</p>
        </div>
        
        <div class="content">
            <h2>Ada Pendaftar Baru!</h2>
            <p>Seorang calon siswa baru telah mendaftar melalui sistem PPDB online.</p>
            
            <div class="info-box">
                <h3>Detail Pendaftar:</h3>
                <p><strong>Nama:</strong> {{ $pendaftar->nama_lengkap }}</p>
                <p><strong>NISN:</strong> {{ $pendaftar->nisn }}</p>
                <p><strong>Jurusan Pilihan:</strong> {{ $pendaftar->jurusan_pilihan }}</p>
                <p><strong>Email:</strong> {{ $pendaftar->email ?? 'Tidak ada' }}</p>
                <p><strong>No. Telepon:</strong> {{ $pendaftar->no_telepon }}</p>
                <p><strong>Nama Orang Tua:</strong> {{ $pendaftar->nama_orangtua }}</p>
                <p><strong>Tanggal Daftar:</strong> {{ $pendaftar->created_at->format('d/m/Y H:i') }}</p>
            </div>
            
            <p>Silakan login ke dashboard admin untuk melihat detail lengkap dan mengelola data pendaftar.</p>
        </div>
        
        <div class="footer">
            <p>&copy; 2024 SMK Bakti Nusantara 666. Sistem PPDB Online.</p>
        </div>
    </div>
</body>
</html>