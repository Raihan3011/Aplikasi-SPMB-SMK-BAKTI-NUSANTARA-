@extends('layouts.app')

@section('title', 'Daftar Siswa - SMK Bakti Nusantara 666')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Progress Steps -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-6">
                            <div class="step-item active">
                                <div class="step-number bg-success text-white">1</div>
                                <h6 class="mt-2 text-success">Data Siswa</h6>
                                <small class="text-muted">Informasi pribadi siswa</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="step-item">
                                <div class="step-number bg-light text-muted">2</div>
                                <h6 class="mt-2 text-muted">Data Orang Tua</h6>
                                <small class="text-muted">Informasi orang tua/wali</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient-success text-white py-4">
                    <div class="text-center">
                        <i class="fas fa-user-graduate fa-2x mb-2"></i>
                        <h3 class="mb-1">Formulir Pendaftaran PPDB 2026/2027</h3>
                        <p class="mb-0 opacity-75">Langkah 1: Data Siswa</p>
                    </div>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('daftar-siswa.submit') }}" method="POST">
                        @csrf
                        
                        <div class="alert alert-info border-0">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Petunjuk:</strong> Pastikan semua data yang diisi sudah benar. Data yang sudah disubmit tidak dapat diubah.
                        </div>
                        
                        <div class="mb-5">
                            <h4 class="text-success mb-4"><i class="fas fa-user me-2"></i>Data Pribadi Siswa</h4>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"><i class="fas fa-user me-1"></i>Nama Lengkap *</label>
                                    <input type="text" name="nama_lengkap" class="form-control form-control-lg" placeholder="Masukkan nama lengkap" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"><i class="fas fa-id-card me-1"></i>NISN *</label>
                                    <input type="text" name="nisn" class="form-control form-control-lg" placeholder="10 digit NISN" maxlength="10" required>
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"><i class="fas fa-map-marker-alt me-1"></i>Tempat Lahir *</label>
                                    <input type="text" name="tempat_lahir" class="form-control form-control-lg" placeholder="Kota tempat lahir" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"><i class="fas fa-calendar me-1"></i>Tanggal Lahir *</label>
                                    <input type="date" name="tanggal_lahir" class="form-control form-control-lg" required>
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"><i class="fas fa-venus-mars me-1"></i>Jenis Kelamin *</label>
                                    <select name="jenis_kelamin" class="form-select form-select-lg" required>
                                        <option value="">Pilih jenis kelamin...</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"><i class="fas fa-pray me-1"></i>Agama *</label>
                                    <select name="agama" class="form-select form-select-lg" required>
                                        <option value="">Pilih agama...</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label fw-semibold"><i class="fas fa-home me-1"></i>Alamat Lengkap *</label>
                                <textarea name="alamat" class="form-control form-control-lg" rows="3" placeholder="Masukkan alamat lengkap (Jalan, RT/RW, Kelurahan, Kecamatan, Kota)" required></textarea>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"><i class="fas fa-phone me-1"></i>No. Telepon *</label>
                                    <input type="tel" name="no_telepon" class="form-control form-control-lg phone-input" placeholder="08xxxxxxxxxx" maxlength="12" pattern="[0-9]{1,12}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"><i class="fas fa-envelope me-1"></i>Email *</label>
                                    <div class="input-group">
                                        <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="nama@email.com" required>
                                        <button type="button" id="sendOtpBtn" class="btn btn-outline-success">Kirim OTP</button>
                                    </div>
                                    <div id="otpSection" class="mt-3" style="display: none;">
                                        <label class="form-label fw-semibold"><i class="fas fa-key me-1"></i>Kode OTP</label>
                                        <div class="input-group">
                                            <input type="text" id="otpCode" class="form-control" placeholder="Masukkan 6 digit kode OTP" maxlength="6">
                                            <button type="button" id="verifyOtpBtn" class="btn btn-success">Verifikasi</button>
                                        </div>
                                        <small class="text-muted">Kode OTP telah dikirim ke email Anda. Berlaku selama 5 menit.</small>
                                    </div>
                                    <div id="emailVerified" class="mt-2" style="display: none;">
                                        <small class="text-success"><i class="fas fa-check-circle me-1"></i>Email berhasil diverifikasi</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"><i class="fas fa-school me-1"></i>Asal Sekolah *</label>
                                    <input type="text" name="asal_sekolah" class="form-control form-control-lg" placeholder="Nama SMP/MTs asal" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"><i class="fas fa-graduation-cap me-1"></i>Jurusan Pilihan *</label>
                                    <select name="jurusan_pilihan" class="form-select form-select-lg" required>
                                        <option value="">Pilih jurusan yang diminati...</option>
                                        @foreach($jurusans as $jurusan)
                                            <option value="{{ $jurusan->kode_jurusan }}">{{ $jurusan->nama_jurusan }} ({{ $jurusan->kode_jurusan }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-between mt-5">
                            <a href="{{ url('/') }}" class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
                            </a>
                            <button type="submit" id="submitBtn" class="btn btn-success btn-lg" disabled>
                                Lanjut ke Data Orang Tua <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-gradient-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    }
    
    .step-item {
        position: relative;
        padding: 1rem;
    }
    
    .step-number {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        font-weight: bold;
        font-size: 1.1rem;
    }
    
    .step-item.active .step-number {
        box-shadow: 0 0 0 4px rgba(40, 167, 69, 0.2);
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    }
    
    .form-label {
        color: #495057;
        margin-bottom: 0.75rem;
    }
    
    .card {
        border-radius: 15px;
    }
    
    .btn-lg {
        padding: 12px 30px;
        font-weight: 500;
        border-radius: 8px;
    }
    
    .alert {
        border-radius: 10px;
    }
    
    @media (max-width: 768px) {
        .card-body {
            padding: 2rem !important;
        }
        
        .step-item {
            margin-bottom: 1rem;
        }
    }
    
    .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    let emailVerified = false;
    
    // Send OTP
    $('#sendOtpBtn').click(function() {
        const email = $('#email').val();
        
        if (!email) {
            alert('Masukkan email terlebih dahulu');
            return;
        }
        
        $(this).prop('disabled', true).text('Mengirim...');
        
        $.post('{{ route("send-otp") }}', {
            email: email,
            _token: '{{ csrf_token() }}'
        })
        .done(function(response) {
            if (response.success) {
                $('#otpSection').show();
                alert(response.message);
            }
        })
        .fail(function() {
            alert('Gagal mengirim OTP. Coba lagi.');
        })
        .always(function() {
            $('#sendOtpBtn').prop('disabled', false).text('Kirim OTP');
        });
    });
    
    // Verify OTP
    $('#verifyOtpBtn').click(function() {
        const email = $('#email').val();
        const otp = $('#otpCode').val();
        
        if (!otp || otp.length !== 6) {
            alert('Masukkan kode OTP 6 digit');
            return;
        }
        
        $(this).prop('disabled', true).text('Verifikasi...');
        
        $.post('{{ route("verify-otp") }}', {
            email: email,
            otp: otp,
            _token: '{{ csrf_token() }}'
        })
        .done(function(response) {
            if (response.success) {
                emailVerified = true;
                $('#otpSection').hide();
                $('#emailVerified').show();
                $('#submitBtn').prop('disabled', false);
                $('#email').prop('readonly', true);
                alert(response.message);
            } else {
                alert(response.message);
            }
        })
        .fail(function() {
            alert('Gagal verifikasi OTP. Coba lagi.');
        })
        .always(function() {
            $('#verifyOtpBtn').prop('disabled', false).text('Verifikasi');
        });
    });
    

    
    // Form validation
    $('form').submit(function(e) {
        if (!emailVerified) {
            e.preventDefault();
            alert('Harap verifikasi email terlebih dahulu');
        }
    });
});

// Prevent non-numeric input on phone fields
document.addEventListener('DOMContentLoaded', function() {
    const phoneInputs = document.querySelectorAll('.phone-input');
    
    phoneInputs.forEach(function(input) {
        input.addEventListener('keydown', function(e) {
            // Allow: backspace, delete, tab, escape, enter, arrow keys
            if ([8, 9, 27, 13, 37, 38, 39, 40, 46].indexOf(e.keyCode) !== -1 ||
                // Allow: Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
                (e.ctrlKey && [65, 67, 86, 88].indexOf(e.keyCode) !== -1)) {
                return;
            }
            // Block everything except numbers (0-9)
            if (e.keyCode < 48 || e.keyCode > 57) {
                e.preventDefault();
            }
        });
        
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value.length > 12) {
                this.value = this.value.substring(0, 12);
            }
        });
        
        input.addEventListener('paste', function(e) {
            e.preventDefault();
            let paste = (e.clipboardData || window.clipboardData).getData('text');
            paste = paste.replace(/[^0-9]/g, '').substring(0, 12);
            this.value = paste;
        });
    });
});
</script>
@endpush