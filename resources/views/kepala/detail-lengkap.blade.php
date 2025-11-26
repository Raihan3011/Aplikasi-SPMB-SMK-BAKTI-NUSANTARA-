@extends('layouts.app')

@section('title', 'Detail Lengkap PPDB - Kepala Sekolah')

@section('content')
<div class="modern-dashboard">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <div class="header-section">
                        <h1 class="display-6 fw-bold text-gradient mb-2">Detail Lengkap PPDB 2026/2027</h1>
                        <p class="lead text-muted mb-0">Laporan komprehensif penerimaan peserta didik baru</p>
                    </div>
                    <a href="{{ route('kepala.dashboard') }}" class="btn btn-modern-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Modern Summary Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="modern-card card-primary">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper bg-primary">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="ms-3 flex-grow-1">
                                <p class="card-subtitle mb-1">Total Pendaftar</p>
                                <h2 class="card-number mb-0">{{ $stats['total'] }}</h2>
                                <small class="text-success"><i class="fas fa-arrow-up me-1"></i>Calon siswa baru</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="modern-card card-success">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper bg-success">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="ms-3 flex-grow-1">
                                <p class="card-subtitle mb-1">Terverifikasi</p>
                                <h2 class="card-number mb-0">{{ $stats['verified'] }}</h2>
                                <small class="text-success"><i class="fas fa-check me-1"></i>Siap diterima</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="modern-card card-warning">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper bg-warning">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="ms-3 flex-grow-1">
                                <p class="card-subtitle mb-1">Pending</p>
                                <h2 class="card-number mb-0">{{ $stats['pending'] }}</h2>
                                <small class="text-warning"><i class="fas fa-hourglass-half me-1"></i>Menunggu verifikasi</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="modern-card card-danger">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper bg-danger">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <div class="ms-3 flex-grow-1">
                                <p class="card-subtitle mb-1">Ditolak</p>
                                <h2 class="card-number mb-0">{{ $stats['rejected'] }}</h2>
                                <small class="text-danger"><i class="fas fa-times me-1"></i>Tidak memenuhi syarat</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modern Statistics Section -->
        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="modern-card">
                    <div class="card-header-modern">
                        <h5 class="mb-0"><i class="fas fa-chart-pie me-2 text-primary"></i>Statistik per Jurusan</h5>
                    </div>
                    <div class="card-body p-4">
                    @php
                        $jurusanStats = $pendaftars->groupBy('jurusan_pilihan');
                    @endphp
                    
                    @foreach($jurusanStats as $kodeJurusan => $pendaftarJurusan)
                        @php
                            $jurusan = $jurusans->where('kode_jurusan', $kodeJurusan)->first();
                            $total = $pendaftarJurusan->count();
                            $percentage = $stats['total'] > 0 ? round(($total / $stats['total']) * 100) : 0;
                        @endphp
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <h6 class="mb-0 fw-bold">{{ $jurusan->nama_jurusan ?? $kodeJurusan }}</h6>
                                    <small class="text-muted">{{ $total }} pendaftar</small>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-gradient-primary px-3 py-2">{{ $percentage }}%</span>
                                </div>
                            </div>
                            <div class="progress modern-progress" style="height: 12px;">
                                <div class="progress-bar bg-gradient-primary" style="width: {{ $percentage }}%" 
                                     data-bs-toggle="tooltip" title="{{ $total }} dari {{ $stats['total'] }} pendaftar"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

            <div class="col-md-6">
                <div class="modern-card">
                    <div class="card-header-modern">
                        <h5 class="mb-0"><i class="fas fa-clock me-2 text-success"></i>Pendaftar Terbaru</h5>
                    </div>
                    <div class="card-body p-4">
                        @foreach($pendaftars->take(5) as $pendaftar)
                            <div class="modern-list-item d-flex align-items-center p-3 mb-3">
                                <div class="avatar-wrapper me-3">
                                    <div class="avatar bg-gradient-primary">
                                        {{ strtoupper(substr($pendaftar->nama_lengkap, 0, 2)) }}
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 fw-bold">{{ $pendaftar->nama_lengkap }}</h6>
                                    <p class="mb-0 text-muted small">
                                        <i class="fas fa-graduation-cap me-1"></i>{{ $pendaftar->jurusan_pilihan }} • 
                                        <i class="fas fa-clock me-1"></i>{{ $pendaftar->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                <div class="status-badge">
                                    <span class="badge modern-badge 
                                        @if($pendaftar->status_verifikasi === 'verified') badge-success
                                        @elseif($pendaftar->status_verifikasi === 'rejected') badge-danger
                                        @else badge-warning @endif">
                                        @if($pendaftar->status_verifikasi === 'verified')
                                            <i class="fas fa-check me-1"></i>Verified
                                        @elseif($pendaftar->status_verifikasi === 'rejected')
                                            <i class="fas fa-times me-1"></i>Rejected
                                        @else
                                            <i class="fas fa-clock me-1"></i>Pending
                                        @endif
                                    </span>
                                </div>
                            </div>
                        @endforeach
                </div>
            </div>
        </div>
    </div>

        <!-- Modern Data Table -->
        <div class="modern-card">
            <div class="card-header-modern d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0"><i class="fas fa-table me-2 text-info"></i>Daftar Lengkap Pendaftar</h5>
                    <small class="text-muted">Total {{ $stats['total'] }} pendaftar terdaftar</small>
                </div>
                <div class="action-buttons">
                    <button class="btn btn-modern-success" onclick="exportData()">
                        <i class="fas fa-download me-2"></i>Export Excel
                    </button>
                    <button class="btn btn-modern-primary" onclick="printReport()">
                        <i class="fas fa-print me-2"></i>Cetak Laporan
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table modern-table mb-0" id="pendaftarTable">
                        <thead class="modern-table-header">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama Lengkap</th>
                                <th>NISN</th>
                                <th>Email</th>
                                <th>Jurusan</th>
                                <th>Asal Sekolah</th>
                                <th class="text-center">Status</th>
                                <th>Tanggal Daftar</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                    <tbody>
                            @forelse($pendaftars as $index => $pendaftar)
                            <tr class="modern-table-row">
                                <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-gradient-primary me-3">
                                            {{ strtoupper(substr($pendaftar->nama_lengkap, 0, 2)) }}
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold">{{ $pendaftar->nama_lengkap }}</h6>
                                            <small class="text-muted"><i class="fas fa-users me-1"></i>{{ $pendaftar->nama_orangtua }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-light text-dark">{{ $pendaftar->nisn }}</span></td>
                                <td>
                                    <a href="mailto:{{ $pendaftar->email }}" class="text-decoration-none">
                                        <i class="fas fa-envelope me-1 text-primary"></i>{{ $pendaftar->email }}
                                    </a>
                                </td>
                                <td>
                                    @php
                                        $jurusan = $jurusans->where('kode_jurusan', $pendaftar->jurusan_pilihan)->first();
                                    @endphp
                                    <span class="badge bg-info text-white">{{ $jurusan->nama_jurusan ?? $pendaftar->jurusan_pilihan }}</span>
                                </td>
                                <td><small class="text-muted">{{ $pendaftar->asal_sekolah }}</small></td>
                                <td class="text-center">
                                    @if($pendaftar->status_verifikasi === 'verified')
                                        <span class="badge modern-badge badge-success">
                                            <i class="fas fa-check me-1"></i>Verified
                                        </span>
                                    @elseif($pendaftar->status_verifikasi === 'rejected')
                                        <span class="badge modern-badge badge-danger">
                                            <i class="fas fa-times me-1"></i>Rejected
                                        </span>
                                    @else
                                        <span class="badge modern-badge badge-warning">
                                            <i class="fas fa-clock me-1"></i>Pending
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>{{ $pendaftar->created_at->format('d/m/Y') }}<br>
                                        <i class="fas fa-clock me-1"></i>{{ $pendaftar->created_at->format('H:i') }}
                                    </small>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('kepala.detail', $pendaftar->id) }}" class="btn btn-modern-primary btn-sm">
                                        <i class="fas fa-eye me-1"></i>Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">Belum ada data pendaftar</h5>
                                        <p class="text-muted">Data pendaftar akan muncul setelah ada yang mendaftar</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.modern-dashboard {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
}

.text-gradient {
    background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.modern-card {
    background: rgba(255, 255, 255, 0.95);
    border: none;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
}

.modern-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.card-header-modern {
    background: none;
    border: none;
    padding: 1.5rem 1.5rem 0;
}

.icon-wrapper {
    width: 60px;
    height: 60px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}

.card-subtitle {
    color: #6c757d;
    font-size: 0.875rem;
    font-weight: 500;
}

.card-number {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2d3748;
}

.modern-progress {
    border-radius: 10px;
    background: rgba(0, 0, 0, 0.1);
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%) !important;
}

.avatar {
    width: 40px;
    height: 40px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.875rem;
    color: white;
}

.avatar-sm {
    width: 35px;
    height: 35px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.75rem;
    color: white;
}

.modern-list-item {
    background: rgba(255, 255, 255, 0.7);
    border-radius: 15px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.modern-list-item:hover {
    background: rgba(255, 255, 255, 0.9);
    transform: translateX(5px);
}

.modern-badge {
    padding: 0.5rem 1rem;
    border-radius: 25px;
    font-weight: 500;
    font-size: 0.75rem;
}

.badge-success {
    background: linear-gradient(135deg, #48bb78, #38a169) !important;
}

.badge-warning {
    background: linear-gradient(135deg, #ed8936, #dd6b20) !important;
}

.badge-danger {
    background: linear-gradient(135deg, #f56565, #e53e3e) !important;
}

.modern-table {
    border-collapse: separate;
    border-spacing: 0;
}

.modern-table-header th {
    background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
    color: white;
    font-weight: 600;
    padding: 1rem;
    border: none;
    font-size: 0.875rem;
}

.modern-table-header th:first-child {
    border-radius: 15px 0 0 0;
}

.modern-table-header th:last-child {
    border-radius: 0 15px 0 0;
}

.modern-table-row {
    transition: all 0.3s ease;
}

.modern-table-row:hover {
    background: rgba(102, 126, 234, 0.05);
    transform: scale(1.01);
}

.modern-table-row td {
    padding: 1rem;
    border: none;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    vertical-align: middle;
}

.btn-modern-primary {
    background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
    border: none;
    color: white;
    padding: 0.5rem 1.5rem;
    border-radius: 25px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-modern-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    color: white;
}

.btn-modern-success {
    background: linear-gradient(135deg, #48bb78, #38a169);
    border: none;
    color: white;
    padding: 0.5rem 1.5rem;
    border-radius: 25px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-modern-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(72, 187, 120, 0.4);
    color: white;
}

.btn-modern-secondary {
    background: rgba(255, 255, 255, 0.9);
    border: 1px solid rgba(0, 0, 0, 0.1);
    color: #2d3748;
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-modern-secondary:hover {
    background: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    color: #2d3748;
}

.empty-state {
    padding: 3rem 0;
}

@media (max-width: 768px) {
    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .card-number {
        font-size: 2rem;
    }
    
    .icon-wrapper {
        width: 50px;
        height: 50px;
        font-size: 1.25rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
function exportData() {
    // Show loading state
    const btn = event.target;
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Exporting...';
    btn.disabled = true;
    
    // Redirect to export route
    window.location.href = '{{ route("export.pendaftar") }}';
    
    // Reset button after a short delay
    setTimeout(() => {
        btn.innerHTML = originalText;
        btn.disabled = false;
    }, 3000);
}

function printReport() {
    window.print();
}

// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
@endpush