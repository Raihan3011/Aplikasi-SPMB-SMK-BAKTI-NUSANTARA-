@extends('layouts.app')

@section('title', 'Dashboard Keuangan - SMK Bakti Nusantara 666')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold">Dashboard Keuangan</h2>
                    <p class="text-muted">Selamat datang, {{ session('user_name') }}</p>
                </div>
                <form method="POST" action="{{ route('auth.logout') }}" class="d-inline" id="logoutForm">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger" onclick="return confirmLogout()">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title">Total Tagihan</h6>
                            <h3 class="mb-0">Rp {{ number_format($stats['total_tagihan'], 0, ',', '.') }}</h3>
                        </div>
                        <i class="fas fa-money-bill-wave fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title">Pembayaran Lunas</h6>
                            <h3 class="mb-0">{{ $stats['lunas'] }}</h3>
                        </div>
                        <i class="fas fa-check-circle fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title">Belum Bayar</h6>
                            <h3 class="mb-0">{{ $stats['belum_bayar'] }}</h3>
                        </div>
                        <i class="fas fa-clock fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title">Total Tagihan</h6>
                            <h3 class="mb-0">{{ $stats['total_count'] }}</h3>
                        </div>
                        <i class="fas fa-receipt fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Pembayaran Pendaftar</h5>
                    <a href="/export/pendaftar" class="btn btn-success btn-sm">
                        <i class="fas fa-download me-1"></i>Export Excel
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NISN</th>
                                    <th>Jurusan</th>
                                    <th>Status Bayar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $pendaftars = \App\Models\Pendaftar::with(['tagihan' => function($query) {
                                        $query->with('pembayaran');
                                    }])->latest()->paginate(10);
                                @endphp
                                @forelse($pendaftars as $index => $pendaftar)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $pendaftar->nama_lengkap }}</td>
                                    <td>{{ $pendaftar->nisn }}</td>
                                    <td>{{ $pendaftar->jurusan_pilihan }}</td>
                                    <td>
                                        @if($pendaftar->tagihan->isEmpty())
                                            <span class="badge bg-secondary">Belum Ada Tagihan</span>
                                        @else
                                            @php 
                                                $tagihan = $pendaftar->tagihan->first();
                                                $pembayaran = $tagihan->pembayaran->first();
                                            @endphp
                                            @if($tagihan->status === 'lunas')
                                                <span class="badge bg-success">Lunas</span>
                                            @elseif(!$pembayaran)
                                                <span class="badge bg-warning">Belum Bayar</span>
                                            @elseif($pembayaran->status_verifikasi === 'pending')
                                                <span class="badge bg-info">Menunggu Verifikasi</span>
                                            @elseif($pembayaran->status_verifikasi === 'verified')
                                                <span class="badge bg-success">Lunas</span>
                                            @else
                                                <span class="badge bg-danger">Pembayaran Ditolak</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if($pendaftar->tagihan->isEmpty())
                                            <button class="btn btn-sm btn-success" onclick="generateTagihan('{{ $pendaftar->id }}')">
                                                <i class="fas fa-file-invoice me-1"></i>Buat Tagihan
                                            </button>
                                        @else
                                            @php 
                                                $tagihan = $pendaftar->tagihan->first();
                                                $pembayaran = $tagihan->pembayaran->first();
                                            @endphp
                                            <div class="d-flex flex-column gap-1">
                                                <span class="badge bg-info">{{ $tagihan->nomor_tagihan }}</span>
                                                <small class="text-muted">Rp {{ number_format($tagihan->jumlah, 0, ',', '.') }}</small>
                                                
                                                @if($pembayaran)
                                                    @if($pembayaran->status_verifikasi === 'pending')
                                                        <a href="{{ route('keuangan.verifikasi-pembayaran', $pembayaran->id) }}" class="btn btn-sm btn-warning">
                                                            <i class="fas fa-clock me-1"></i>Verifikasi
                                                        </a>
                                                    @elseif($pembayaran->status_verifikasi === 'verified')
                                                        <span class="badge bg-success">Terverifikasi</span>
                                                    @else
                                                        <span class="badge bg-danger">Ditolak</span>
                                                    @endif
                                                @else
                                                    <a href="{{ route('keuangan.edit-tagihan', $tagihan->id) }}" class="btn btn-sm btn-secondary">
                                                        <i class="fas fa-edit me-1"></i>Edit
                                                    </a>
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada data pendaftar</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $pendaftars->links() }}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Ringkasan Keuangan</h5>
                </div>
                <div class="card-body">
                    @php
                        $totalPendaftar = App\Models\Pendaftar::count();
                        $biayaPendaftaran = 4500000;
                        $potensiPemasukan = $totalPendaftar * $biayaPendaftaran;
                        $persentaseTerkumpul = $potensiPemasukan > 0 ? round(($stats['total_terkumpul'] / $potensiPemasukan) * 100, 1) : 0;
                    @endphp
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>Total Pendaftar:</span>
                            <strong>{{ $totalPendaftar }}</strong>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>Biaya Pendaftaran:</span>
                            <strong>Rp {{ number_format($biayaPendaftaran, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>Potensi Pemasukan:</span>
                            <strong>Rp {{ number_format($potensiPemasukan, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span><strong>Total Terkumpul:</strong></span>
                        <strong class="text-success">Rp {{ number_format($stats['total_terkumpul'], 0, ',', '.') }}</strong>
                    </div>
                    <div class="mt-2">
                        <div class="d-flex justify-content-between text-muted small">
                            <span>Persentase Terkumpul:</span>
                            <span>{{ $persentaseTerkumpul }}%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmLogout() {
    return confirm('Yakin ingin logout?');
}

function generateTagihan(pendaftarId) {
    if (confirm('Yakin ingin membuat tagihan untuk pendaftar ini?')) {
        // Show loading
        event.target.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Memproses...';
        event.target.disabled = true;
        
        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/keuangan/buat-tagihan/' + pendaftarId;
        
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        form.appendChild(csrfInput);
        document.body.appendChild(form);
        form.submit();
    }
}

// Handle form submission errors
document.addEventListener('DOMContentLoaded', function() {
    const logoutForm = document.getElementById('logoutForm');
    if (logoutForm) {
        logoutForm.addEventListener('submit', function(e) {
            // Refresh CSRF token if needed
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const csrfInput = this.querySelector('input[name="_token"]');
            if (csrfInput) {
                csrfInput.value = token;
            }
        });
    }
});
</script>
@endpush