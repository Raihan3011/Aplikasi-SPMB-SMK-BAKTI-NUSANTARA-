@extends('layouts.app')

@section('title', 'Upload Dokumen - SMK Bakti Nusantara 666')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2><i class="fas fa-upload me-2"></i>Upload Dokumen</h2>
                    <p class="text-muted mb-0">Upload dokumen persyaratan pendaftaran</p>
                </div>
                <a href="{{ route('siswa.dashboard') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Upload Form -->
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-file-upload me-2"></i>Form Upload Dokumen</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('siswa.store-dokumen') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Foto Siswa -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                <i class="fas fa-user-circle me-2"></i>Foto Siswa (3x4)
                                <span class="text-danger">*</span>
                            </label>
                            <input type="file" class="form-control @error('foto_siswa') is-invalid @enderror" 
                                   name="foto_siswa" accept="image/*" required>
                            <div class="form-text">Format: JPG, PNG. Maksimal 2MB</div>
                            @error('foto_siswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kartu Keluarga -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                <i class="fas fa-id-card me-2"></i>Kartu Keluarga (KK)
                                <span class="text-danger">*</span>
                            </label>
                            <input type="file" class="form-control @error('kartu_keluarga') is-invalid @enderror" 
                                   name="kartu_keluarga" accept="image/*,application/pdf" required>
                            <div class="form-text">Format: JPG, PNG, PDF. Maksimal 2MB</div>
                            @error('kartu_keluarga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Akta Kelahiran -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                <i class="fas fa-certificate me-2"></i>Akta Kelahiran
                                <span class="text-danger">*</span>
                            </label>
                            <input type="file" class="form-control @error('akta_kelahiran') is-invalid @enderror" 
                                   name="akta_kelahiran" accept="image/*,application/pdf" required>
                            <div class="form-text">Format: JPG, PNG, PDF. Maksimal 2MB</div>
                            @error('akta_kelahiran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Ijazah SMP -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                <i class="fas fa-graduation-cap me-2"></i>Ijazah SMP/Sederajat
                                <span class="text-danger">*</span>
                            </label>
                            <input type="file" class="form-control @error('ijazah_smp') is-invalid @enderror" 
                                   name="ijazah_smp" accept="image/*,application/pdf" required>
                            <div class="form-text">Format: JPG, PNG, PDF. Maksimal 2MB</div>
                            @error('ijazah_smp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>



                        <!-- Surat Keterangan Sehat -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                <i class="fas fa-heartbeat me-2"></i>Surat Keterangan Sehat
                                <span class="text-muted">(Opsional)</span>
                            </label>
                            <input type="file" class="form-control @error('surat_sehat') is-invalid @enderror" 
                                   name="surat_sehat" accept="image/*,application/pdf">
                            <div class="form-text">Format: JPG, PNG, PDF. Maksimal 2MB</div>
                            @error('surat_sehat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Surat Keterangan Kelakuan Baik -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                <i class="fas fa-shield-alt me-2"></i>Surat Keterangan Kelakuan Baik
                                <span class="text-muted">(Opsional)</span>
                            </label>
                            <input type="file" class="form-control @error('surat_kelakuan') is-invalid @enderror" 
                                   name="surat_kelakuan" accept="image/*,application/pdf">
                            <div class="form-text">Format: JPG, PNG, PDF. Maksimal 2MB</div>
                            @error('surat_kelakuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Catatan -->
                        <div class="alert alert-info">
                            <h6><i class="fas fa-info-circle me-2"></i>Catatan Penting:</h6>
                            <ul class="mb-0">
                                <li>Pastikan dokumen yang diupload jelas dan dapat dibaca</li>
                                <li>File dengan tanda (*) wajib diupload</li>
                                <li>Maksimal ukuran file 2MB per dokumen</li>
                                <li>Format yang diterima: JPG, PNG, PDF</li>
                            </ul>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('siswa.dashboard') }}" class="btn btn-secondary me-md-2">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-upload me-2"></i>Upload Dokumen
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .form-control:focus {
        border-color: #1e3c72;
        box-shadow: 0 0 0 0.2rem rgba(30, 60, 114, 0.25);
    }
    
    .card {
        border: none;
        border-radius: 15px;
    }
    
    .alert {
        border-radius: 10px;
    }
</style>
@endpush