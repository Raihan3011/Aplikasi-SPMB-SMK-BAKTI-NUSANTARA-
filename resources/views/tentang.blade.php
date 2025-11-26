@extends('layouts.app')

@section('title', 'Tentang - SMK Bakti Nusantara 666')

@section('content')
@include('components.breadcrumb', ['breadcrumbs' => [['title' => 'Tentang', 'icon' => 'fas fa-info-circle']]])

<!-- Hero Section -->
<section class="hero-section text-white text-center">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3">Tentang SMK Bakti Nusantara 666</h1>
        <p class="lead">Membangun Generasi Unggul dan Berkarakter</p>
        <div class="mt-4">
            <h4 class="text-warning mb-2">Slogan Sekolah: <strong>SAJUTA</strong></h4>
            <p class="mb-0"><strong>SA</strong>ntun - <strong>JU</strong>jur - <strong>TA</strong>at</p>
        </div>
    </div>
</section>

<!-- About Content -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6">
                <h2 class="mb-4">Visi & Misi Sekolah</h2>
                <div class="mb-4">
                    <h5 class="text-success"><i class="fas fa-eye me-2"></i>Visi</h5>
                    <p>Menjadi SMK unggulan yang menghasilkan lulusan kompeten, berkarakter, dan siap bersaing di era global.</p>
                </div>
                <div>
                    <h5 class="text-success"><i class="fas fa-bullseye me-2"></i>Misi</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2"></i>Menyelenggarakan pendidikan kejuruan berkualitas</li>
                        <li><i class="fas fa-check text-success me-2"></i>Mengembangkan kompetensi sesuai kebutuhan industri</li>
                        <li><i class="fas fa-check text-success me-2"></i>Membentuk karakter siswa yang berakhlak mulia</li>
                        <li><i class="fas fa-check text-success me-2"></i>Membangun kemitraan dengan dunia usaha dan industri</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/baknus.png') }}" alt="SMK Bakti Nusantara 666" class="img-fluid rounded shadow">
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-3">
                <div class="text-center p-4 bg-light rounded">
                    <i class="fas fa-graduation-cap fa-3x text-success mb-3"></i>
                    <h4>1000+</h4>
                    <p class="text-muted">Alumni Sukses</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-4 bg-light rounded">
                    <i class="fas fa-chalkboard-teacher fa-3x text-success mb-3"></i>
                    <h4>50+</h4>
                    <p class="text-muted">Tenaga Pengajar</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-4 bg-light rounded">
                    <i class="fas fa-building fa-3x text-success mb-3"></i>
                    <h4>100+</h4>
                    <p class="text-muted">Mitra Industri</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-4 bg-light rounded">
                    <i class="fas fa-certificate fa-3x text-success mb-3"></i>
                    <h4>95%</h4>
                    <p class="text-muted">Tingkat Kelulusan</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Keunggulan Sekolah</h2>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-laptop-code fa-3x text-success mb-3"></i>
                        <h5>Fasilitas Modern</h5>
                        <p class="text-muted">Laboratorium dan workshop dengan peralatan terkini</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-user-graduate fa-3x text-success mb-3"></i>
                        <h5>Guru Berpengalaman</h5>
                        <p class="text-muted">Tenaga pengajar profesional dan bersertifikat</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-handshake fa-3x text-success mb-3"></i>
                        <h5>Program Magang</h5>
                        <p class="text-muted">Kerjasama dengan industri terkemuka</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-award fa-3x text-success mb-3"></i>
                        <h5>Sertifikasi</h5>
                        <p class="text-muted">Kompetensi nasional dan internasional</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .hero-section {
        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.4)), url('{{ asset('images/sa.jpeg') }}') center center/cover;
        padding: 8rem 0 6rem;
    }
    
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
    }
</style>
@endpush