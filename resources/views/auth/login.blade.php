@extends('layouts.app')

@section('title', 'Login - SMK Bakti Nusantara 666')

@section('content')
<section class="login-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white text-center py-4">
                        <h4 class="mb-0"><i class="fas fa-sign-in-alt me-2"></i>Login Sistem PPDB</h4>
                    </div>
                    <div class="card-body p-5">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('auth.login') }}">
                            @csrf
                            
                            <div class="mb-4">
                                <label class="form-label fw-bold">Email/NISN</label>
                                <input type="text" name="email" class="form-control form-control-lg" 
                                       placeholder="Masukkan email atau NISN" required value="{{ old('email') }}">
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" 
                                           class="form-control form-control-lg" placeholder="Masukkan password" required>
                                    <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
                                        <i class="fas fa-eye" id="toggleIcon"></i>
                                    </button>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </button>
                        </form>

                        <div class="text-center">
                            <div class="border-top pt-3">
                                <p class="text-muted mb-2">Belum punya akun?</p>
                                <a href="{{ route('daftar') }}" class="btn btn-outline-success">
                                    <i class="fas fa-user-plus me-2"></i>Daftar PPDB
                                </a>
                            </div>
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
    .login-section {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
    }
    
    .card {
        border-radius: 15px;
        overflow: hidden;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #1e3c72;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    .btn-primary {
        background: linear-gradient(45deg, #1e3c72, #2a5298);
        border: none;
    }
    
    .btn-primary:hover {
        background: linear-gradient(45deg, #5a6fd8, #6a4190);
        transform: translateY(-2px);
    }
</style>
@endpush

@push('scripts')
<script>
function togglePassword() {
    const password = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');
    
    if (password.type === 'password') {
        password.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        password.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}
</script>
@endpush