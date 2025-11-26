@extends('layouts.app')

@section('title', 'Edit Tagihan - Keuangan')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold">Edit Tagihan</h2>
                    <p class="text-muted">Edit tagihan untuk {{ $tagihan->pendaftar->nama_lengkap }}</p>
                </div>
                <a href="{{ route('keuangan.dashboard') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Form Edit Tagihan</h5>
                </div>
                <div class="card-body p-4">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('keuangan.update-tagihan', $tagihan->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nomor Tagihan</label>
                                <input type="text" class="form-control" value="{{ $tagihan->nomor_tagihan }}" readonly>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nama Pendaftar</label>
                                <input type="text" class="form-control" value="{{ $tagihan->pendaftar->nama_lengkap }}" readonly>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Jumlah Tagihan *</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="jumlah" class="form-control" 
                                           value="{{ old('jumlah', $tagihan->jumlah) }}" 
                                           placeholder="150000" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Status Pembayaran *</label>
                                <select name="status" class="form-select" required>
                                    <option value="belum_bayar" {{ old('status', $tagihan->status) === 'belum_bayar' ? 'selected' : '' }}>
                                        Belum Bayar
                                    </option>
                                    <option value="lunas" {{ old('status', $tagihan->status) === 'lunas' ? 'selected' : '' }}>
                                        Lunas
                                    </option>
                                </select>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tanggal Jatuh Tempo *</label>
                                <input type="date" name="tanggal_jatuh_tempo" class="form-control" 
                                       value="{{ old('tanggal_jatuh_tempo', $tagihan->tanggal_jatuh_tempo->format('Y-m-d')) }}" 
                                       required>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tanggal Dibuat</label>
                                <input type="text" class="form-control" 
                                       value="{{ $tagihan->created_at->format('d/m/Y H:i') }}" readonly>
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label fw-bold">Keterangan *</label>
                                <textarea name="keterangan" class="form-control" rows="3" 
                                          placeholder="Biaya Pendaftaran PPDB 2026/2027" required>{{ old('keterangan', $tagihan->keterangan) }}</textarea>
                            </div>
                            
                            <div class="col-12">
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('keuangan.dashboard') }}" class="btn btn-secondary">
                                        <i class="fas fa-times me-2"></i>Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Update Tagihan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Info Card -->
            <div class="card mt-4 border-info">
                <div class="card-body">
                    <h6 class="text-info"><i class="fas fa-info-circle me-2"></i>Informasi Tagihan</h6>
                    <div class="row g-3 text-sm">
                        <div class="col-md-4">
                            <strong>NISN:</strong> {{ $tagihan->pendaftar->nisn }}
                        </div>
                        <div class="col-md-4">
                            <strong>Jurusan:</strong> {{ $tagihan->pendaftar->jurusan_pilihan }}
                        </div>
                        <div class="col-md-4">
                            <strong>Email:</strong> {{ $tagihan->pendaftar->email }}
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
.form-control:focus, .form-select:focus {
    border-color: #1e3c72;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.card {
    border-radius: 15px;
    overflow: hidden;
}

.input-group-text {
    background: #f8f9fa;
    border-color: #dee2e6;
}
</style>
@endpush