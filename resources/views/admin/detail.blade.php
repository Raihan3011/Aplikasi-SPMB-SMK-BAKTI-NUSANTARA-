@extends('layouts.app')

@section('title', 'Detail Pendaftar - SMK Bakti Nusantara 666')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header Card -->
            <div class="modern-detail-card mb-4">
                <div class="detail-header">
                    <div class="d-flex align-items-center">
                        <div class="student-avatar me-3">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div>
                            <h3 class="mb-1">{{ $pendaftar->nama_lengkap }}</h3>
                            <div class="student-meta">
                                <span class="me-3"><i class="fas fa-id-card me-1"></i>{{ $pendaftar->nisn }}</span>
                                <span class="jurusan-detail-badge">{{ $jurusan ? $jurusan->nama_jurusan : $pendaftar->jurusan_pilihan }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="detail-actions">
                        <a href="{{ route('cetak.kartu', $pendaftar->id) }}" target="_blank" class="btn btn-outline-light me-2">
                            <i class="fas fa-print me-1"></i>Cetak Kartu
                        </a>
                        <a href="{{ route('admin.dokumen', $pendaftar->id) }}" class="btn btn-outline-light me-2">
                            <i class="fas fa-folder-open me-1"></i>Lihat Dokumen
                        </a>
                        <a href="{{ route('admin.dashboard') }}" class="btn-modern-back">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>

            <!-- Data Cards -->
            <div class="row g-4">
                <!-- Data Siswa -->
                <div class="col-lg-6">
                    <div class="modern-detail-card">
                        <div class="detail-section-header">
                            <i class="fas fa-user me-2"></i>Data Siswa
                        </div>
                        <div class="detail-content">
                            <div class="detail-item">
                                <div class="detail-label">Nama Lengkap</div>
                                <div class="detail-value">{{ $pendaftar->nama_lengkap }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">NISN</div>
                                <div class="detail-value">{{ $pendaftar->nisn }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Tempat, Tanggal Lahir</div>
                                <div class="detail-value">{{ $pendaftar->tempat_lahir }}, {{ \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->format('d F Y') }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Jenis Kelamin</div>
                                <div class="detail-value">{{ $pendaftar->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Agama</div>
                                <div class="detail-value">{{ $pendaftar->agama }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Alamat</div>
                                <div class="detail-value">{{ $pendaftar->alamat }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Kontak & Sekolah -->
                <div class="col-lg-6">
                    <div class="modern-detail-card">
                        <div class="detail-section-header">
                            <i class="fas fa-phone me-2"></i>Kontak & Sekolah
                        </div>
                        <div class="detail-content">
                            <div class="detail-item">
                                <div class="detail-label">No. Telepon</div>
                                <div class="detail-value">{{ $pendaftar->no_telepon }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Email</div>
                                <div class="detail-value">{{ $pendaftar->email ?: '-' }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Asal Sekolah</div>
                                <div class="detail-value">{{ $pendaftar->asal_sekolah }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Jurusan Pilihan</div>
                                <div class="detail-value">{{ $jurusan ? $jurusan->nama_jurusan : $pendaftar->jurusan_pilihan }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Orang Tua -->
                <div class="col-lg-6">
                    <div class="modern-detail-card">
                        <div class="detail-section-header">
                            <i class="fas fa-users me-2"></i>Data Orang Tua
                        </div>
                        <div class="detail-content">
                            <div class="detail-item">
                                <div class="detail-label">Nama Orang Tua/Wali</div>
                                <div class="detail-value">{{ $pendaftar->nama_orangtua }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Pekerjaan</div>
                                <div class="detail-value">{{ $pendaftar->pekerjaan_orangtua }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">No. Telepon</div>
                                <div class="detail-value">{{ $pendaftar->no_telepon_orangtua }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Pendaftaran -->
                <div class="col-lg-6">
                    <div class="modern-detail-card">
                        <div class="detail-section-header">
                            <i class="fas fa-calendar me-2"></i>Info Pendaftaran
                        </div>
                        <div class="detail-content">
                            <div class="detail-item">
                                <div class="detail-label">Tanggal Pendaftaran</div>
                                <div class="detail-value">{{ $pendaftar->created_at->format('d F Y') }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Waktu Pendaftaran</div>
                                <div class="detail-value">{{ $pendaftar->created_at->format('H:i') }} WIB</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Status</div>
                                <div class="detail-value"><span class="status-badge">Terdaftar</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.modern-detail-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    border: 1px solid #f1f3f4;
    overflow: hidden;
}

.detail-header {
    background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
    color: white;
    padding: 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.student-avatar {
    width: 60px;
    height: 60px;
    background: rgba(255,255,255,0.2);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}

.student-meta {
    opacity: 0.9;
    font-size: 14px;
}

.jurusan-detail-badge {
    background: rgba(255,255,255,0.2);
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 500;
}

.btn-modern-back {
    background: rgba(255,255,255,0.2);
    color: white;
    padding: 10px 20px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-modern-back:hover {
    background: rgba(255,255,255,0.3);
    color: white;
    transform: translateY(-2px);
}

.detail-section-header {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    color: white;
    padding: 16px 24px;
    font-weight: 600;
    font-size: 16px;
}

.detail-content {
    padding: 24px;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 12px 0;
    border-bottom: 1px solid #f1f3f4;
}

.detail-item:last-child {
    border-bottom: none;
}

.detail-label {
    font-weight: 500;
    color: #718096;
    font-size: 14px;
    min-width: 140px;
}

.detail-value {
    color: #2d3748;
    font-weight: 500;
    text-align: right;
    flex: 1;
}

.status-badge {
    background: linear-gradient(135deg, #48bb78, #38a169);
    color: white;
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
}

@media (max-width: 768px) {
    .detail-header {
        flex-direction: column;
        text-align: center;
        gap: 16px;
    }
    
    .detail-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 4px;
    }
    
    .detail-value {
        text-align: left;
    }
}
</style>
@endpush