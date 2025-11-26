@extends('layouts.app')

@section('title', 'Dashboard Kepala Sekolah - SMK Bakti Nusantara 666')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold">Dashboard Eksekutif</h2>
                    <p class="text-muted">Selamat datang, {{ session('user_name') }}</p>
                </div>
                <form method="POST" action="{{ route('auth.logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card bg-gradient-primary text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title">Total Pendaftar</h6>
                            <h2 class="mb-0">{{ App\Models\Pendaftar::count() }}</h2>
                            <small class="opacity-75">Calon siswa baru</small>
                        </div>
                        <i class="fas fa-users fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-gradient-success text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title">Terverifikasi</h6>
                            <h2 class="mb-0">{{ App\Models\Pendaftar::where('status_verifikasi', 'verified')->count() }}</h2>
                            <small class="opacity-75">Siap diterima</small>
                        </div>
                        <i class="fas fa-check-circle fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-gradient-info text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title">Potensi Pemasukan</h6>
                            <h2 class="mb-0">{{ number_format(App\Models\Pendaftar::count() * 4500, 0, ',', '.') }}K</h2>
                            <small class="opacity-75">Biaya pendaftaran</small>
                        </div>
                        <i class="fas fa-money-bill-wave fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-gradient-warning text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title">Tingkat Konversi</h6>
                            <h2 class="mb-0">{{ App\Models\Pendaftar::count() > 0 ? round((App\Models\Pendaftar::where('status_verifikasi', 'verified')->count() / App\Models\Pendaftar::count()) * 100) : 0 }}%</h2>
                            <small class="opacity-75">Pendaftar → Siswa</small>
                        </div>
                        <i class="fas fa-chart-line fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Chart Pendaftar per Jurusan -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Statistik Pendaftar per Jurusan</h5>
                </div>
                <div class="card-body">
                    @php
                        $jurusanStats = App\Models\Pendaftar::selectRaw('jurusan_pilihan, COUNT(*) as total')
                            ->groupBy('jurusan_pilihan')
                            ->get();
                    @endphp
                    
                    @if($jurusanStats->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Jurusan</th>
                                        <th>Jumlah Pendaftar</th>
                                        <th>Persentase</th>
                                        <th>Progress</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jurusanStats as $stat)
                                    @php
                                        $percentage = round(($stat->total / App\Models\Pendaftar::count()) * 100);
                                    @endphp
                                    <tr>
                                        <td><strong>{{ $stat->jurusan_pilihan }}</strong></td>
                                        <td>{{ $stat->total }} orang</td>
                                        <td>{{ $percentage }}%</td>
                                        <td>
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-primary" style="width: {{ $percentage }}%"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-chart-bar fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada data pendaftar</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Ringkasan Aktivitas -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-activity me-2"></i>Ringkasan KPI</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="text-muted">Target Pendaftar Tahun Ini</h6>
                        <div class="d-flex justify-content-between align-items-center">
                            <span>{{ App\Models\Pendaftar::count() }} / 200</span>
                            <span class="badge bg-primary">{{ round((App\Models\Pendaftar::count() / 200) * 100) }}%</span>
                        </div>
                        <div class="progress mt-2" style="height: 8px;">
                            <div class="progress-bar" style="width: {{ min((App\Models\Pendaftar::count() / 200) * 100, 100) }}%"></div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="text-muted">Efisiensi Verifikasi</h6>
                        @php
                            $totalPendaftar = App\Models\Pendaftar::count();
                            $terverifikasi = App\Models\Pendaftar::where('status_verifikasi', 'verified')->count();
                            $efisiensi = $totalPendaftar > 0 ? round(($terverifikasi / $totalPendaftar) * 100) : 0;
                        @endphp
                        <div class="d-flex justify-content-between align-items-center">
                            <span>{{ $terverifikasi }} / {{ $totalPendaftar }}</span>
                            <span class="badge bg-success">{{ $efisiensi }}%</span>
                        </div>
                        <div class="progress mt-2" style="height: 8px;">
                            <div class="progress-bar bg-success" style="width: {{ $efisiensi }}%"></div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="text-muted">Pendaftar Hari Ini</h6>
                        @php
                            $pendaftarHariIni = App\Models\Pendaftar::whereDate('created_at', today())->count();
                        @endphp
                        <h3 class="text-primary">{{ $pendaftarHariIni }}</h3>
                        <small class="text-muted">calon siswa baru</small>
                    </div>

                    <div class="d-grid">
                        <a href="{{ route('kepala.detail-lengkap') }}" class="btn btn-primary">
                            <i class="fas fa-eye me-2"></i>Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.bg-gradient-primary {
    background: linear-gradient(45deg, #007bff, #0056b3);
}
.bg-gradient-success {
    background: linear-gradient(45deg, #28a745, #1e7e34);
}
.bg-gradient-info {
    background: linear-gradient(45deg, #17a2b8, #117a8b);
}
.bg-gradient-warning {
    background: linear-gradient(45deg, #ffc107, #e0a800);
}
</style>
@endpush