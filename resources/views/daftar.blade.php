@extends('layouts.app')

@section('title', 'Daftar - SMK Bakti Nusantara 666')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">Formulir Pendaftaran PPDB 2026/2027</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('daftar.submit') }}" method="POST">
                        @csrf
                        
                        <!-- Data Siswa -->
                        <div class="mb-4">
                            <h4 class="text-success mb-3">Data Siswa/Siswi</h4>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lengkap *</label>
                                    <input type="text" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">NISN *</label>
                                    <input type="text" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Tempat Lahir *</label>
                                    <input type="text" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Lahir *</label>
                                    <input type="date" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Jenis Kelamin *</label>
                                    <select class="form-select" required>
                                        <option value="">Pilih...</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Agama *</label>
                                    <select class="form-select" required>
                                        <option value="">Pilih...</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Alamat Lengkap *</label>
                                <textarea class="form-control" rows="3" required></textarea>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">No. Telepon *</label>
                                    <input type="tel" class="form-control phone-input" maxlength="12" pattern="[0-9]{1,12}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control">
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Asal Sekolah *</label>
                                    <input type="text" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jurusan Pilihan *</label>
                                    <select class="form-select" required>
                                        <option value="">Pilih Jurusan...</option>
                                        <option value="RPL">Rekayasa Perangkat Lunak</option>
                                        <option value="AKL">Akuntansi</option>
                                        <option value="DKV">Desain Komunikasi Visual</option>
                                        <option value="PM">Pemasaran</option>
                                        <option value="ANI">Animasi</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <!-- Data Orang Tua -->
                        <div class="mb-4">
                            <h4 class="text-success mb-3">Data Orang Tua/Wali</h4>
                            <div class="mb-3">
                                <label class="form-label">Nama Orang Tua/Wali *</label>
                                <input type="text" class="form-control" required>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Pekerjaan Orang Tua/Wali *</label>
                                    <input type="text" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. Telepon Orang Tua/Wali *</label>
                                    <input type="tel" class="form-control phone-input" maxlength="12" pattern="[0-9]{1,12}" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="agreement" required>
                                <label class="form-check-label" for="agreement">
                                    Saya menyatakan bahwa data yang saya isi adalah benar dan bersedia mengikuti seluruh proses seleksi PPDB SMK Bakti Nusantara 666
                                </label>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ url('/') }}" class="btn btn-secondary me-md-2">Kembali</a>
                            <button type="submit" class="btn btn-success">Daftar Sekarang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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