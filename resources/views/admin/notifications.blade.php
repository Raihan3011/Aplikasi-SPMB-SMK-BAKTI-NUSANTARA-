@extends('layouts.app')

@section('title', 'Notifikasi Admin - SMK Bakti Nusantara 666')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-primary">Notifikasi Pendaftaran</h2>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
            </div>
            
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-user-plus fa-2x mb-2"></i>
                            <h4>{{ $pendaftars->where('created_at', '>=', today())->count() }}</h4>
                            <small>Hari Ini</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-calendar-week fa-2x mb-2"></i>
                            <h4>{{ $pendaftars->where('created_at', '>=', now()->startOfWeek())->count() }}</h4>
                            <small>Minggu Ini</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-calendar-alt fa-2x mb-2"></i>
                            <h4>{{ $pendaftars->where('created_at', '>=', now()->startOfMonth())->count() }}</h4>
                            <small>Bulan Ini</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-users fa-2x mb-2"></i>
                            <h4>{{ $pendaftars->count() }}</h4>
                            <small>Total</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Recent Registrations -->
            <div class="card shadow-sm">
                <div class="card-header bg-gradient-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-bell me-2"></i>Pendaftar Terbaru</h5>
                </div>
                <div class="card-body p-0">
                    @php
                        $recentRegistrations = $pendaftars->sortByDesc('created_at')->take(10);
                    @endphp
                    
                    @if($recentRegistrations->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($recentRegistrations as $pendaftar)
                            <div class="list-group-item border-0 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle bg-success text-white me-3">
                                        {{ strtoupper(substr($pendaftar->nama_lengkap, 0, 1)) }}
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1 fw-semibold">{{ $pendaftar->nama_lengkap }}</h6>
                                        <div class="d-flex flex-wrap gap-2 mb-1">
                                            <span class="badge bg-light text-dark">NISN: {{ $pendaftar->nisn }}</span>
                                            <span class="badge bg-primary">{{ $pendaftar->jurusan_pilihan }}</span>
                                            <span class="badge bg-{{ $pendaftar->created_at->isToday() ? 'success' : 'secondary' }}">
                                                {{ $pendaftar->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <small class="text-muted">
                                            <i class="fas fa-envelope me-1"></i>{{ $pendaftar->email }}
                                            <i class="fas fa-phone ms-3 me-1"></i>{{ $pendaftar->no_hp }}
                                        </small>
                                    </div>
                                    <div class="ms-3">
                                        <a href="{{ route('admin.detail', $pendaftar->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye me-1"></i>Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum ada pendaftar</h5>
                            <p class="text-muted">Notifikasi akan muncul ketika ada pendaftar baru</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.avatar-circle {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 18px;
}

.bg-gradient-primary {
    background: linear-gradient(45deg, #1e3c72, #2a5298);
}

.card {
    transition: all 0.3s ease;
}

.list-group-item:hover {
    background-color: #f8f9fa;
}

.badge {
    font-size: 0.75em;
}
</style>
@endpush