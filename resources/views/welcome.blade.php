@extends('layouts.app')

@section('title', 'PPDB SMK Bakti Nusantara 666')

@section('content')
<!-- Header -->
<header class="hero-section-bg text-center">
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <div class="hero-overlay">
        <div class="container px-4">
            <div class="hero-content">
                <h1 class="display-4 fw-bold mb-4 text-white">Selamat Datang di PPDB<br>SMK Bakti Nusantara 666</h1>
                <p class="lead mb-4 text-white">Penerimaan Peserta Didik Baru Tahun Ajaran 2026/2027</p>
                <div class="mt-5">
                    <a href="{{ route('daftar') }}" class="btn btn-primary btn-lg me-3">Daftar Sekarang</a>
                    <a href="{{ route('tentang') }}" class="btn btn-outline-light btn-lg">Info Sekolah</a>
                </div>
                <div class="mt-4">
                    <p class="text-light">Gunakan menu navigasi di atas untuk menjelajahi informasi sekolah</p>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Quick Stats -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-md-3">
                <div class="stat-item">
                    <i class="fas fa-users fa-3x mb-3"></i>
                    <h3 class="fw-bold">{{ cache()->remember('pendaftar_count', 300, function() { return \App\Models\Pendaftar::count(); }) }}</h3>
                    <p>Pendaftar 2026/2027</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-item">
                    <i class="fas fa-graduation-cap fa-3x mb-3"></i>
                    <h3 class="fw-bold">1000+</h3>
                    <p>Alumni Sukses</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-item">
                    <i class="fas fa-building fa-3x mb-3"></i>
                    <h3 class="fw-bold">100+</h3>
                    <p>Mitra Industri</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-item">
                    <i class="fas fa-certificate fa-3x mb-3"></i>
                    <h3 class="fw-bold">95%</h3>
                    <p>Tingkat Kelulusan</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Info Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Mengapa Memilih SMK Bakti Nusantara 666?</h2>
            <p class="lead text-muted">Keunggulan yang membuat kami berbeda</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-3 mb-3 mx-auto" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-laptop-code fa-2x"></i>
                        </div>
                        <h5 class="card-title">Fasilitas Modern</h5>
                        <p class="card-text">Laboratorium komputer, workshop, dan peralatan praktik terkini untuk mendukung pembelajaran optimal.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-success bg-gradient text-white rounded-3 mb-3 mx-auto" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-handshake fa-2x"></i>
                        </div>
                        <h5 class="card-title">Kerjasama Industri</h5>
                        <p class="card-text">Program magang dan sertifikasi dengan perusahaan terkemuka untuk jaminan karir masa depan.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-warning bg-gradient text-white rounded-3 mb-3 mx-auto" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-award fa-2x"></i>
                        </div>
                        <h5 class="card-title">Prestasi Gemilang</h5>
                        <p class="card-text">Berbagai penghargaan tingkat nasional dan internasional dalam kompetisi keahlian.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Jurusan Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Program Keahlian</h2>
            <p class="lead text-muted">Pilih jurusan sesuai minat dan bakat Anda</p>
        </div>
        <div class="row g-4">
            @foreach(cache()->remember('jurusans_welcome', 3600, function() { return \App\Models\Jurusan::select('kode_jurusan', 'nama_jurusan')->get(); }) as $jurusan)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm jurusan-card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="jurusan-icon bg-gradient-primary text-white rounded-circle me-3">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-0">{{ $jurusan->nama_jurusan }}</h5>
                                <small class="text-muted">{{ $jurusan->kode_jurusan }}</small>
                            </div>
                        </div>
                        <p class="card-text text-muted">Program keahlian yang mempersiapkan siswa menjadi tenaga kerja profesional dan kompeten.</p>
                        <div class="mt-3">
                            <span class="badge bg-light text-dark me-2">
                                <i class="fas fa-users me-1"></i>
                                {{ cache()->remember('pendaftar_count_'.$jurusan->kode_jurusan, 300, function() use ($jurusan) { return \App\Models\Pendaftar::where('jurusan_pilihan', $jurusan->kode_jurusan)->count(); }) }} pendaftar
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('jurusan') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-graduation-cap me-2"></i>Lihat Semua Jurusan
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-gradient-primary text-white">
    <div class="container text-center">
        <h2 class="fw-bold mb-3">Siap Bergabung dengan Kami?</h2>
        <p class="lead mb-4">Daftarkan diri Anda sekarang dan wujudkan masa depan cerah bersama SMK Bakti Nusantara 666</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('daftar') }}" class="btn btn-light btn-lg">
                <i class="fas fa-user-plus me-2"></i>Daftar PPDB
            </a>
            <a href="{{ route('persyaratan') }}" class="btn btn-outline-light btn-lg">
                <i class="fas fa-clipboard-list me-2"></i>Lihat Persyaratan
            </a>
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">
                <i class="fas fa-sign-in-alt me-2"></i>Login
            </a>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .hero-section-bg {
        background: linear-gradient(135deg, rgba(30, 60, 114, 0.9) 0%, rgba(42, 82, 152, 0.8) 100%), url('{{ asset('images/sa.jpeg') }}') center center/cover;
        padding: 8rem 0;
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }
    
    .floating-shapes {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 1;
    }
    
    .floating-shapes .shape {
        position: absolute;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }
    
    .floating-shapes .shape:nth-child(1) {
        width: 80px;
        height: 80px;
        top: 20%;
        left: 10%;
        animation-delay: 0s;
    }
    
    .floating-shapes .shape:nth-child(2) {
        width: 120px;
        height: 120px;
        top: 60%;
        right: 10%;
        animation-delay: 2s;
    }
    
    .floating-shapes .shape:nth-child(3) {
        width: 60px;
        height: 60px;
        bottom: 20%;
        left: 20%;
        animation-delay: 4s;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }
    
    .hero-overlay {
        position: relative;
        z-index: 2;
    }
    
    .hero-content {
        animation: fadeInUp 1.2s ease-out;
    }
    
    .hero-content h1 {
        text-shadow: 0 4px 20px rgba(0,0,0,0.3);
        animation: textGlow 3s ease-in-out infinite alternate;
    }
    
    @keyframes textGlow {
        from { text-shadow: 0 4px 20px rgba(0,0,0,0.3); }
        to { text-shadow: 0 4px 30px rgba(255,255,255,0.2); }
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Modern Glassmorphism Cards */
    .card {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.95);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        overflow: hidden;
        position: relative;
    }
    
    .card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        transition: left 0.6s;
    }
    
    .card:hover::before {
        left: 100%;
    }
    
    .card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        border-color: rgba(30, 60, 114, 0.3);
    }
    
    /* Animated Statistics */
    .stat-item {
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .stat-item:hover {
        transform: translateY(-8px) scale(1.05);
    }
    
    .stat-item i {
        transition: all 0.3s ease;
        filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2));
    }
    
    .stat-item:hover i {
        transform: rotateY(360deg) scale(1.1);
        filter: drop-shadow(0 8px 16px rgba(0,0,0,0.3));
    }
    
    .stat-item h3 {
        background: linear-gradient(45deg, #fff, #f0f8ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: numberPulse 2s ease-in-out infinite;
    }
    
    @keyframes numberPulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    
    /* Modern Buttons */
    .btn {
        position: relative;
        overflow: hidden;
        border-radius: 50px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    
    .btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255,255,255,0.3);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }
    
    .btn:hover::before {
        width: 300px;
        height: 300px;
    }
    
    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.3);
    }
    
    .btn-primary {
        background: linear-gradient(45deg, #1e3c72, #2a5298, #4facfe);
        background-size: 200% 200%;
        animation: gradientShift 3s ease infinite;
    }
    
    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    /* Jurusan Cards Enhancement */
    .jurusan-card {
        border-left: 4px solid transparent;
        transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        position: relative;
    }
    
    .jurusan-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(30, 60, 114, 0.05), rgba(42, 82, 152, 0.05));
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .jurusan-card:hover::after {
        opacity: 1;
    }
    
    .jurusan-card:hover {
        transform: translateY(-8px) rotateX(5deg);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        border-left-color: #1e3c72;
    }
    
    .jurusan-icon {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        transition: all 0.4s ease;
        position: relative;
        z-index: 1;
    }
    
    .jurusan-card:hover .jurusan-icon {
        transform: scale(1.2) rotate(10deg);
        box-shadow: 0 8px 20px rgba(30, 60, 114, 0.4);
    }
    
    /* Feature Icons Enhancement */
    .feature-icon {
        transition: all 0.4s ease;
        position: relative;
    }
    
    .feature-icon::before {
        content: '';
        position: absolute;
        top: -5px;
        left: -5px;
        right: -5px;
        bottom: -5px;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.3), transparent);
        border-radius: inherit;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .card:hover .feature-icon::before {
        opacity: 1;
        animation: iconGlow 1.5s ease-in-out infinite;
    }
    
    @keyframes iconGlow {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }
    
    .card:hover .feature-icon {
        transform: scale(1.1) rotateY(15deg);
    }
    
    /* Section Animations */
    section {
        position: relative;
        overflow: hidden;
    }
    
    section::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(30, 60, 114, 0.03) 0%, transparent 70%);
        animation: sectionFloat 20s linear infinite;
        pointer-events: none;
    }
    
    @keyframes sectionFloat {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    /* Badge Enhancement */
    .badge {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .badge::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        transition: left 0.5s;
    }
    
    .badge:hover::before {
        left: 100%;
    }
    
    .badge:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
    
    /* Responsive Enhancements */
    @media (max-width: 768px) {
        .hero-section-bg {
            padding: 4rem 0;
            min-height: 80vh;
        }
        
        .floating-shapes .shape {
            display: none;
        }
        
        .card:hover {
            transform: translateY(-5px) scale(1.01);
        }
        
        .jurusan-card:hover {
            transform: translateY(-5px);
        }
    }
    
    /* Smooth Scrolling */
    html {
        scroll-behavior: smooth;
    }
    
hape:nth-child(3) {
        width: 60px;
        height: 60px;
        bottom: 20%;
        left: 20%;
        animation-delay: 4s;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }
    
    .hero-overlay {
        position: relative;
        z-index: 2;
    }
    
    .hero-content {
        animation: fadeInUp 1s ease-out;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .stat-item {
        transition: transform 0.3s ease;
    }
    
    .stat-item:hover {
        transform: translateY(-5px);
    }
    
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }
    
    .btn {
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
    }hape:nth-child(3) {
        width: 60px;
        height: 60px;
        bottom: 20%;
        left: 20%;
        animation-delay: 4s;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }
    
    .hero-overlay {
        position: relative;
        z-index: 2;
    }
    
    .jurusan-icon {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        transition: all 0.3s ease;
    }
    
    .jurusan-card {
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
    }
    
    .jurusan-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        border-left-color: #1e3c72;
    }
    
    .jurusan-card:hover .jurusan-icon {
        transform: scale(1.1) rotate(5deg);
    }
    
    @media (max-width: 768px) {
        .hero-section-bg {
            padding: 4rem 0;
            min-height: 80vh;
        }
        
        .floating-shapes .shape {
            display: none;
        }
        
        .btn-lg {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
        }
    }
</style>
@endpush