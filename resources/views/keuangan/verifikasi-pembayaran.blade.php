@extends('layouts.app')

@section('title', 'Verifikasi Pembayaran - Keuangan')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold">Verifikasi Pembayaran</h2>
                    <p class="text-muted">Verifikasi bukti pembayaran dari {{ $pembayaran->tagihan->pendaftar->nama_lengkap }}</p>
                </div>
                <a href="{{ route('keuangan.dashboard') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>Detail Pembayaran</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nomor Tagihan</label>
                            <p class="form-control-plaintext">{{ $pembayaran->tagihan->nomor_tagihan }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nama Pendaftar</label>
                            <p class="form-control-plaintext">{{ $pembayaran->tagihan->pendaftar->nama_lengkap }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Jumlah Tagihan</label>
                            <p class="form-control-plaintext">Rp {{ number_format($pembayaran->tagihan->jumlah, 0, ',', '.') }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Jumlah Bayar</label>
                            <p class="form-control-plaintext">Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tanggal Bayar</label>
                            <p class="form-control-plaintext">{{ $pembayaran->tanggal_bayar->format('d/m/Y') }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Metode Pembayaran</label>
                            <p class="form-control-plaintext">{{ $pembayaran->metode_pembayaran }}</p>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Keterangan</label>
                            <p class="form-control-plaintext">{{ $pembayaran->keterangan ?: '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bukti Pembayaran -->
            <div class="card shadow mt-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-image me-2"></i>Bukti Pembayaran</h5>
                </div>
                <div class="card-body text-center">
                    @if($pembayaran->bukti_pembayaran)
                        @php
                            $extension = pathinfo($pembayaran->bukti_pembayaran, PATHINFO_EXTENSION);
                        @endphp
                        
                        @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png']))
                            <img src="{{ asset('uploads/pembayaran/' . $pembayaran->bukti_pembayaran) }}" 
                                 class="img-fluid rounded shadow" style="max-height: 400px;">
                        @else
                            <div class="p-4">
                                <i class="fas fa-file-pdf fa-5x text-danger mb-3"></i>
                                <h5>File PDF</h5>
                                <a href="{{ asset('uploads/pembayaran/' . $pembayaran->bukti_pembayaran) }}" 
                                   target="_blank" class="btn btn-primary">
                                    <i class="fas fa-download me-2"></i>Download Bukti
                                </a>
                            </div>
                        @endif
                    @else
                        <p class="text-muted">Tidak ada bukti pembayaran</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0"><i class="fas fa-check-circle me-2"></i>Verifikasi</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('keuangan.update-verifikasi', $pembayaran->id) }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status Verifikasi</label>
                            <div class="mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_verifikasi" 
                                           value="verified" id="verified" required>
                                    <label class="form-check-label text-success" for="verified">
                                        <i class="fas fa-check me-1"></i>Verifikasi (Terima)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_verifikasi" 
                                           value="rejected" id="rejected" required>
                                    <label class="form-check-label text-danger" for="rejected">
                                        <i class="fas fa-times me-1"></i>Tolak
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Catatan Verifikasi</label>
                            <textarea name="catatan_verifikasi" class="form-control" rows="3" 
                                      placeholder="Catatan untuk siswa (opsional)"></textarea>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan Verifikasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Pendaftar -->
            <div class="card shadow mt-4">
                <div class="card-header bg-success text-white">
                    <h6 class="mb-0"><i class="fas fa-user me-2"></i>Info Pendaftar</h6>
                </div>
                <div class="card-body">
                    <p class="mb-1"><strong>NISN:</strong> {{ $pembayaran->tagihan->pendaftar->nisn }}</p>
                    <p class="mb-1"><strong>Jurusan:</strong> {{ $pembayaran->tagihan->pendaftar->jurusan_pilihan }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ $pembayaran->tagihan->pendaftar->email }}</p>
                    <p class="mb-0"><strong>No. HP:</strong> {{ $pembayaran->tagihan->pendaftar->no_telepon }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.form-check-input:checked[value="verified"] {
    background-color: #28a745;
    border-color: #28a745;
}

.form-check-input:checked[value="rejected"] {
    background-color: #dc3545;
    border-color: #dc3545;
}
</style>
@endpush