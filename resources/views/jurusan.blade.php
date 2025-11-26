@extends('layouts.app')

@section('title', 'Jurusan - SMK Bakti Nusantara 666')

@section('content')
@include('components.breadcrumb', ['breadcrumbs' => [['title' => 'Program Keahlian', 'icon' => 'fas fa-graduation-cap']]])

<!-- Hero Section -->
<section class="hero-section text-white text-center">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3">Program Keahlian</h1>
        <p class="lead">Pilih jurusan sesuai minat dan bakatmu untuk masa depan yang cerah</p>
    </div>
</section>

<!-- Jurusan Content -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Program Keahlian Unggulan</h2>
            <p class="text-muted">SMK Bakti Nusantara 666 menawarkan berbagai program keahlian yang sesuai dengan kebutuhan industri</p>
        </div>
        
        <div class="row g-4">
            @forelse($jurusans as $index => $jurusan)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm jurusan-card">
                    <div class="card-header bg-gradient text-white text-center py-4 {{ $index % 3 == 0 ? 'bg-primary' : ($index % 3 == 1 ? 'bg-success' : 'bg-warning') }}">
                        <div class="icon-circle mb-3">
                            <i class="fas {{ $index % 3 == 0 ? 'fa-laptop-code' : ($index % 3 == 1 ? 'fa-cogs' : 'fa-chart-line') }} fa-2x"></i>
                        </div>
                        <h4 class="mb-0">{{ $jurusan->kode_jurusan }}</h4>
                    </div>
                    <div class="card-body p-4">
                        <h5 class="card-title text-center mb-3">{{ $jurusan->nama_jurusan }}</h5>
                        <div class="mb-3">
                            <h6 class="text-success"><i class="fas fa-graduation-cap me-2"></i>Kompetensi Keahlian:</h6>
                            <ul class="list-unstyled ms-3">
                                <li><i class="fas fa-check text-success me-2"></i>Praktik industri langsung</li>
                                <li><i class="fas fa-check text-success me-2"></i>Sertifikasi kompetensi</li>
                                <li><i class="fas fa-check text-success me-2"></i>Peluang kerja luas</li>
                            </ul>
                        </div>
                        <div class="mb-3">
                            <h6 class="text-success"><i class="fas fa-briefcase me-2"></i>Prospek Karir:</h6>
                            <p class="text-muted small">Lulusan dapat bekerja di berbagai bidang industri atau melanjutkan ke perguruan tinggi.</p>
                        </div>
                    </div>

                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center py-5">
                    <i class="fas fa-info-circle fa-3x text-info mb-3"></i>
                    <h4>Data Jurusan Belum Tersedia</h4>
                    <p class="mb-0">Silakan hubungi admin untuk informasi lebih lanjut tentang program keahlian yang tersedia.</p>
                </div>
            </div>
            @endforelse
        </div>
        
        @if($jurusans->count() > 0)
        <div class="text-center mt-5">
            <div class="bg-light p-4 rounded">
                <h4 class="text-success mb-3">Siap Bergabung?</h4>
                <p class="mb-3">Daftarkan diri Anda sekarang dan raih masa depan yang cerah bersama kami!</p>
                <a href="{{ route('daftar') }}" class="btn btn-success btn-lg me-3">Daftar Sekarang</a>
                <a href="{{ route('kontak') }}" class="btn btn-outline-success btn-lg">Hubungi Kami</a>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection

@push('styles')
<style>
    .hero-section {
        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.4)), url('{{ asset('images/sa.jpeg') }}') center center/cover;
        padding: 8rem 0 6rem;
    }
    
    .jurusan-card {
        transition: all 0.3s ease;
    }
    
    .jurusan-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
    }
    
    .bg-gradient {
        background: linear-gradient(135deg, var(--bs-primary) 0%, var(--bs-primary-dark, #0056b3) 100%);
    }
    
    .bg-success.bg-gradient {
        background: linear-gradient(135deg, var(--bs-success) 0%, #1e7e34 100%);
    }
    
    .bg-warning.bg-gradient {
        background: linear-gradient(135deg, var(--bs-warning) 0%, #e0a800 100%);
    }
    
    .icon-circle {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        border: 2px solid rgba(255,255,255,0.3);
    }
</style>
@endpush