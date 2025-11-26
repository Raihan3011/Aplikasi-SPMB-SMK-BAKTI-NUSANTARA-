@extends('layouts.app')

@section('title', 'Daftar Orang Tua - SMK Bakti Nusantara 666')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Progress Steps -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-6">
                            <div class="step-item completed">
                                <div class="step-number bg-success text-white">
                                    <i class="fas fa-check"></i>
                                </div>
                                <h6 class="mt-2 text-success">Data Siswa</h6>
                                <small class="text-muted">Informasi pribadi siswa</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="step-item active">
                                <div class="step-number bg-success text-white">2</div>
                                <h6 class="mt-2 text-success">Data Orang Tua</h6>
                                <small class="text-muted">Informasi orang tua/wali</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient-success text-white py-4">
                    <div class="text-center">
                        <i class="fas fa-users fa-2x mb-2"></i>
                        <h3 class="mb-1">Formulir Pendaftaran PPDB 2026/2027</h3>
                        <p class="mb-0 opacity-75">Langkah 2: Data Orang Tua/Wali</p>
                    </div>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('daftar-orangtua.submit') }}" method="POST">
                        @csrf
                        
                        <div class="alert alert-success border-0 mb-4">
                            <i class="fas fa-check-circle me-2"></i>
                            <strong>Langkah Terakhir!</strong> Lengkapi data orang tua/wali untuk menyelesaikan pendaftaran.
                        </div>
                        
                        <div class="mb-5">
                            <h4 class="text-success mb-4"><i class="fas fa-user-friends me-2"></i>Data Orang Tua/Wali</h4>
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"><i class="fas fa-user me-1"></i>Nama Ayah *</label>
                                    <input type="text" name="nama_ayah" class="form-control form-control-lg" placeholder="Nama lengkap ayah" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"><i class="fas fa-user me-1"></i>Nama Ibu *</label>
                                    <input type="text" name="nama_ibu" class="form-control form-control-lg" placeholder="Nama lengkap ibu" required>
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"><i class="fas fa-briefcase me-1"></i>Pekerjaan Ayah *</label>
                                    <input type="text" name="pekerjaan_ayah" class="form-control form-control-lg" placeholder="Pekerjaan ayah" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"><i class="fas fa-briefcase me-1"></i>Pekerjaan Ibu *</label>
                                    <input type="text" name="pekerjaan_ibu" class="form-control form-control-lg" placeholder="Pekerjaan ibu" required>
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"><i class="fas fa-phone me-1"></i>No. Telepon Ayah *</label>
                                    <input type="tel" name="no_telepon_ayah" class="form-control form-control-lg phone-input" placeholder="08xxxxxxxxxx" maxlength="12" pattern="[0-9]{1,12}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"><i class="fas fa-phone me-1"></i>No. Telepon Ibu</label>
                                    <input type="tel" name="no_telepon_ibu" class="form-control form-control-lg phone-input" placeholder="08xxxxxxxxxx" maxlength="12" pattern="[0-9]{1,12}">
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label fw-semibold"><i class="fas fa-money-bill me-1"></i>Penghasilan Orang Tua/Bulan *</label>
                                <select name="penghasilan_orangtua" class="form-select form-select-lg" required>
                                    <option value="">Pilih range penghasilan...</option>
                                    <option value="< 1 juta">Kurang dari Rp 1.000.000</option>
                                    <option value="1-3 juta">Rp 1.000.000 - Rp 3.000.000</option>
                                    <option value="3-5 juta">Rp 3.000.000 - Rp 5.000.000</option>
                                    <option value="5-10 juta">Rp 5.000.000 - Rp 10.000.000</option>
                                    <option value="> 10 juta">Lebih dari Rp 10.000.000</option>
                                </select>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label fw-semibold"><i class="fas fa-home me-1"></i>Alamat Orang Tua *</label>
                                <textarea name="alamat_orangtua" class="form-control form-control-lg" rows="3" placeholder="Alamat lengkap orang tua (jika berbeda dengan siswa)" required></textarea>
                            </div>
                        </div>
                        
                        <div class="bg-light p-4 rounded mb-4">
                            <h5 class="text-success mb-3"><i class="fas fa-clipboard-check me-2"></i>Pernyataan dan Persetujuan</h5>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="agreement1" required>
                                <label class="form-check-label" for="agreement1">
                                    Saya menyatakan bahwa semua data yang diisi adalah <strong>benar dan dapat dipertanggungjawabkan</strong>
                                </label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="agreement2" required>
                                <label class="form-check-label" for="agreement2">
                                    Saya bersedia mengikuti seluruh <strong>proses seleksi PPDB</strong> SMK Bakti Nusantara 666
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="agreement3" required>
                                <label class="form-check-label" for="agreement3">
                                    Saya menyetujui <strong>syarat dan ketentuan</strong> yang berlaku di SMK Bakti Nusantara 666
                                </label>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-between mt-5">
                            <a href="{{ route('daftar-siswa') }}" class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Data Siswa
                            </a>
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-paper-plane me-2"></i>Selesaikan Pendaftaran
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
    
    .step-item.completed .step-number {
        box-shadow: 0 0 0 4px rgba(40, 167, 69, 0.2);
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    }
    
    .form-check-input:checked {
        background-color: #28a745;
        border-color: #28a745;
    }
    
    .form-check-input:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    }
    
    .card {
        border-radius: 15px;
    }
    
    .btn-lg {
        padding: 12px 30px;
        font-weight: 500;
        border-radius: 8px;
    }
    
    @media (max-width: 768px) {
        .card-body {
            padding: 2rem !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
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