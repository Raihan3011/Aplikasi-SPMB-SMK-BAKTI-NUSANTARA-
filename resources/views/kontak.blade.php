@extends('layouts.app')

@section('title', 'Kontak - SMK Bakti Nusantara 666')

@section('content')
@include('components.breadcrumb', ['breadcrumbs' => [['title' => 'Kontak', 'icon' => 'fas fa-phone']]])

<!-- Hero Section -->
<section class="hero-section text-white text-center">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3">Hubungi Kami</h1>
        <p class="lead">Kami siap membantu Anda dengan informasi PPDB dan layanan sekolah</p>
    </div>
</section>

<!-- Contact Content -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Contact Info -->
            <div class="col-lg-8">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="contact-icon mb-3">
                                    <i class="fas fa-map-marker-alt fa-3x text-success"></i>
                                </div>
                                <h5 class="card-title">Alamat Sekolah</h5>
                                <p class="text-muted mb-0">Jl. Pendidikan No. 666<br>Jakarta Selatan 12345<br>DKI Jakarta, Indonesia</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="contact-icon mb-3">
                                    <i class="fas fa-phone fa-3x text-success"></i>
                                </div>
                                <h5 class="card-title">Telepon</h5>
                                <p class="text-muted mb-2">(021) 666-7777</p>
                                <p class="text-muted mb-0">WhatsApp: 0812-3456-7890</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="contact-icon mb-3">
                                    <i class="fas fa-envelope fa-3x text-success"></i>
                                </div>
                                <h5 class="card-title">Email</h5>
                                <p class="text-muted mb-2">info@smkbaktinusantara666.sch.id</p>
                                <p class="text-muted mb-0">ppdb@smkbaktinusantara666.sch.id</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="contact-icon mb-3">
                                    <i class="fas fa-globe fa-3x text-success"></i>
                                </div>
                                <h5 class="card-title">Website & Media Sosial</h5>
                                <p class="text-muted mb-2">www.smkbaktinusantara666.sch.id</p>
                                <div class="social-links">
                                    <a href="https://www.facebook.com/share/16PiFMT7nt/" class="btn btn-outline-success btn-sm me-2" target="_blank"><i class="fab fa-facebook"></i></a>
                                    <a href="https://www.instagram.com/smkbaktinusantara666?igsh=amdlc2Jhd2prZmdx" class="btn btn-outline-success btn-sm me-2" target="_blank"><i class="fab fa-instagram"></i></a>
                                    <a href="https://www.youtube.com/@baknustv9545" class="btn btn-outline-success btn-sm" target="_blank"><i class="fab fa-youtube"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Office Hours -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-success text-white text-center">
                        <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Jam Operasional</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h6 class="text-success">Hari Kerja</h6>
                            <p class="mb-1"><strong>Senin - Jumat</strong></p>
                            <p class="text-muted mb-0">07:00 - 16:00 WIB</p>
                        </div>
                        
                        <div class="mb-3">
                            <h6 class="text-success">Sabtu</h6>
                            <p class="mb-1"><strong>Sabtu</strong></p>
                            <p class="text-muted mb-0">07:00 - 12:00 WIB</p>
                        </div>
                        
                        <div class="mb-4">
                            <h6 class="text-success">Minggu & Libur</h6>
                            <p class="text-muted mb-0">Tutup</p>
                        </div>
                        
                        <div class="alert alert-info border-0">
                            <small><i class="fas fa-info-circle me-1"></i><strong>Info PPDB:</strong> Layanan konsultasi PPDB tersedia setiap hari kerja pukul 08:00 - 15:00 WIB</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="bg-light p-5 rounded text-center">
                    <h3 class="mb-4">Butuh Bantuan Segera?</h3>
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-3">
                            <a href="tel:+622166677777" class="btn btn-success btn-lg w-100">
                                <i class="fas fa-phone me-2"></i>Telepon
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="https://wa.me/6281234567890" class="btn btn-outline-success btn-lg w-100" target="_blank">
                                <i class="fab fa-whatsapp me-2"></i>WhatsApp
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="mailto:info@smkbaktinusantara666.sch.id" class="btn btn-outline-success btn-lg w-100">
                                <i class="fas fa-envelope me-2"></i>Email
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('daftar') }}" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-user-plus me-2"></i>Daftar
                            </a>
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
    .hero-section {
        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.4)), url('{{ asset('images/sa.jpeg') }}') center center/cover;
        padding: 8rem 0 6rem;
    }
    
    .contact-icon {
        transition: all 0.3s ease;
    }
    
    .card:hover .contact-icon {
        transform: scale(1.1);
    }
    
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
    }
    
    .social-links .btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endpush