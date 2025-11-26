@extends('layouts.app')

@section('title', 'Login Admin - SMK Bakti Nusantara 666')

@section('content')
<section class="login-hero py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-gradient-primary text-white text-center py-4">
                        <i class="fas fa-user-shield fa-3x mb-3"></i>
                        <h3 class="mb-1">Portal Admin</h3>
                        <p class="mb-0 opacity-75">Sistem Administrasi PPDB</p>
                    </div>
                    <div class="card-body p-5">
                        @if(session('error'))
                            <div class="alert alert-danger border-0 rounded-3">
                                <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                            </div>
                        @endif
                        
                        <form action="{{ route('admin.login.submit') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label fw-semibold"><i class="fas fa-user me-2 text-primary"></i>Username</label>
                                <input type="text" name="username" class="form-control form-control-lg" placeholder="Masukkan username admin" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold"><i class="fas fa-lock me-2 text-primary"></i>Password</label>
                                <input type="password" name="password" class="form-control form-control-lg" placeholder="Masukkan password" required>
                            </div>
                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-sign-in-alt me-2"></i>Masuk ke Dashboard
                                </button>
                            </div>
                        </form>
                        
                        <div class="text-center">
                            <div class="bg-light p-3 rounded">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    <strong>Demo:</strong> Username: <code>admin</code> | Password: <code>admin123</code>
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light text-center">
                        <small class="text-muted">
                            <a href="{{ route('login') }}" class="text-decoration-none">
                                <i class="fas fa-arrow-left me-1"></i>Kembali ke pilihan login
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
        background: linear-gradient(135deg, rgba(0, 123, 255, 0.9) 0%, rgba(108, 117, 125, 0.9) 100%), url('{{ asset('images/sa.jpeg') }}') center center/cover;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, #007bff 0%, #6c757d 100%);
    }
    
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
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
    
    code {
        background: #f8f9fa;
        padding: 2px 6px;
        border-radius: 4px;
        color: #e83e8c;
    }
</style>
@endpush