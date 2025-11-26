@extends('layouts.app')

@section('title', 'Persyaratan - SMK Bakti Nusantara 666')

@section('content')
@include('components.breadcrumb', ['breadcrumbs' => [['title' => 'Persyaratan PPDB', 'icon' => 'fas fa-clipboard-list']]])

<!-- Hero Section -->
<section class="hero-section text-white text-center">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3">Persyaratan PPDB</h1>
        <p class="lead">Syarat dan ketentuan pendaftaran peserta didik baru tahun ajaran 2026/2027</p>
    </div>
</section>

<!-- Requirements Content -->
<section class="py-5">
    <div class="container">
        <!-- Timeline Steps -->
        <div class="row mb-5">
            <div class="col-12">
                <h2 class="text-center mb-5">Alur Pendaftaran</h2>
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-marker bg-success">1</div>
                        <div class="timeline-content">
                            <h5>Persiapan Dokumen</h5>
                            <p class="text-muted">Siapkan semua dokumen yang diperlukan</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker bg-success">2</div>
                        <div class="timeline-content">
                            <h5>Pendaftaran Online</h5>
                            <p class="text-muted">Isi formulir pendaftaran melalui website</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker bg-success">3</div>
                        <div class="timeline-content">
                            <h5>Verifikasi Dokumen</h5>
                            <p class="text-muted">Submit dokumen untuk verifikasi</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker bg-success">4</div>
                        <div class="timeline-content">
                            <h5>Pengumuman</h5>
                            <p class="text-muted">Cek hasil seleksi dan daftar ulang</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Requirements Cards -->
        <div class="row g-4 mb-5">
            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0"><i class="fas fa-file-alt me-2"></i>Dokumen Wajib</h4>
                    </div>
                    <div class="card-body">
                        <div class="requirement-list">
                            <div class="requirement-item">
                                <i class="fas fa-check-circle text-success me-3"></i>
                                <div>
                                    <strong>Ijazah SMP/MTs</strong>
                                    <p class="text-muted mb-0">Asli dan fotocopy yang telah dilegalisir</p>
                                </div>
                            </div>
                            <div class="requirement-item">
                                <i class="fas fa-check-circle text-success me-3"></i>
                                <div>
                                    <strong>Kartu Keluarga</strong>
                                    <p class="text-muted mb-0">Fotocopy yang masih berlaku</p>
                                </div>
                            </div>
                            <div class="requirement-item">
                                <i class="fas fa-check-circle text-success me-3"></i>
                                <div>
                                    <strong>Akta Kelahiran</strong>
                                    <p class="text-muted mb-0">Fotocopy akta kelahiran siswa</p>
                                </div>
                            </div>
                            <div class="requirement-item">
                                <i class="fas fa-check-circle text-success me-3"></i>
                                <div>
                                    <strong>Pas Foto</strong>
                                    <p class="text-muted mb-0">3x4 sebanyak 6 lembar, background merah</p>
                                </div>
                            </div>
                            <div class="requirement-item">
                                <i class="fas fa-check-circle text-success me-3"></i>
                                <div>
                                    <strong>NISN</strong>
                                    <p class="text-muted mb-0">Nomor Induk Siswa Nasional yang valid</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Syarat Tambahan</h4>
                    </div>
                    <div class="card-body">
                        <div class="requirement-list">
                            <div class="requirement-item">
                                <i class="fas fa-check-circle text-primary me-3"></i>
                                <div>
                                    <strong>Surat Keterangan Sehat</strong>
                                    <p class="text-muted mb-0">Dari dokter atau puskesmas setempat</p>
                                </div>
                            </div>
                            <div class="requirement-item">
                                <i class="fas fa-check-circle text-primary me-3"></i>
                                <div>
                                    <strong>Surat Berkelakuan Baik</strong>
                                    <p class="text-muted mb-0">Dari sekolah asal atau kepolisian</p>
                                </div>
                            </div>
                            <div class="requirement-item">
                                <i class="fas fa-check-circle text-primary me-3"></i>
                                <div>
                                    <strong>Rapor Semester 1-5</strong>
                                    <p class="text-muted mb-0">Fotocopy rapor yang telah dilegalisir</p>
                                </div>
                            </div>
                            <div class="requirement-item">
                                <i class="fas fa-check-circle text-primary me-3"></i>
                                <div>
                                    <strong>Surat Pernyataan</strong>
                                    <p class="text-muted mb-0">Tidak merokok dan mematuhi tata tertib</p>
                                </div>
                            </div>
                            <div class="requirement-item">
                                <i class="fas fa-check-circle text-primary me-3"></i>
                                <div>
                                    <strong>Surat Keterangan Tidak Mampu</strong>
                                    <p class="text-muted mb-0">Jika mengajukan beasiswa (opsional)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Important Notes -->
        <div class="row">
            <div class="col-12">
                <div class="card border-warning">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i>Catatan Penting</h4>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <h6 class="text-warning"><i class="fas fa-calendar me-2"></i>Jadwal Pendaftaran</h6>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-dot-circle text-success me-2"></i>Gelombang 1: 1 Januari - 31 Maret 2026</li>
                                    <li><i class="fas fa-dot-circle text-success me-2"></i>Gelombang 2: 1 April - 30 Juni 2026</li>
                                    <li><i class="fas fa-dot-circle text-success me-2"></i>Gelombang 3: 1 Juli - 31 Juli 2026</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-warning"><i class="fas fa-money-bill me-2"></i>Biaya Pendaftaran</h6>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-dot-circle text-success me-2"></i>Pendaftaran: <strong>GRATIS</strong></li>
                                    <li><i class="fas fa-dot-circle text-success me-2"></i>Daftar Ulang: Rp 500.000</li>
                                    <li><i class="fas fa-dot-circle text-success me-2"></i>SPP/Bulan: Rp 300.000</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="alert alert-info mt-4 mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Tips:</strong> Pastikan semua dokumen sudah lengkap sebelum mendaftar. Dokumen yang tidak lengkap akan memperlambat proses verifikasi.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- CTA Section -->
        <div class="text-center mt-5">
            <div class="bg-light p-5 rounded">
                <h3 class="mb-4">Siap Mendaftar?</h3>
                <p class="text-muted mb-4">Pastikan semua persyaratan sudah terpenuhi, lalu lanjutkan ke proses pendaftaran</p>
                <a href="{{ route('daftar') }}" class="btn btn-success btn-lg me-3">
                    <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                </a>
                <a href="{{ route('kontak') }}" class="btn btn-outline-success btn-lg">
                    <i class="fas fa-question-circle me-2"></i>Ada Pertanyaan?
                </a>
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
    
    .timeline {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin: 2rem 0;
    }
    
    .timeline::before {
        content: '';
        position: absolute;
        top: 20px;
        left: 0;
        right: 0;
        height: 2px;
        background: #e9ecef;
        z-index: 1;
    }
    
    .timeline-item {
        text-align: center;
        flex: 1;
        position: relative;
        z-index: 2;
    }
    
    .timeline-marker {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-weight: bold;
        box-shadow: 0 0 0 4px white;
    }
    
    .requirement-item {
        display: flex;
        align-items: flex-start;
        padding: 1rem 0;
        border-bottom: 1px solid #f8f9fa;
    }
    
    .requirement-item:last-child {
        border-bottom: none;
    }
    
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
    }
    
    @media (max-width: 768px) {
        .timeline {
            flex-direction: column;
        }
        
        .timeline::before {
            display: none;
        }
        
        .timeline-item {
            margin-bottom: 2rem;
        }
    }
</style>
@endpush