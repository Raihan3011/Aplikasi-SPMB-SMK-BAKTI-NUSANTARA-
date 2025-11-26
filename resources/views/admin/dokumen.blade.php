@extends('layouts.app')

@section('title', 'Dokumen Siswa - SMK Bakti Nusantara 666')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0"><i class="fas fa-folder-open me-2"></i>Dokumen Persyaratan</h5>
                            <small>{{ $pendaftar->nama_lengkap }} - {{ $pendaftar->nisn }}</small>
                        </div>
                        <a href="{{ route('admin.detail', $pendaftar->id) }}" class="btn btn-outline-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>

            @if($pendaftar->dokumen)
                <div class="row g-4">
                    @php
                        $dokumenList = [
                            'foto_siswa' => ['label' => 'Foto Siswa', 'icon' => 'fas fa-camera', 'color' => 'primary'],
                            'kartu_keluarga' => ['label' => 'Kartu Keluarga', 'icon' => 'fas fa-users', 'color' => 'success'],
                            'akta_kelahiran' => ['label' => 'Akta Kelahiran', 'icon' => 'fas fa-certificate', 'color' => 'info'],
                            'ijazah_smp' => ['label' => 'Ijazah SMP', 'icon' => 'fas fa-graduation-cap', 'color' => 'warning'],

                            'surat_sehat' => ['label' => 'Surat Sehat', 'icon' => 'fas fa-heartbeat', 'color' => 'secondary'],
                            'surat_kelakuan' => ['label' => 'Surat Kelakuan Baik', 'icon' => 'fas fa-award', 'color' => 'dark']
                        ];
                    @endphp

                    @foreach($dokumenList as $field => $info)
                        <div class="col-md-6 col-lg-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center p-4">
                                    <div class="dokumen-icon bg-{{ $info['color'] }} bg-gradient text-white rounded-circle mb-3 mx-auto">
                                        <i class="{{ $info['icon'] }}"></i>
                                    </div>
                                    <h6 class="card-title">{{ $info['label'] }}</h6>
                                    
                                    @if($pendaftar->dokumen->$field)
                                        <div class="mt-3">
                                            <span class="badge bg-success mb-2">
                                                <i class="fas fa-check me-1"></i>Tersedia
                                            </span>
                                            <div class="d-grid gap-2">
                                                <a href="{{ route('view.dokumen', $pendaftar->dokumen->$field) }}" 
                                                   target="_blank" 
                                                   class="btn btn-outline-{{ $info['color'] }} btn-sm">
                                                    <i class="fas fa-eye me-1"></i>Lihat Dokumen
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="mt-3">
                                            <span class="badge bg-secondary">
                                                <i class="fas fa-times me-1"></i>Belum Upload
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <div class="empty-state">
                            <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum Ada Dokumen</h5>
                            <p class="text-muted">Siswa belum mengupload dokumen persyaratan</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .dokumen-icon {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
    }
    
    .empty-state {
        padding: 2rem;
    }
</style>
@endpush