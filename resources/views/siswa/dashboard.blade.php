@extends('layouts.app')

@section('title', 'Dashboard Siswa - SMK Bakti Nusantara 666')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2>Dashboard Siswa</h2>
                    <p class="text-muted mb-0">Selamat datang, {{ $siswa->nama_lengkap }}!</p>
                </div>
                <div>
                    <a href="{{ route('cetak.kartu', $siswa->id) }}" target="_blank" class="btn btn-primary btn-sm me-2">
                        <i class="fas fa-print me-1"></i>Cetak Kartu
                    </a>
                    <span class="badge bg-success fs-6 me-2">Status: Terdaftar</span>
                    <a href="{{ route('siswa.logout') }}" class="btn btn-outline-danger btn-sm">Logout</a>
                </div>
            </div>
            
            <!-- Status Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="card border-success">
                        <div class="card-body text-center">
                            <i class="fas fa-user-check fa-2x text-success mb-2"></i>
                            <h6 class="card-title">Status</h6>
                            <p class="card-text text-success fw-bold">Terdaftar</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-info">
                        <div class="card-body text-center">
                            <i class="fas fa-calendar fa-2x text-info mb-2"></i>
                            <h6 class="card-title">Tanggal Daftar</h6>
                            <p class="card-text">{{ $siswa->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-warning">
                        <div class="card-body text-center">
                            <i class="fas fa-graduation-cap fa-2x text-warning mb-2"></i>
                            <h6 class="card-title">Jurusan</h6>
                            <p class="card-text">{{ $siswa->jurusan_pilihan }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-primary">
                        <div class="card-body text-center">
                            <i class="fas fa-id-card fa-2x text-primary mb-2"></i>
                            <h6 class="card-title">NISN</h6>
                            <p class="card-text">{{ $siswa->nisn }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Detail Information -->
            <div class="row g-4">
                <!-- Data Pribadi -->
                <div class="col-lg-6">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-user me-2"></i>Data Pribadi</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%"><strong>Nama Lengkap</strong></td>
                                    <td>: {{ $siswa->nama_lengkap }}</td>
                                </tr>
                                <tr>
                                    <td><strong>NISN</strong></td>
                                    <td>: {{ $siswa->nisn }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tempat Lahir</strong></td>
                                    <td>: {{ $siswa->tempat_lahir ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Lahir</strong></td>
                                    <td>: {{ $siswa->tanggal_lahir ? date('d/m/Y', strtotime($siswa->tanggal_lahir)) : '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jenis Kelamin</strong></td>
                                    <td>: {{ $siswa->jenis_kelamin ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Agama</strong></td>
                                    <td>: {{ $siswa->agama ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Alamat</strong></td>
                                    <td>: {{ $siswa->alamat ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- Data Kontak & Orang Tua -->
                <div class="col-lg-6">
                    <div class="card shadow">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fas fa-phone me-2"></i>Data Kontak & Orang Tua</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%"><strong>No. Telepon</strong></td>
                                    <td>: {{ $siswa->no_telepon ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td>: {{ $siswa->email ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Orang Tua</strong></td>
                                    <td>: {{ $siswa->nama_orangtua ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>No. Telepon Orang Tua</strong></td>
                                    <td>: {{ $siswa->no_telepon_orangtua ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- Data Sekolah -->
                <div class="col-lg-6">
                    <div class="card shadow">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-school me-2"></i>Data Sekolah</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%"><strong>Asal Sekolah</strong></td>
                                    <td>: {{ $siswa->asal_sekolah ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jurusan Pilihan</strong></td>
                                    <td>: {{ $siswa->jurusan_pilihan }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Pendaftaran</strong></td>
                                    <td>: {{ $siswa->created_at->format('d F Y, H:i') }} WIB</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- Upload Dokumen -->
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-file-upload me-2"></i>Dokumen Persyaratan</h5>
                            <a href="{{ route('siswa.upload-dokumen') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-plus me-2"></i>Upload Dokumen
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-primary mb-3"><i class="fas fa-list-check me-2"></i>Status Dokumen</h6>
                                    @php
                                        $dokumen = $siswa->dokumen;
                                    @endphp
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <span><i class="fas fa-user-circle me-2"></i>Foto Siswa</span>
                                            @if($dokumen && $dokumen->foto_siswa)
                                                <span class="badge bg-success">Sudah Upload</span>
                                            @else
                                                <span class="badge bg-warning">Belum Upload</span>
                                            @endif
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <span><i class="fas fa-id-card me-2"></i>Kartu Keluarga</span>
                                            @if($dokumen && $dokumen->kartu_keluarga)
                                                <span class="badge bg-success">Sudah Upload</span>
                                            @else
                                                <span class="badge bg-warning">Belum Upload</span>
                                            @endif
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <span><i class="fas fa-certificate me-2"></i>Akta Kelahiran</span>
                                            @if($dokumen && $dokumen->akta_kelahiran)
                                                <span class="badge bg-success">Sudah Upload</span>
                                            @else
                                                <span class="badge bg-warning">Belum Upload</span>
                                            @endif
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <span><i class="fas fa-graduation-cap me-2"></i>Ijazah SMP</span>
                                            @if($dokumen && $dokumen->ijazah_smp)
                                                <span class="badge bg-success">Sudah Upload</span>
                                            @else
                                                <span class="badge bg-warning">Belum Upload</span>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-success mb-3"><i class="fas fa-info-circle me-2"></i>Panduan Upload</h6>
                                    <div class="alert alert-info">
                                        <ul class="mb-0 ps-3">
                                            <li>Siapkan semua dokumen dalam format digital</li>
                                            <li>Pastikan dokumen jelas dan dapat dibaca</li>
                                            <li>Format yang diterima: JPG, PNG, PDF</li>
                                            <li>Maksimal ukuran file 2MB per dokumen</li>
                                            <li>Upload dokumen wajib terlebih dahulu</li>
                                        </ul>
                                    </div>
                                    <div class="d-grid">
                                        <a href="{{ route('siswa.upload-dokumen') }}" class="btn btn-primary">
                                            <i class="fas fa-upload me-2"></i>Mulai Upload Dokumen
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Pembayaran -->
                <div class="col-12">
                    @php
                        $tagihan = $siswa->tagihan->first();
                    @endphp
                    
                    @if($tagihan)
                        <div class="card shadow">
                            <div class="card-header bg-warning text-white">
                                <h5 class="mb-0"><i class="fas fa-credit-card me-2"></i>Informasi Pembayaran</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="text-primary mb-3"><i class="fas fa-file-invoice me-2"></i>Detail Tagihan</h6>
                                        <table class="table table-borderless">
                                            <tr>
                                                <td width="40%"><strong>Nomor Tagihan</strong></td>
                                                <td>: {{ $tagihan->nomor_tagihan }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Jumlah Tagihan</strong></td>
                                                <td>: <span class="text-danger fw-bold">Rp {{ number_format($tagihan->jumlah, 0, ',', '.') }}</span></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Jatuh Tempo</strong></td>
                                                <td>: {{ $tagihan->tanggal_jatuh_tempo->format('d/m/Y') }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Status</strong></td>
                                                <td>: 
                                                    @if($tagihan->status === 'lunas')
                                                        <span class="badge bg-success">Lunas</span>
                                                    @else
                                                        <span class="badge bg-danger">Belum Bayar</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                        
                                        @if($tagihan->status === 'belum_bayar')
                                            <div class="mt-4">
                                                <h6 class="text-success mb-3"><i class="fas fa-university me-2"></i>Informasi Rekening</h6>
                                                <div class="bg-light p-3 rounded">
                                                    <div class="mb-2">
                                                        <strong>Bank BCA</strong><br>
                                                        <span class="text-muted">No. Rek:</span> <strong>1234567890</strong><br>
                                                        <span class="text-muted">A.n:</span> SMK Bakti Nusantara 666
                                                    </div>
                                                    <hr class="my-2">
                                                    <div>
                                                        <strong>Bank Mandiri</strong><br>
                                                        <span class="text-muted">No. Rek:</span> <strong>0987654321</strong><br>
                                                        <span class="text-muted">A.n:</span> SMK Bakti Nusantara 666
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        @if($tagihan->status === 'belum_bayar')
                                            @if($tagihan->pembayaran->isEmpty())
                                                <h6 class="text-info mb-3"><i class="fas fa-info-circle me-2"></i>Panduan Pembayaran</h6>
                                                <div class="alert alert-info">
                                                    <ol class="mb-0 ps-3">
                                                        <li>Transfer sesuai jumlah tagihan</li>
                                                        <li>Simpan bukti transfer</li>
                                                        <li>Upload bukti pembayaran</li>
                                                        <li>Tunggu verifikasi dari sekolah</li>
                                                    </ol>
                                                </div>
                                                <div class="d-grid">
                                                    <a href="{{ route('siswa.upload-pembayaran', $tagihan->id) }}" class="btn btn-primary btn-lg">
                                                        <i class="fas fa-upload me-2"></i>Upload Bukti Pembayaran
                                                    </a>
                                                </div>
                                            @else
                                                @php $pembayaran = $tagihan->pembayaran->first(); @endphp
                                                <h6 class="text-success mb-3"><i class="fas fa-check-circle me-2"></i>Status Pembayaran</h6>
                                                <div class="alert alert-info">
                                                    <i class="fas fa-info-circle me-2"></i>
                                                    Bukti pembayaran telah diupload dan sedang diverifikasi
                                                </div>
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <td><strong>Jumlah Bayar</strong></td>
                                                        <td>: Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Tanggal Bayar</strong></td>
                                                        <td>: {{ date('d/m/Y', strtotime($pembayaran->tanggal_bayar)) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Metode</strong></td>
                                                        <td>: {{ $pembayaran->metode_pembayaran }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Status</strong></td>
                                                        <td>: 
                                                            @if($pembayaran->status_verifikasi === 'verified')
                                                                <span class="badge bg-success">Terverifikasi</span>
                                                            @elseif($pembayaran->status_verifikasi === 'rejected')
                                                                <span class="badge bg-danger">Ditolak</span>
                                                            @else
                                                                <span class="badge bg-warning">Menunggu Verifikasi</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </table>
                                                @if($pembayaran->status_verifikasi === 'rejected')
                                                    <div class="alert alert-danger">
                                                        <strong>Alasan Penolakan:</strong><br>
                                                        {{ $pembayaran->catatan_verifikasi ?? 'Bukti pembayaran tidak valid' }}
                                                    </div>
                                                    <a href="{{ route('siswa.upload-pembayaran', $tagihan->id) }}" class="btn btn-warning">
                                                        <i class="fas fa-redo me-2"></i>Upload Ulang
                                                    </a>
                                                @endif
                                            @endif
                                        @else
                                            <div class="text-center">
                                                <i class="fas fa-check-circle fa-4x text-success mb-3"></i>
                                                <h5 class="text-success">Pembayaran Lunas</h5>
                                                <p class="text-muted">Terima kasih, pembayaran Anda telah berhasil diverifikasi</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card shadow">
                            <div class="card-body text-center py-5">
                                <i class="fas fa-hourglass-half fa-4x text-info mb-3"></i>
                                <h5>Tagihan Belum Dibuat</h5>
                                <p class="text-muted">Tagihan pembayaran akan dibuat oleh bagian keuangan sekolah.<br>Silakan tunggu informasi lebih lanjut.</p>
                            </div>
                        </div>
                    @endif
                </div>
                

            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
    }
    
    .bg-light {
        border-left: 4px solid #007bff;
    }
    
    .alert ol {
        margin-bottom: 0;
    }
</style>
@endpush