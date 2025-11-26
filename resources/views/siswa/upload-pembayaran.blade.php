@extends('layouts.app')

@section('title', 'Upload Bukti Pembayaran - SMK Bakti Nusantara 666')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-upload me-2"></i>Upload Bukti Pembayaran</h5>
                </div>
                <div class="card-body p-4">
                    <!-- Info Tagihan -->
                    <div class="alert alert-info">
                        <h6><i class="fas fa-info-circle me-2"></i>Informasi Tagihan</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Nomor Tagihan:</strong> {{ $tagihan->nomor_tagihan }}</p>
                                <p class="mb-1"><strong>Jumlah:</strong> Rp {{ number_format($tagihan->jumlah, 0, ',', '.') }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Jatuh Tempo:</strong> {{ $tagihan->tanggal_jatuh_tempo->format('d/m/Y') }}</p>
                                <p class="mb-0"><strong>Keterangan:</strong> {{ $tagihan->keterangan }}</p>
                            </div>
                        </div>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('siswa.store-pembayaran', $tagihan->id) }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Jumlah Bayar *</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="jumlah_bayar" class="form-control" 
                                           value="{{ $tagihan->jumlah }}" 
                                           readonly style="background-color: #f8f9fa; cursor: not-allowed;">
                                </div>
                                <small class="text-muted">Jumlah pembayaran tidak dapat diubah</small>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tanggal Bayar *</label>
                                <input type="date" name="tanggal_bayar" class="form-control" 
                                       value="{{ old('tanggal_bayar', date('Y-m-d')) }}" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Metode Pembayaran *</label>
                                <select name="metode_pembayaran" class="form-select" required>
                                    <option value="">Pilih metode</option>
                                    <option value="Transfer Bank" {{ old('metode_pembayaran') === 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                                    <option value="QRIS" {{ old('metode_pembayaran') === 'QRIS' ? 'selected' : '' }}>QRIS</option>
                                    <option value="E-Wallet" {{ old('metode_pembayaran') === 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
                                    <option value="Tunai" {{ old('metode_pembayaran') === 'Tunai' ? 'selected' : '' }}>Tunai</option>
                                </select>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Bukti Pembayaran *</label>
                                <input type="file" name="bukti_pembayaran" class="form-control" 
                                       accept="image/*,.pdf" required>
                                <small class="text-muted">Format: JPG, PNG, PDF (Max: 2MB)</small>
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label fw-bold">Keterangan</label>
                                <textarea name="keterangan" class="form-control" rows="3" 
                                          placeholder="Keterangan tambahan (opsional)">{{ old('keterangan') }}</textarea>
                            </div>
                            
                            <div class="col-12">
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('siswa.dashboard') }}" class="btn btn-secondary">
                                        <i class="fas fa-times me-2"></i>Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-upload me-2"></i>Upload Bukti Pembayaran
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- QRIS Payment -->
            <div class="card mt-4 border-warning">
                <div class="card-header bg-warning text-dark">
                    <h6 class="mb-0"><i class="fas fa-qrcode me-2"></i>Pembayaran QRIS</h6>
                </div>
                <div class="card-body text-center">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="qr-code-container p-3">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=00020101021226670016COM.NOBUBANK.WWW01189360050300000898240214{{ $tagihan->nomor_tagihan }}0303UMI51440014ID.CO.QRIS.WWW0215ID20232157845530303UMI5204481253033605802ID5925SMK BAKTI NUSANTARA 6666009JAKARTA10610070703A016304{{ substr(md5($tagihan->nomor_tagihan), 0, 4) }}" 
                                     alt="QRIS Code" class="img-fluid border rounded" style="max-width: 200px;">
                            </div>
                            <p class="text-muted mt-2">Scan QR Code dengan aplikasi pembayaran</p>
                        </div>
                        <div class="col-md-6">
                            <div class="text-start">
                                <h6 class="text-primary mb-3">Cara Pembayaran QRIS:</h6>
                                <ol class="text-muted">
                                    <li>Buka aplikasi pembayaran (GoPay, OVO, DANA, dll)</li>
                                    <li>Pilih menu "Scan QR" atau "Bayar"</li>
                                    <li>Scan QR Code di samping</li>
                                    <li>Masukkan jumlah: <strong>Rp {{ number_format($tagihan->jumlah, 0, ',', '.') }}</strong></li>
                                    <li>Konfirmasi pembayaran</li>
                                    <li>Screenshot bukti pembayaran</li>
                                    <li>Upload bukti di form di atas</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Info Rekening -->
            <div class="card mt-4 border-success">
                <div class="card-header bg-success text-white">
                    <h6 class="mb-0"><i class="fas fa-university me-2"></i>Informasi Rekening & E-Wallet</h6>
                </div>
                <div class="card-body">
                    <h6 class="text-success mb-3"><i class="fas fa-university me-2"></i>Rekening Bank</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="text-center p-3 border rounded">
                                <h6 class="text-primary">Bank BCA</h6>
                                <p class="mb-1"><strong>1234567890</strong></p>
                                <small class="text-muted">a.n. SMK Bakti Nusantara 666</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-3 border rounded">
                                <h6 class="text-primary">Bank Mandiri</h6>
                                <p class="mb-1"><strong>0987654321</strong></p>
                                <small class="text-muted">a.n. SMK Bakti Nusantara 666</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-3 border rounded">
                                <h6 class="text-primary">Bank BRI</h6>
                                <p class="mb-1"><strong>5678901234</strong></p>
                                <small class="text-muted">a.n. SMK Bakti Nusantara 666</small>
                            </div>
                        </div>
                    </div>
                    
                    <h6 class="text-info mb-3"><i class="fas fa-mobile-alt me-2"></i>E-Wallet</h6>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <div class="text-center p-3 border rounded bg-light">
                                <h6 class="text-success">GoPay</h6>
                                <p class="mb-1"><strong>081234567890</strong></p>
                                <small class="text-muted">SMK Bakti Nusantara 666</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center p-3 border rounded bg-light">
                                <h6 class="text-primary">OVO</h6>
                                <p class="mb-1"><strong>081234567891</strong></p>
                                <small class="text-muted">SMK Bakti Nusantara 666</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center p-3 border rounded bg-light">
                                <h6 class="text-info">DANA</h6>
                                <p class="mb-1"><strong>081234567892</strong></p>
                                <small class="text-muted">SMK Bakti Nusantara 666</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center p-3 border rounded bg-light">
                                <h6 class="text-warning">ShopeePay</h6>
                                <p class="mb-1"><strong>081234567893</strong></p>
                                <small class="text-muted">SMK Bakti Nusantara 666</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection