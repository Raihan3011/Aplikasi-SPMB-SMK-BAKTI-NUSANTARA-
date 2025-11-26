@extends('layouts.app')

@section('title', 'Detail Pendaftar - Verifikator')



@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold">Detail Pendaftar</h2>
                    <p class="text-muted">Verifikasi data dan berkas pendaftar</p>
                </div>
                <a href="{{ route('verifikator.dashboard') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Data Pendaftar</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <p class="form-control-plaintext">{{ $pendaftar->nama_lengkap }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">NISN</label>
                            <p class="form-control-plaintext">{{ $pendaftar->nisn }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Email</label>
                            <p class="form-control-plaintext">{{ $pendaftar->email }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">No. Telepon</label>
                            <p class="form-control-plaintext">{{ $pendaftar->no_telepon }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Jurusan Pilihan</label>
                            <p class="form-control-plaintext">{{ $jurusan->nama_jurusan ?? $pendaftar->jurusan_pilihan }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Asal Sekolah</label>
                            <p class="form-control-plaintext">{{ $pendaftar->asal_sekolah }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Status Verifikasi</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Status Saat Ini</label>
                        <div>
                            @if($pendaftar->status_verifikasi === 'verified')
                                <span class="badge bg-success fs-6">Terverifikasi</span>
                            @elseif($pendaftar->status_verifikasi === 'rejected')
                                <span class="badge bg-danger fs-6">Ditolak</span>
                            @else
                                <span class="badge bg-warning fs-6">Pending</span>
                            @endif
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-success" onclick="updateStatus('{{ $pendaftar->id }}', 'verified')" 
                                @if($pendaftar->status_verifikasi === 'verified') disabled @endif>
                            <i class="fas fa-check me-2"></i>Verifikasi
                        </button>
                        <button class="btn btn-danger" onclick="updateStatus('{{ $pendaftar->id }}', 'rejected')"
                                @if($pendaftar->status_verifikasi === 'rejected') disabled @endif>
                            <i class="fas fa-times me-2"></i>Tolak
                        </button>
                        @if($pendaftar->status_verifikasi !== 'pending')
                        <button class="btn btn-warning" onclick="updateStatus('{{ $pendaftar->id }}', 'pending')">
                            <i class="fas fa-undo me-2"></i>Reset ke Pending
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function updateStatus(id, status) {
    const statusText = {
        'verified': 'Terverifikasi',
        'rejected': 'Ditolak', 
        'pending': 'Pending'
    };
    
    if (confirm(`Yakin ingin mengubah status menjadi ${statusText[status]}?`)) {
        // Show loading on all buttons
        const buttons = document.querySelectorAll('button');
        buttons.forEach(btn => {
            btn.disabled = true;
            if (btn.textContent.includes('Verifikasi') || btn.textContent.includes('Tolak') || btn.textContent.includes('Reset')) {
                btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
            }
        });
        
        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/verifikator/update-status/${id}`;
        
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        const statusInput = document.createElement('input');
        statusInput.type = 'hidden';
        statusInput.name = 'status';
        statusInput.value = status;
        
        form.appendChild(csrfInput);
        form.appendChild(statusInput);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endpush