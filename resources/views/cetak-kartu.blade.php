<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Pendaftaran - {{ $pendaftar->nama_lengkap }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        @media print {
            body { margin: 0; background: white !important; }
            .no-print { display: none !important; }
            .kartu { box-shadow: none !important; border: 2px solid #000 !important; }
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 2rem;
        }
        
        .kartu-container {
            max-width: 400px;
            width: 100%;
            position: relative;
        }
        
        .kartu {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            position: relative;
        }
        
        .kartu::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 140px;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            z-index: 1;
        }
        
        .kartu-header {
            position: relative;
            z-index: 2;
            padding: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            color: white;
        }
        
        .foto-section {
            flex-shrink: 0;
        }
        
        .foto-siswa {
            width: 90px;
            height: 110px;
            object-fit: cover;
            border-radius: 8px;
            border: 3px solid white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }
        
        .foto-placeholder {
            width: 90px;
            height: 110px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            border: 3px solid white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.7rem;
            text-align: center;
        }
        
        .header-info {
            flex: 1;
            text-align: center;
        }
        
        .kartu-body {
            padding: 1.5rem;
            color: #2d3748;
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.95);
            margin-top: -10px;
        }
        
        .logo {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            margin-bottom: 0.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        
        .school-name {
            font-size: 0.85rem;
            font-weight: 700;
            margin: 0;
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        .school-subtitle {
            font-size: 0.75rem;
            opacity: 0.9;
            margin: 0;
            font-weight: 400;
        }
        
        .kartu-title {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: white;
            padding: 0.75rem;
            border-radius: 12px;
            text-align: center;
            margin-bottom: 1rem;
            box-shadow: 0 3px 8px rgba(30, 60, 114, 0.3);
        }
        
        .kartu-title h6 {
            margin: 0;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .kartu-title small {
            opacity: 0.9;
            font-weight: 400;
        }
        
        .data-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.6rem;
            padding: 0.4rem 0.6rem;
            background: rgba(30, 60, 114, 0.05);
            border-radius: 6px;
            border-left: 3px solid #1e3c72;
        }
        
        .data-label {
            font-size: 0.75rem;
            color: #4a5568;
            font-weight: 500;
            min-width: 35%;
        }
        
        .data-value {
            font-size: 0.8rem;
            font-weight: 600;
            color: #2d3748;
            text-align: right;
            max-width: 65%;
            word-wrap: break-word;
        }
        
        .kartu-footer {
            background: linear-gradient(135deg, #f7fafc, #edf2f7);
            padding: 1rem;
            text-align: center;
            font-size: 0.75rem;
            color: #4a5568;
            border-top: 1px solid rgba(30, 60, 114, 0.1);
        }
        
        .kartu-footer p {
            margin: 0;
            font-weight: 500;
        }
        
        .kartu-footer small {
            color: #718096;
            font-weight: 400;
        }
        
        .action-buttons {
            position: fixed;
            top: 30px;
            right: 30px;
            z-index: 1000;
            display: flex;
            gap: 10px;
        }
        
        .print-btn, .download-btn {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            border: none;
            border-radius: 50px;
            padding: 12px 20px;
            color: white;
            font-weight: 600;
            box-shadow: 0 8px 20px rgba(30, 60, 114, 0.3);
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .download-btn {
            background: linear-gradient(135deg, #059669, #10b981);
        }
        
        .print-btn:hover, .download-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(30, 60, 114, 0.4);
        }
        
        .kartu-container::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            z-index: -1;
        }
        
        .kartu-container::after {
            content: '';
            position: absolute;
            bottom: -30px;
            left: -30px;
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            z-index: -1;
        }
    </style>
</head>
<body>
    <div class="action-buttons no-print">
        <button onclick="window.print()" class="btn print-btn">
            <i class="fas fa-print me-2"></i>Cetak Kartu
        </button>
        <button onclick="downloadCard()" class="btn download-btn">
            <i class="fas fa-download me-2"></i>Simpan Gambar
        </button>
    </div>
    
    <div class="kartu-container">
        <div class="card kartu">
            <div class="kartu-header">
                <div class="foto-section">
                    @if($pendaftar->dokumen && $pendaftar->dokumen->foto_siswa)
                        <img src="{{ asset('uploads/dokumen/' . $pendaftar->dokumen->foto_siswa) }}" alt="Foto {{ $pendaftar->nama_lengkap }}" class="foto-siswa">
                    @else
                        <div class="foto-placeholder">
                            <span>Foto<br>Belum<br>Upload</span>
                        </div>
                    @endif
                </div>
                <div class="header-info">
                    <img src="{{ asset('images/baknus.png') }}" alt="Logo" class="logo">
                    <h6 class="school-name">SMK BAKTI NUSANTARA 666</h6>
                    <p class="school-subtitle">Jl. Pendidikan No. 666, Jakarta Selatan</p>
                </div>
            </div>
            
            <div class="kartu-body">
                <div class="kartu-title">
                    <h6>KARTU PENDAFTARAN PPDB</h6>
                    <small>Tahun Ajaran 2026/2027</small>
                </div>
                
                <div class="data-row">
                    <span class="data-label">Nama Lengkap</span>
                    <span class="data-value">{{ $pendaftar->nama_lengkap }}</span>
                </div>
                
                <div class="data-row">
                    <span class="data-label">NISN</span>
                    <span class="data-value">{{ $pendaftar->nisn }}</span>
                </div>
                
                <div class="data-row">
                    <span class="data-label">Jurusan Pilihan</span>
                    <span class="data-value">{{ $pendaftar->jurusan->nama_jurusan ?? $pendaftar->jurusan_pilihan }}</span>
                </div>
                
                <div class="data-row">
                    <span class="data-label">Asal Sekolah</span>
                    <span class="data-value">{{ $pendaftar->asal_sekolah }}</span>
                </div>
                
                <div class="data-row">
                    <span class="data-label">No. Telepon</span>
                    <span class="data-value">{{ $pendaftar->no_telepon }}</span>
                </div>
                
                <div class="data-row">
                    <span class="data-label">Tanggal Daftar</span>
                    <span class="data-value">{{ $pendaftar->created_at->format('d/m/Y') }}</span>
                </div>
                
                <div class="data-row">
                    <span class="data-label">No. Registrasi</span>
                    <span class="data-value">REG-{{ str_pad($pendaftar->id, 4, '0', STR_PAD_LEFT) }}</span>
                </div>
                
                <div class="data-row">
                    <span class="data-label">Status</span>
                    <span class="data-value" style="color: {{ $pendaftar->status_verifikasi === 'verified' ? '#10b981' : ($pendaftar->status_verifikasi === 'rejected' ? '#ef4444' : '#f59e0b') }}">
                        {{ $pendaftar->status_verifikasi === 'verified' ? 'Terverifikasi' : ($pendaftar->status_verifikasi === 'rejected' ? 'Ditolak' : 'Menunggu Verifikasi') }}
                    </span>
                </div>
            </div>
            
            <div class="kartu-footer">
                <p>Kartu ini adalah bukti pendaftaran resmi</p>
                <small>Harap dibawa saat tes masuk</small>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        function downloadCard() {
            const card = document.querySelector('.kartu');
            const buttons = document.querySelector('.action-buttons');
            
            // Hide buttons temporarily
            buttons.style.display = 'none';
            
            html2canvas(card, {
                scale: 2,
                backgroundColor: null,
                useCORS: true,
                allowTaint: true
            }).then(canvas => {
                // Show buttons again
                buttons.style.display = 'flex';
                
                // Create download link
                const link = document.createElement('a');
                link.download = 'kartu-pendaftaran-{{ $pendaftar->nama_lengkap }}.png';
                link.href = canvas.toDataURL();
                link.click();
            }).catch(error => {
                buttons.style.display = 'flex';
                alert('Gagal menyimpan gambar. Silakan coba lagi.');
                console.error('Error:', error);
            });
        }
    </script>
</body>
</html>