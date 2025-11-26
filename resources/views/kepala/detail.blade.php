@extends('layouts.app')

@section('title', 'Detail Pendaftar - Kepala Sekolah')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold">Detail Pendaftar</h2>
                    <p class="text-muted">Informasi lengkap calon siswa</p>
                </div>
                <a href="{{ route('kepala.dashboard') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Pendaftar</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <p class="form-control-plaintext">{{ $pendaftar->nama_lengkap }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">NISN</label>
                            <p class="form-control-plaintext">{{ $pendaftar->nisn }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Email</label>
                            <p class="form-control-plaintext">{{ $pendaftar->email }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">No. Telepon</label>
                            <p class="form-control-plaintext">{{ $pendaftar->no_telepon }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Jurusan Pilihan</label>
                            <p class="form-control-plaintext">{{ $jurusan->nama_jurusan ?? $pendaftar->jurusan_pilihan }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Asal Sekolah</label>
                            <p class="form-control-plaintext">{{ $pendaftar->asal_sekolah }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nama Orang Tua</label>
                            <p class="form-control-plaintext">{{ $pendaftar->nama_orangtua }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tanggal Daftar</label>
                            <p class="form-control-plaintext">{{ $pendaftar->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Status & Ringkasan</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Status Verifikasi</label>
                        <div>
                            @if($pendaftar->status_verifikasi === 'verified')
                                <span class="badge bg-success fs-6">Terverifikasi</span>
                            @elseif($pendaftar->status_verifikasi === 'rejected')
                                <span class="badge bg-danger fs-6">Ditolak</span>
                            @else
                                <span class="badge bg-warning fs-6">Pending</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Status Pembayaran</label>
                        <div>
                            <span class="badge bg-warning fs-6">Belum Bayar</span>
                        </div>
                    </div>

                    <hr>

                    <div class="text-center">
                        <small class="text-muted">ID Pendaftar</small>
                        <h4 class="text-primary">#{{ str_pad($pendaftar->id, 4, '0', STR_PAD_LEFT) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection