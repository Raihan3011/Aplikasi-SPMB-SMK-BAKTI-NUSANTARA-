<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-gradient-modern fixed-top shadow" id="mainNav">
    <div class="container px-4">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('images/baknus.png') }}" alt="Logo" width="40" height="40" class="me-2 rounded">
            <div>
                <div class="fw-bold">SMK Bakti Nusantara 666</div>
                <small class="opacity-75">PPDB 2026/2027</small>
            </div>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                @if(!request()->is('/'))
                <li class="nav-item">
                    <a class="nav-link px-3" href="{{ url('/') }}">
                        <i class="fas fa-home me-1"></i>Beranda
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link px-3" href="{{ route('tentang') }}">
                        <i class="fas fa-info-circle me-1"></i>Tentang
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3" href="{{ route('persyaratan') }}">
                        <i class="fas fa-clipboard-list me-1"></i>Persyaratan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3" href="{{ route('jurusan') }}">
                        <i class="fas fa-graduation-cap me-1"></i>Jurusan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3" href="{{ route('kontak') }}">
                        <i class="fas fa-phone me-1"></i>Kontak
                    </a>
                </li>
                
                @if(session('user_id'))
                    @include('components.notification-bell')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle px-3" href="#" role="button" data-bs-toggle="dropdown">
                            @if(session('user_role') === 'calon_siswa')
                                <i class="fas fa-user-graduate me-1"></i>{{ session('user_name') }}
                            @elseif(session('user_role') === 'admin_panitia')
                                <i class="fas fa-user-shield me-1"></i>Admin Panitia
                            @elseif(session('user_role') === 'verifikator_administrasi')
                                <i class="fas fa-user-check me-1"></i>Verifikator
                            @elseif(session('user_role') === 'keuangan')
                                <i class="fas fa-money-bill-wave me-1"></i>Keuangan
                            @elseif(session('user_role') === 'kepala_sekolah')
                                <i class="fas fa-crown me-1"></i>Kepala Sekolah
                            @endif
                        </a>
                        <ul class="dropdown-menu">
                            @if(session('user_role') === 'calon_siswa')
                                <li><a class="dropdown-item" href="{{ route('siswa.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                            @elseif(session('user_role') === 'admin_panitia')
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.notifications') }}"><i class="fas fa-bell me-2"></i>Notifikasi</a></li>
                            @elseif(session('user_role') === 'verifikator_administrasi')
                                <li><a class="dropdown-item" href="{{ route('verifikator.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                            @elseif(session('user_role') === 'keuangan')
                                <li><a class="dropdown-item" href="{{ route('keuangan.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                            @elseif(session('user_role') === 'kepala_sekolah')
                                <li><a class="dropdown-item" href="{{ route('kepala.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('auth.logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @elseif(session('admin_logged_in') || session('siswa_logged_in'))
                    <!-- Backward compatibility -->
                    @if(session('admin_logged_in'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle px-3" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-shield me-1"></i>Admin
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.notifications') }}"><i class="fas fa-bell me-2"></i>Notifikasi</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('admin.logout') }}"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle px-3" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-graduate me-1"></i>Siswa
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('siswa.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('siswa.logout') }}"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link px-3" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i>Login
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<style>
    .bg-gradient-modern {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%) !important;
    }
    
    .navbar {
        padding: 0.5rem 0;
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }
    
    .navbar-brand {
        font-weight: bold;
        transition: all 0.3s ease;
    }
    
    .navbar-brand:hover {
        transform: scale(1.05);
    }
    
    .nav-link {
        font-weight: 500;
        transition: all 0.3s ease;
        border-radius: 6px;
        margin: 0 2px;
    }
    
    .nav-link:hover {
        background: rgba(255,255,255,0.1);
        transform: translateY(-1px);
    }
    
    .btn-outline-light {
        border-width: 2px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-outline-light:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    .dropdown-menu {
        border: none;
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        border-radius: 10px;
    }
    
    .dropdown-item {
        padding: 0.75rem 1.5rem;
        transition: all 0.3s ease;
    }
    
    .dropdown-item:hover {
        background: #f8f9fa;
        transform: translateX(5px);
    }
    

    
    .navbar-brand {
        animation: fadeInLeft 1s ease-out 0.3s both;
    }
    
    @keyframes fadeInLeft {
        from {
            transform: translateX(-30px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    .nav-item {
        animation: fadeInUp 0.6s ease-out both;
    }
    
    .nav-item:nth-child(1) { animation-delay: 0.4s; }
    .nav-item:nth-child(2) { animation-delay: 0.5s; }
    .nav-item:nth-child(3) { animation-delay: 0.6s; }
    .nav-item:nth-child(4) { animation-delay: 0.7s; }
    .nav-item:nth-child(5) { animation-delay: 0.8s; }
    .nav-item:nth-child(6) { animation-delay: 0.9s; }
    
    @keyframes fadeInUp {
        from {
            transform: translateY(20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
    
    .navbar-toggler {
        animation: rotateIn 0.8s ease-out 0.5s both;
    }
    
    @keyframes rotateIn {
        from {
            transform: rotate(-180deg);
            opacity: 0;
        }
        to {
            transform: rotate(0);
            opacity: 1;
        }
    }
    
    /* Text Gradient Animation */
    .navbar-brand .fw-bold {
        background: linear-gradient(45deg, #fff, #ffd700, #fff);
        background-size: 200% 200%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: textShine 3s ease-in-out infinite;
    }
    
    @keyframes textShine {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }
    
    /* Advanced Hover Effects */
    .nav-link i {
        transition: all 0.3s ease;
    }
    
    .nav-link:hover i {
        transform: scale(1.2) rotate(15deg);
        color: #ffd700;
        text-shadow: 0 0 10px rgba(255,215,0,0.8);
    }
    
    .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, #ffd700, transparent);
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }
    
    .nav-link:hover::after {
        width: 100%;
        box-shadow: 0 0 10px #ffd700;
    }
    
    /* Luxury Navbar Effects */
    .navbar {
        position: relative;
        box-shadow: 0 2px 15px rgba(30, 60, 114, 0.2);
        animation: luxuryGlow 6s ease-in-out infinite;
    }
    
    @keyframes luxuryGlow {
        0%, 100% { box-shadow: 0 2px 15px rgba(30, 60, 114, 0.2); }
        50% { box-shadow: 0 2px 25px rgba(30, 60, 114, 0.4), 0 0 30px rgba(255, 215, 0, 0.1); }
    }
    
    .navbar-brand img {
        transition: all 0.4s ease;
        filter: drop-shadow(0 0 8px rgba(255,255,255,0.2));
    }
    
    .navbar-brand:hover img {
        transform: scale(1.1);
        filter: drop-shadow(0 0 15px rgba(255,215,0,0.6));
    }
    
    .navbar::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.08), transparent);
        animation: elegantShine 8s infinite;
    }
    
    @keyframes elegantShine {
        0% { left: -100%; }
        100% { left: 100%; }
    }
    

</style>