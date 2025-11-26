<!-- Footer -->
<footer class="bg-dark text-white">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('images/baknus.png') }}" alt="Logo" width="50" height="50" class="me-3 rounded">
                    <div>
                        <h5 class="mb-0">SMK Bakti Nusantara 666</h5>
                        <small class="text-muted">Membangun Generasi Unggul</small>
                    </div>
                </div>
                <p class="text-muted">Sekolah Menengah Kejuruan yang berkomitmen menghasilkan lulusan kompeten dan siap kerja sesuai kebutuhan industri.</p>
                <div class="social-links">
                    <a href="https://www.facebook.com/share/16PiFMT7nt/" class="btn btn-outline-light btn-sm me-2" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="https://www.instagram.com/smkbaktinusantara666?igsh=amdlc2Jhd2prZmdx" class="btn btn-outline-light btn-sm me-2" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.youtube.com/@baknustv9545" class="btn btn-outline-light btn-sm me-2" target="_blank"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="btn btn-outline-light btn-sm"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-6">
                <h6 class="text-success mb-3">Menu Utama</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ url('/') }}" class="text-muted text-decoration-none"><i class="fas fa-home me-2"></i>Beranda</a></li>
                    <li class="mb-2"><a href="{{ route('tentang') }}" class="text-muted text-decoration-none"><i class="fas fa-info-circle me-2"></i>Tentang</a></li>
                    <li class="mb-2"><a href="{{ route('jurusan') }}" class="text-muted text-decoration-none"><i class="fas fa-graduation-cap me-2"></i>Jurusan</a></li>
                    <li class="mb-2"><a href="{{ route('kontak') }}" class="text-muted text-decoration-none"><i class="fas fa-phone me-2"></i>Kontak</a></li>
                </ul>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <h6 class="text-success mb-3">PPDB</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('persyaratan') }}" class="text-muted text-decoration-none"><i class="fas fa-clipboard-list me-2"></i>Persyaratan</a></li>
                    <li class="mb-2"><a href="{{ route('daftar') }}" class="text-muted text-decoration-none"><i class="fas fa-user-plus me-2"></i>Daftar Online</a></li>
                    <li class="mb-2"><a href="{{ route('login') }}" class="text-muted text-decoration-none"><i class="fas fa-sign-in-alt me-2"></i>Login</a></li>
                    <li class="mb-2"><a href="{{ route('admin.login') }}" class="text-muted text-decoration-none"><i class="fas fa-user-shield me-2"></i>Admin</a></li>
                </ul>
            </div>
            
            <div class="col-lg-3">
                <h6 class="text-success mb-3">Kontak Info</h6>
                <div class="contact-info">
                    <div class="mb-2">
                        <i class="fas fa-map-marker-alt text-success me-2"></i>
                        <small class="text-muted">Jl. Pendidikan No. 666<br>Jakarta Selatan 12345</small>
                    </div>
                    <div class="mb-2">
                        <i class="fas fa-phone text-success me-2"></i>
                        <small class="text-muted">(021) 666-7777</small>
                    </div>
                    <div class="mb-2">
                        <i class="fas fa-envelope text-success me-2"></i>
                        <small class="text-muted">info@smkbaktinusantara666.sch.id</small>
                    </div>
                    <div class="mb-2">
                        <i class="fas fa-clock text-success me-2"></i>
                        <small class="text-muted">Senin - Jumat: 07:00 - 16:00</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="border-top border-secondary">
        <div class="container py-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 text-muted">&copy; {{ date('Y') }} SMK Bakti Nusantara 666. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <small class="text-muted">PPDB Tahun Ajaran 2026/2027 | Sistem Informasi PPDB v1.0</small>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    footer a:hover {
        color: #28a745 !important;
        transform: translateX(5px);
        transition: all 0.3s ease;
    }
    
    .social-links .btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .social-links .btn:hover {
        background: #28a745;
        border-color: #28a745;
        transform: translateY(-2px);
    }
    
    .contact-info i {
        width: 20px;
    }
</style>