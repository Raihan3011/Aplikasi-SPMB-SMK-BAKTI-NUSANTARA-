@extends('layouts.app')

@section('title', 'Login Siswa - SMK Bakti Nusantara 666')

@section('content')
<section class="login-hero py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-gradient-success text-white text-center py-4">
                        <i class="fas fa-sign-in-alt fa-3x mb-3"></i>
                        <h3 class="mb-1">Login Siswa</h3>
                        <p class="mb-0 opacity-75">Masuk ke dashboard siswa</p>
                    </div>
                    <div class="card-body p-5">
                        @if($errors->any())
                            <div class="alert alert-danger border-0 rounded-3">
                                <i class="fas fa-exclamation-triangle me-2"></i>{{ $errors->first() }}
                            </div>
                        @endif
                        
                        @if(session('error'))
                            <div class="alert alert-danger border-0 rounded-3">
                                <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                            </div>
                        @endif
                        
                        <form action="{{ route('siswa.login.submit') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label fw-semibold"><i class="fas fa-id-card me-2 text-success"></i>NISN atau Email</label>
                                <input type="text" name="email" class="form-control form-control-lg" placeholder="Masukkan NISN atau Email" required>
                                <small class="text-muted">Gunakan NISN (10 digit) atau email yang terdaftar</small>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold"><i class="fas fa-lock me-2 text-success"></i>Password</label>
                                <input type="password" name="password" class="form-control form-control-lg" placeholder="Masukkan NISN sebagai password" required>
                                <small class="text-muted">Gunakan NISN Anda sebagai password</small>
                            </div>
                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="fas fa-sign-in-alt me-2"></i>Masuk ke Dashboard
                                </button>
                            </div>
                        </form>
                        
                        <div class="text-center">
                            <div class="bg-light p-3 rounded">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    <strong>Belum terdaftar?</strong> Silakan <a href="{{ route('daftar') }}" class="text-success">daftar terlebih dahulu</a>
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light text-center">
                        <small class="text-muted">
                            <a href="{{ route('login') }}" class="text-decoration-none">
                                <i class="fas fa-arrow-left me-1"></i>Kembali ke login utama
                            </a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .login-hero {
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.9) 0%, rgba(32, 201, 151, 0.9) 100%), url('{{ asset('images/sa.jpeg') }}') center center/cover;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }
    
    .bg-gradient-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    }
    
    .form-control:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    }
    
    .card {
        border-radius: 15px;
        backdrop-filter: blur(10px);
    }
    
    .btn-lg {
        padding: 12px 30px;
        font-weight: 500;
        border-radius: 8px;
    }
</style>
@endpush