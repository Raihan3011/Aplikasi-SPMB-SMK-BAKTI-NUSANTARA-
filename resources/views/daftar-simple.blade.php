@extends('layouts.app')

@section('title', 'Pendaftaran PPDB - SMK Bakti Nusantara 666')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">Formulir Pendaftaran PPDB 2026/2027</h3>
                    <p class="mb-0 mt-2">SMK Bakti Nusantara 666</p>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('daftar-simple.submit') }}" method="POST">
                        @csrf
                        
                        <!-- Data Siswa -->
                        <div class="mb-4">
                            <h5 class="text-primary mb-3"><i class="fas fa-user me-2"></i>Data Siswa</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lengkap *</label>
                                    <input type="text" name="nama_lengkap" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">NISN *</label>
                                    <input type="text" name="nisn" class="form-control" pattern="[0-9]{8,12}" minlength="8" maxlength="12" title="NISN harus berupa angka 8-12 digit" required>
                                    <div class="form-text">Masukkan 8-12 digit angka NISN</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tempat Lahir *</label>
                                    <input type="text" name="tempat_lahir" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Lahir *</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jenis Kelamin *</label>
                                    <select name="jenis_kelamin" class="form-select" required>
                                        <option value="">Pilih</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. Telepon *</label>
                                    <input type="tel" name="no_telepon" class="form-control" pattern="[0-9]{1,12}" maxlength="12" title="No telepon harus berupa angka maksimal 12 digit" required>
                                    <div class="form-text">Masukkan nomor telepon (maksimal 12 digit)</div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Alamat *</label>
                                    <textarea name="alamat" class="form-control" rows="2" required></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Data Sekolah -->
                        <div class="mb-4">
                            <h5 class="text-success mb-3"><i class="fas fa-school me-2"></i>Data Sekolah</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Asal Sekolah *</label>
                                    <input type="text" name="asal_sekolah" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jurusan Pilihan *</label>
                                    <select name="jurusan_pilihan" class="form-select" required>
                                        <option value="">Pilih Jurusan</option>
                                        @foreach($jurusans as $jurusan)
                                            <option value="{{ $jurusan->kode_jurusan }}">{{ $jurusan->nama_jurusan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Data Orang Tua -->
                        <div class="mb-4">
                            <h5 class="text-warning mb-3"><i class="fas fa-users me-2"></i>Data Orang Tua</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Ayah *</label>
                                    <input type="text" name="nama_ayah" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nama Ibu *</label>
                                    <input type="text" name="nama_ibu" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. Telepon Orang Tua *</label>
                                    <input type="tel" name="no_telepon_orangtua" class="form-control" pattern="[0-9]{1,12}" maxlength="12" title="No telepon orang tua harus berupa angka maksimal 12 digit" required>
                                    <div class="form-text">Masukkan nomor telepon orang tua (maksimal 12 digit)</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email *</label>
                                    <div class="input-group">
                                        <input type="email" name="email" id="email" class="form-control" placeholder="nama@email.com" required>
                                        <button type="button" id="sendOtpBtn" class="btn btn-outline-primary">Kirim OTP</button>
                                    </div>
                                    <div id="otpSection" class="mt-2" style="display: none;">
                                        <div class="input-group">
                                            <input type="text" id="otpCode" class="form-control" placeholder="Kode OTP 6 digit" maxlength="6">
                                            <button type="button" id="verifyOtpBtn" class="btn btn-primary">Verifikasi</button>
                                        </div>
                                        <small class="text-muted">Kode OTP dikirim ke email. Berlaku 5 menit.</small>
                                    </div>
                                    <div id="emailVerified" class="mt-1" style="display: none;">
                                        <small class="text-success"><i class="fas fa-check-circle me-1"></i>Email terverifikasi</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" id="submitBtn" class="btn btn-primary btn-lg" disabled>
                                <i class="fas fa-paper-plane me-2"></i>Daftar Sekarang
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
    .card {
        border-radius: 15px;
        border: none;
    }
    
    .card-header {
        border-radius: 15px 15px 0 0 !important;
    }
    
    .form-control, .form-select {
        border-radius: 8px;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
    
    .btn-primary {
        background: linear-gradient(45deg, #1e3c72, #2a5298);
        border: none;
        border-radius: 8px;
        padding: 12px;
        font-weight: 600;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }
    
    .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
</style>
@endpush

@push('scripts')
<script>
let emailVerified = false;

function sendOtp() {
    const email = document.getElementById('email').value;
    const btn = document.getElementById('sendOtpBtn');
    
    if (!email) {
        alert('Masukkan email terlebih dahulu');
        return;
    }
    
    btn.disabled = true;
    btn.textContent = 'Mengirim...';
    
    fetch('{{ route("send-otp") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ email: email })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('otpSection').style.display = 'block';
            alert(data.message);
        }
    })
    .catch(() => alert('Gagal mengirim OTP'))
    .finally(() => {
        btn.disabled = false;
        btn.textContent = 'Kirim OTP';
    });
}

function verifyOtp() {
    const email = document.getElementById('email').value;
    const otp = document.getElementById('otpCode').value;
    const btn = document.getElementById('verifyOtpBtn');
    
    if (!otp || otp.length !== 6) {
        alert('Masukkan kode OTP 6 digit');
        return;
    }
    
    btn.disabled = true;
    btn.textContent = 'Verifikasi...';
    
    fetch('{{ route("verify-otp") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ email: email, otp: otp })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            emailVerified = true;
            document.getElementById('otpSection').style.display = 'none';
            document.getElementById('emailVerified').style.display = 'block';
            document.getElementById('submitBtn').disabled = false;
            document.getElementById('email').readOnly = true;
            alert(data.message);
        } else {
            alert(data.message);
        }
    })
    .catch(() => alert('Gagal verifikasi OTP'))
    .finally(() => {
        btn.disabled = false;
        btn.textContent = 'Verifikasi';
    });
}

document.getElementById('sendOtpBtn').onclick = sendOtp;
document.getElementById('verifyOtpBtn').onclick = verifyOtp;

document.querySelector('form').onsubmit = function(e) {
    if (!emailVerified) {
        e.preventDefault();
        alert('Harap verifikasi email terlebih dahulu');
        return;
    }
    
    const nisn = document.querySelector('input[name="nisn"]').value;
    if (!/^[0-9]{8,12}$/.test(nisn)) {
        e.preventDefault();
        alert('NISN harus berupa 8-12 digit angka');
        return;
    }
};

// Real-time NISN validation
document.querySelector('input[name="nisn"]').oninput = function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
    if (this.value.length > 12) {
        this.value = this.value.slice(0, 12);
    }
};
</script>
@endpush

