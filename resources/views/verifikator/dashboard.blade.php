@extends('layouts.app')

@section('title', 'Dashboard Verifikator - SMK Bakti Nusantara 666')

<style>
@media print {
    .btn, .card-header .d-flex .gap-2, .no-print {
        display: none !important;
    }
    
    .card {
        border: none !important;
        box-shadow: none !important;
    }
    
    .table {
        font-size: 12px;
    }
    
    .badge {
        border: 1px solid #000;
        color: #000 !important;
        background: transparent !important;
    }
}
</style>

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold">Dashboard Verifikator Administrasi</h2>
                    <p class="text-muted">Selamat datang, {{ session('user_name') }}</p>
                </div>
                <form method="POST" action="{{ route('auth.logout') }}" class="d-inline no-print">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title">Total Pendaftar</h6>
                            <h3 class="mb-0">{{ \App\Models\Pendaftar::count() }}</h3>
                        </div>
                        <i class="fas fa-users fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title">Perlu Verifikasi</h6>
                            <h3 class="mb-0">{{ \App\Models\Pendaftar::where('status_verifikasi', 'pending')->count() }}</h3>
                        </div>
                        <i class="fas fa-clock fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title">Terverifikasi</h6>
                            <h3 class="mb-0">{{ \App\Models\Pendaftar::where('status_verifikasi', 'verified')->count() }}</h3>
                        </div>
                        <i class="fas fa-check-circle fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title">Ditolak</h6>
                            <h3 class="mb-0">{{ \App\Models\Pendaftar::where('status_verifikasi', 'rejected')->count() }}</h3>
                        </div>
                        <i class="fas fa-times-circle fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Pendaftar untuk Verifikasi</h5>
            <div class="d-flex gap-2">
                <button class="btn btn-success btn-sm" onclick="exportData()">
                    <i class="fas fa-download me-1"></i>Export Excel
                </button>
                <button class="btn btn-primary btn-sm" onclick="printData()">
                    <i class="fas fa-print me-1"></i>Print
                </button>
            </div>
        </div>
        <div class="card-body">
            <!-- Search & Filter -->
            <div class="row mb-3 no-print">
                <div class="col-md-4">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari nama, NISN, atau email...">
                </div>
                <div class="col-md-3">
                    <select id="filterJurusan" class="form-select">
                        <option value="">Semua Jurusan</option>
                        @foreach(\App\Models\Jurusan::all() as $jurusan)
                            <option value="{{ $jurusan->kode_jurusan }}">{{ $jurusan->nama_jurusan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select id="filterStatus" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="pending">Pending</option>
                        <option value="verified">Terverifikasi</option>
                        <option value="rejected">Ditolak</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-secondary w-100" onclick="resetFilter()">
                        <i class="fas fa-refresh me-1"></i>Reset
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover" id="pendaftarTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>NISN</th>
                            <th>Jurusan</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(\App\Models\Pendaftar::latest()->get() as $index => $pendaftar)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $pendaftar->nama_lengkap }}</td>
                            <td>{{ $pendaftar->nisn }}</td>
                            <td>{{ $pendaftar->jurusan_pilihan }}</td>
                            <td>{{ $pendaftar->email }}</td>
                            <td>
                                @if($pendaftar->status_verifikasi === 'verified')
                                    <span class="badge bg-success">Terverifikasi</span>
                                @elseif($pendaftar->status_verifikasi === 'rejected')
                                    <span class="badge bg-danger">Ditolak</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('verifikator.detail', $pendaftar->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye me-1"></i>Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data pendaftar</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
function exportData() {
    const filterJurusan = document.getElementById('filterJurusan').value;
    const filterStatus = document.getElementById('filterStatus').value;
    
    let url = '{{ route("export.pendaftar") }}';
    let params = [];
    
    if (filterJurusan) {
        params.push('jurusan=' + encodeURIComponent(filterJurusan));
    }
    
    if (filterStatus) {
        params.push('status=' + encodeURIComponent(filterStatus));
    }
    
    if (params.length > 0) {
        url += '?' + params.join('&');
    }
    
    window.location.href = url;
}

function printData() {
    window.print();
}

function resetFilter() {
    document.getElementById('searchInput').value = '';
    document.getElementById('filterJurusan').value = '';
    document.getElementById('filterStatus').value = '';
    filterTable();
}

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const filterJurusan = document.getElementById('filterJurusan');
    const filterStatus = document.getElementById('filterStatus');
    const table = document.getElementById('pendaftarTable');
    const rows = table.querySelectorAll('tbody tr');

    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const jurusanFilter = filterJurusan.value;
        const statusFilter = filterStatus.value;

        rows.forEach(row => {
            if (row.cells.length < 2) return;
            
            const nama = row.cells[1].textContent.toLowerCase();
            const nisn = row.cells[2].textContent.toLowerCase();
            const jurusan = row.cells[3].textContent;
            const email = row.cells[4].textContent.toLowerCase();
            const status = row.querySelector('.badge')?.textContent.toLowerCase() || '';
            
            const matchSearch = nama.includes(searchTerm) || nisn.includes(searchTerm) || email.includes(searchTerm);
            const matchJurusan = !jurusanFilter || jurusan === jurusanFilter;
            const matchStatus = !statusFilter || status.includes(statusFilter.toLowerCase());
            
            row.style.display = matchSearch && matchJurusan && matchStatus ? '' : 'none';
        });
    }
    
    searchInput.addEventListener('input', filterTable);
    filterJurusan.addEventListener('change', filterTable);
    filterStatus.addEventListener('change', filterTable);
});
</script>

@endsection