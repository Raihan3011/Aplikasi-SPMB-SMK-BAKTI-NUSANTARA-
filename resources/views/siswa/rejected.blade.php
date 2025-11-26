@extends('layouts.app')

@section('title', 'Pendaftaran Ditolak - SMK Bakti Nusantara 666')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-danger text-white text-center py-4">
                    <i class="fas fa-times-circle fa-3x mb-3"></i>
                    <h3 class="mb-1">Pendaftaran Ditolak</h3>
                    <p class="mb-0">Mohon maaf, pendaftaran Anda tidak dapat diproses</p>
                </div>
                <div class="card-body p-5 text-center">
                    <div class="alert alert-danger border-0 mb-4">
                        <h5><i class="fas fa-exclamation-triangle me-2"></i>Pemberitahuan</h5>
                        <p class="mb-0">Mohon maaf <strong>{{ $siswa->nama_lengkap }}</strong>, setelah melalui proses verifikasi, pendaftaran Anda tidak dapat kami terima pada periode ini.</p>
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
                                    <h6 class="text-danger mb-3"><i class="fas fa-calendar me-2"></i>Informasi Status</h6>
                                    <p class="mb-1"><strong>Tanggal Daftar:</strong> {{ $siswa->created_at->format('d/m/Y H:i') }}</p>
                                    <p class="mb-1"><strong>Status:</strong> <span class="badge bg-danger">Ditolak</span></p>
                                    <p class="mb-0"><strong>Tanggal Keputusan:</strong> {{ now()->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-light p-4 rounded mb-4">
                        <h6 class="text-dark mb-3"><i class="fas fa-info-circle me-2"></i>Kemungkinan Alasan Penolakan</h6>
                        <div class="row text-start">
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="fas fa-circle text-muted me-2" style="font-size: 0.5rem;"></i>Kuota jurusan telah penuh</li>
                                    <li class="mb-2"><i class="fas fa-circle text-muted me-2" style="font-size: 0.5rem;"></i>Data tidak lengkap atau tidak valid</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="fas fa-circle text-muted me-2" style="font-size: 0.5rem;"></i>Tidak memenuhi persyaratan akademik</li>
                                    <li class="mb-2"><i class="fas fa-circle text-muted me-2" style="font-size: 0.5rem;"></i>Dokumen persyaratan tidak sesuai</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info border-0 mb-4">
                        <h6><i class="fas fa-lightbulb me-2"></i>Saran untuk Anda</h6>
                        <p class="mb-2">Jangan berkecil hati! Anda masih memiliki kesempatan untuk:</p>
                        <ul class="text-start mb-0">
                            <li>Mendaftar ulang pada periode berikutnya jika kuota tersedia</li>
                            <li>Memilih jurusan lain yang masih membuka pendaftaran</li>
                            <li>Melengkapi persyaratan yang kurang dan mendaftar kembali</li>
                            <li>Menghubungi bagian administrasi untuk informasi lebih detail</li>
                        </ul>
                    </div>

                    <div class="alert alert-warning border-0">
                        <h6><i class="fas fa-phone me-2"></i>Butuh Penjelasan Lebih Lanjut?</h6>
                        <p class="mb-0">Silakan hubungi bagian administrasi sekolah untuk mendapatkan penjelasan detail mengenai keputusan ini dan kemungkinan langkah selanjutnya.</p>
                    </div>

                    <div class="mt-4">
                        <form method="POST" action="{{ route('auth.logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary me-2">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </button>
                        </form>
                        <a href="{{ route('kontak') }}" class="btn btn-primary me-2">
                            <i class="fas fa-phone me-2"></i>Hubungi Sekolah
                        </a>
                        <a href="{{ route('daftar') }}" class="btn btn-success">
                            <i class="fas fa-redo me-2"></i>Daftar Ulang
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
    
    .list-unstyled li {
        padding: 2px 0;
    }
</style>
@endpush