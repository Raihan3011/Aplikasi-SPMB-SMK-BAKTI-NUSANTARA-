@extends('layouts.app')

@section('title', 'Menunggu Verifikasi - SMK Bakti Nusantara 666')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-warning text-dark text-center py-4">
                    <i class="fas fa-clock fa-3x mb-3"></i>
                    <h3 class="mb-0">Menunggu Verifikasi</h3>
                </div>
                <div class="card-body p-5 text-center">
                    <div class="alert alert-info border-0 mb-4">
                        <h5><i class="fas fa-info-circle me-2"></i>Status Pendaftaran</h5>
                        <p class="mb-0">Terima kasih <strong>{{ $siswa->nama_lengkap }}</strong>, pendaftaran Anda telah berhasil diterima dan sedang dalam proses verifikasi oleh tim administrasi kami.</p>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <div class="card bg-light h-100">
                                <div class="card-body">
                                    <h6 class="text-primary mb-3"><i class="fas fa-user me-2"></i>Data Pendaftar</h6>
                                    <p class="mb-1"><strong>Nama:</strong> {{ $siswa->nama_lengkap }}</p>
                                    <p class="mb-1"><strong>NISN:</strong> {{ $siswa->nisn }}</p>
                                    <p class="mb-0"><strong>Jurusan:</strong> {{ $siswa->jurusan_pilihan }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light h-100">
                                <div class="card-body">
                                    <h6 class="text-success mb-3"><i class="fas fa-calendar me-2"></i>Informasi Waktu</h6>
                                    <p class="mb-1"><strong>Tanggal Daftar:</strong> {{ $siswa->created_at->format('d/m/Y H:i') }}</p>
                                    <p class="mb-1"><strong>Status:</strong> <span class="badge bg-warning">Menunggu Verifikasi</span></p>
                                    <p class="mb-0"><strong>Estimasi:</strong> 1-3 hari kerja</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-light p-4 rounded mb-4">
                        <h6 class="text-dark mb-3"><i class="fas fa-tasks me-2"></i>Proses Verifikasi</h6>
                        <div class="row text-start">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <span>Pendaftaran diterima</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-spinner fa-spin text-warning me-2"></i>
                                    <span>Verifikasi data administrasi</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-clock text-muted me-2"></i>
                                    <span class="text-muted">Konfirmasi penerimaan</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-clock text-muted me-2"></i>
                                    <span class="text-muted">Akses dashboard siswa</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-warning border-0">
                        <h6><i class="fas fa-exclamation-triangle me-2"></i>Penting!</h6>
                        <p class="mb-0">Jika pendaftaran tidak memenuhi persyaratan atau kuota telah penuh, maka status akan berubah menjadi "Ditolak". Anda akan mendapat pemberitahuan dan dapat mendaftar ulang pada periode berikutnya.</p>
                    </div>

                    <div class="mt-4">
                        <form method="POST" action="{{ route('auth.logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary me-2">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </button>
                        </form>
                        <a href="{{ route('kontak') }}" class="btn btn-primary">
                            <i class="fas fa-phone me-2"></i>Hubungi Sekolah
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border-radius: 15px;
    }
    
    .btn {
        border-radius: 8px;
    }
    
    .fa-spinner {
        animation: spin 2s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
@endpush