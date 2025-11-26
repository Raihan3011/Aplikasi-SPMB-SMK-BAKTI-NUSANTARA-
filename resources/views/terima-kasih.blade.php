@extends('layouts.app')

@section('title', 'Pendaftaran Berhasil - SMK Bakti Nusantara 666')

@section('content')
<section class="success-hero py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5 text-center">
                        <div class="success-animation mb-4">
                            <div class="checkmark-circle">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                        
                        <h1 class="display-5 fw-bold text-success mb-3">Pendaftaran Berhasil!</h1>
                        <div class="alert alert-warning d-inline-block mb-3">
                            <i class="fas fa-clock me-2"></i><strong>Mohon tunggu verifikasi dari pihak sekolah</strong>
                        </div>
                        <h4 class="text-muted mb-4">Terima Kasih atas Kepercayaan Anda</h4>
                        
                        <div class="success-message bg-light p-4 rounded mb-4">
                            <p class="lead mb-0">
                                Terima kasih kepada orang tua/wali yang telah mempercayakan putra/putrinya untuk mendaftar di <strong>SMK Bakti Nusantara 666</strong>. Data pendaftaran telah berhasil tersimpan dalam sistem kami.
                            </p>
                        </div>
                        
                        <!-- Next Steps -->
                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <div class="card h-100 border-success">
                                    <div class="card-header bg-success text-white text-center">
                                        <h5 class="mb-0"><i class="fas fa-clipboard-list me-2"></i>Langkah Selanjutnya</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-unstyled mb-0">
                                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Data pendaftaran telah tersimpan</li>
                                            <li class="mb-2"><i class="fas fa-file-alt text-warning me-2"></i>Lengkapi berkas fisik ke sekolah</li>
                                            <li class="mb-2"><i class="fas fa-bell text-info me-2"></i>Pantau pengumuman di website</li>
                                            <li class="mb-0"><i class="fas fa-phone text-primary me-2"></i>Hubungi sekolah jika ada pertanyaan</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="card h-100 border-info">
                                    <div class="card-header bg-info text-white text-center">
                                        <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Jadwal Penting</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-unstyled mb-0">
                                            <li class="mb-2"><i class="fas fa-calendar text-success me-2"></i>Verifikasi berkas: 3 hari kerja</li>
                                            <li class="mb-2"><i class="fas fa-calendar text-warning me-2"></i>Pengumuman: 7 hari kerja</li>
                                            <li class="mb-2"><i class="fas fa-calendar text-info me-2"></i>Daftar ulang: Setelah pengumuman</li>
                                            <li class="mb-0"><i class="fas fa-calendar text-primary me-2"></i>Orientasi: Juli 2026</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        
                        <!-- Contact Info -->
                        <div class="bg-gradient-success text-white p-4 rounded mb-4">
                            <h5 class="mb-3"><i class="fas fa-phone me-2"></i>Kontak Sekolah</h5>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <i class="fas fa-phone me-2"></i>
                                    <strong>(021) 666-7777</strong>
                                </div>
                                <div class="col-md-4">
                                    <i class="fab fa-whatsapp me-2"></i>
                                    <strong>0812-3456-7890</strong>
                                </div>
                                <div class="col-md-4">
                                    <i class="fas fa-envelope me-2"></i>
                                    <strong>info@smkbaktinusantara666.sch.id</strong>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="d-flex flex-wrap justify-content-center gap-3">
                            <a href="{{ url('/') }}" class="btn btn-success btn-lg">
                                <i class="fas fa-home me-2"></i>Kembali ke Beranda
                            </a>
                            <a href="{{ route('siswa.login') }}" class="btn btn-outline-success btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i>Login Siswa
                            </a>
                            <a href="{{ route('kontak') }}" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-question-circle me-2"></i>Butuh Bantuan?
                            </a>
                        </div>
                        
                        <div class="mt-4">
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Simpan halaman ini sebagai bukti pendaftaran. Anda akan menerima konfirmasi melalui email dalam 1x24 jam.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .success-hero {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
    }
    
    .bg-gradient-success {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%) !important;
    }
    
    .checkmark-circle {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        font-size: 3rem;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        animation: checkmarkPulse 2s ease-in-out infinite;
    }
    
    @keyframes checkmarkPulse {
        0%, 100% {
            transform: scale(1);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }
        50% {
            transform: scale(1.05);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
        }
    }
    
    .card {
        transition: all 0.3s ease;
        border-radius: 15px;
    }
    
    .card:hover {
        transform: translateY(-2px);
    }
    
    .btn-lg {
        padding: 12px 30px;
        font-weight: 500;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
    }
    
    .success-message {
        border-left: 4px solid #28a745;
    }
    

    
    @media (max-width: 768px) {
        .checkmark-circle {
            width: 80px;
            height: 80px;
            font-size: 2rem;
        }
        
        .display-5 {
            font-size: 2rem;
        }
        

    }
</style>
@endpush