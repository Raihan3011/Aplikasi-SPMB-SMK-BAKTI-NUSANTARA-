@extends('layouts.app')

@section('title', 'Admin Dashboard - SMK Bakti Nusantara 666')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Dashboard Admin PPDB 2026/2027</h2>
                <div>
                    <a href="{{ route('admin.logout') }}" class="btn btn-outline-danger btn-sm">Logout</a>
                </div>
            </div>
            
            @if(session('new_registration'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="fas fa-bell me-2"></i>
                <strong>Pendaftar Baru!</strong> 
                {{ session('new_registration.nama') }} mendaftar jurusan {{ session('new_registration.jurusan') }} 
                pada {{ session('new_registration.time') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            
            <!-- Statistics Cards -->
            <div class="row g-4 mb-4">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div class="small text-white-50">Total Pendaftar</div>
                                    <div class="h2 mb-0">{{ $pendaftars->count() }}</div>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-users fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div class="small text-white-50">Hari Ini</div>
                                    <div class="h2 mb-0">{{ $pendaftars->filter(function($p) { return $p->created_at->isToday(); })->count() }}</div>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-calendar-day fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div class="small text-white-50">Minggu Ini</div>
                                    <div class="h2 mb-0">{{ $pendaftars->filter(function($p) { return $p->created_at->isCurrentWeek(); })->count() }}</div>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-calendar-week fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-info text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div class="small text-white-50">Bulan Ini</div>
                                    <div class="h2 mb-0">{{ $pendaftars->filter(function($p) { return $p->created_at->isCurrentMonth(); })->count() }}</div>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-calendar-alt fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Charts Row -->
            <div class="row g-4 mb-4">
                <div class="col-lg-6">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Pendaftar per Jurusan</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="jurusanChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card shadow">
                        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Grafik Pendaftaran</h5>
                            <div class="period-buttons">
                                <button class="period-btn active" data-period="daily">
                                    <i class="fas fa-calendar-day me-1"></i>Hari
                                </button>
                                <button class="period-btn" data-period="weekly">
                                    <i class="fas fa-calendar-week me-1"></i>Minggu
                                </button>
                                <button class="period-btn" data-period="monthly">
                                    <i class="fas fa-calendar-alt me-1"></i>Bulan
                                </button>
                                <button class="period-btn" data-period="yearly">
                                    <i class="fas fa-calendar me-1"></i>Tahun
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="dailyChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Data Pendaftar -->
            <div class="card shadow border-0">
                <div class="card-header bg-gradient-primary text-white border-0">
                    <h5 class="mb-0"><i class="fas fa-users me-2"></i>Data Pendaftar PPDB 2026/2027</h5>
                </div>
                <div class="card-body p-0">
                    @forelse($pendaftars as $index => $pendaftar)
                    <div class="modern-card mb-3">
                        <div class="card-content p-4">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="modern-number">
                                        {{ $index + 1 }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="student-profile">
                                        <h6 class="student-name mb-1">{{ $pendaftar->nama_lengkap }}</h6>
                                        <div class="student-nisn">
                                            <i class="fas fa-id-card me-2"></i>{{ $pendaftar->nisn }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="jurusan-badge">
                                        {{ $jurusans[$pendaftar->jurusan_pilihan] ?? $pendaftar->jurusan_pilihan }}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="parent-details">
                                        <div class="parent-name">
                                            <i class="fas fa-user me-2"></i>{{ $pendaftar->nama_orangtua }}
                                        </div>
                                        <div class="parent-phone">
                                            <i class="fas fa-phone me-2"></i>{{ $pendaftar->no_telepon }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="date-info">
                                        <div class="date-main">
                                            <i class="fas fa-calendar me-2"></i>{{ $pendaftar->created_at->format('d/m/Y') }}
                                        </div>
                                        <div class="time-sub">
                                            <i class="fas fa-clock me-2"></i>{{ $pendaftar->created_at->format('H:i') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.detail', $pendaftar->id) }}" class="btn-modern btn-view" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.delete', $pendaftar->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-modern btn-delete" title="Hapus Data">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada data pendaftar</h5>
                        <p class="text-muted">Data pendaftar akan muncul di sini setelah ada yang mendaftar</p>
                    </div>
                    @endforelse
                </div>
            </div>
            
            <!-- Map Domisili -->
            <div class="card shadow border-0 mt-4">
                <div class="card-header bg-gradient-primary text-white border-0">
                    <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>Peta Domisili Pendaftar</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <div id="domicileMap" style="height: 400px; border-radius: 10px;"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="map-legend">
                                <h6 class="fw-bold mb-3">Statistik Domisili</h6>
                                <div id="domicileStats"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
// Data untuk grafik jurusan
const jurusanData = {
    @php
        $jurusanStats = $pendaftars->groupBy('jurusan_pilihan')->map->count();
    @endphp
    labels: {!! json_encode($jurusanStats->keys()) !!},
    datasets: [{
        data: {!! json_encode($jurusanStats->values()) !!},
        backgroundColor: [
            '#FF6384',
            '#36A2EB', 
            '#FFCE56',
            '#4BC0C0',
            '#9966FF',
            '#FF9F40'
        ],
        borderWidth: 2,
        borderColor: '#fff'
    }]
};

// Grafik Pie untuk Jurusan
const jurusanCtx = document.getElementById('jurusanChart').getContext('2d');
new Chart(jurusanCtx, {
    type: 'doughnut',
    data: jurusanData,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 20,
                    usePointStyle: true
                }
            }
        }
    }
});

// Data untuk berbagai periode
const chartData = {
    daily: {
        labels: [],
        data: [],
        title: 'Per Hari (7 Hari Terakhir)'
    },
    weekly: {
        labels: [],
        data: [],
        title: 'Per Minggu (4 Minggu Terakhir)'
    },
    monthly: {
        labels: [],
        data: [],
        title: 'Per Bulan (6 Bulan Terakhir)'
    },
    yearly: {
        labels: [],
        data: [],
        title: 'Per Tahun'
    }
};

@php
    // Data harian (7 hari terakhir)
    $dailyStats = [];
    for ($i = 6; $i >= 0; $i--) {
        $date = now()->subDays($i);
        $count = $pendaftars->filter(function($p) use ($date) { 
            return $p->created_at->isSameDay($date); 
        })->count();
        $dailyStats[] = [
            'label' => $date->format('d/m'),
            'count' => $count
        ];
    }
    
    // Data mingguan (4 minggu terakhir) - Simplified
    $weeklyStats = [
        ['label' => 'Minggu 1', 'count' => 0],
        ['label' => 'Minggu 2', 'count' => 0],
        ['label' => 'Minggu 3', 'count' => 0],
        ['label' => 'Minggu 4', 'count' => 0]
    ];
    
    // Data bulanan (6 bulan terakhir) - Simplified
    $monthlyStats = [
        ['label' => 'Jan 2025', 'count' => 0],
        ['label' => 'Feb 2025', 'count' => 0],
        ['label' => 'Mar 2025', 'count' => 0],
        ['label' => 'Apr 2025', 'count' => 0],
        ['label' => 'Mei 2025', 'count' => 0],
        ['label' => 'Jun 2025', 'count' => 0]
    ];
    
    // Data tahunan - Simplified
    $yearlyStats = [
        ['label' => '2024', 'count' => 0],
        ['label' => '2025', 'count' => $pendaftars->count()]
    ];
@endphp

// Populate chart data
@foreach($dailyStats as $stat)
    chartData.daily.labels.push('{{ $stat["label"] }}');
    chartData.daily.data.push({{ $stat['count'] }});
@endforeach

@foreach($weeklyStats as $stat)
    chartData.weekly.labels.push('{{ $stat["label"] }}');
    chartData.weekly.data.push({{ $stat['count'] }});
@endforeach

@foreach($monthlyStats as $stat)
    chartData.monthly.labels.push('{{ $stat["label"] }}');
    chartData.monthly.data.push({{ $stat['count'] }});
@endforeach

@foreach($yearlyStats as $stat)
    chartData.yearly.labels.push('{{ $stat["label"] }}');
    chartData.yearly.data.push({{ $stat['count'] }});
@endforeach

// Grafik Line untuk Pendaftaran
const dailyCtx = document.getElementById('dailyChart').getContext('2d');
let periodChart = new Chart(dailyCtx, {
    type: 'line',
    data: {
        labels: chartData.daily.labels,
        datasets: [{
            label: 'Pendaftar',
            data: chartData.daily.data,
            borderColor: '#28a745',
            backgroundColor: 'rgba(40, 167, 69, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#28a745',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointRadius: 6
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                },
                grid: {
                    color: 'rgba(0,0,0,0.1)'
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        }
    }
});

// Event listener untuk tombol periode
document.querySelectorAll('.period-btn').forEach(button => {
    button.addEventListener('click', function() {
        // Remove active class from all buttons
        document.querySelectorAll('.period-btn').forEach(btn => btn.classList.remove('active'));
        
        // Add active class to clicked button
        this.classList.add('active');
        
        // Update chart
        const selectedPeriod = this.dataset.period;
        const data = chartData[selectedPeriod];
        
        periodChart.data.labels = data.labels;
        periodChart.data.datasets[0].data = data.data;
        periodChart.update('active');
    });
});

// Initialize Map
document.addEventListener('DOMContentLoaded', function() {
    const map = L.map('domicileMap').setView([-6.2088, 106.8456], 11);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Domicile data
    const domicileData = [
        {name: 'Jakarta Pusat', lat: -6.1751, lng: 106.8650, count: 2, color: '#0d6efd'},
        {name: 'Jakarta Selatan', lat: -6.2615, lng: 106.8106, count: 3, color: '#198754'},
        {name: 'Jakarta Timur', lat: -6.2250, lng: 106.9004, count: 1, color: '#ffc107'},
        {name: 'Jakarta Barat', lat: -6.1352, lng: 106.8133, count: 2, color: '#0dcaf0'},
        {name: 'Jakarta Utara', lat: -6.1384, lng: 106.8759, count: 1, color: '#dc3545'},
        {name: 'Bogor', lat: -6.5971, lng: 106.8060, count: 1, color: '#6c757d'},
        {name: 'Depok', lat: -6.4025, lng: 106.7942, count: 2, color: '#6f42c1'},
        {name: 'Tangerang', lat: -6.1783, lng: 106.6319, count: 1, color: '#fd7e14'},
        {name: 'Bekasi', lat: -6.2383, lng: 106.9756, count: 3, color: '#20c997'}
    ];

    // Add markers
    domicileData.forEach(location => {
        if (location.count > 0) {
            L.circleMarker([location.lat, location.lng], {
                radius: Math.max(10, location.count * 4),
                fillColor: location.color,
                color: '#fff',
                weight: 2,
                opacity: 1,
                fillOpacity: 0.8
            }).addTo(map).bindPopup(`
                <div class="text-center">
                    <h6 class="fw-bold mb-1">${location.name}</h6>
                    <p class="mb-0 text-muted">${location.count} pendaftar</p>
                </div>
            `);
        }
    });

    // Generate statistics
    let statsHtml = '';
    domicileData.forEach(location => {
        if (location.count > 0) {
            statsHtml += `
                <div class="d-flex justify-content-between align-items-center mb-2 p-2 rounded" style="background: rgba(0,0,0,0.02);">
                    <div class="d-flex align-items-center">
                        <div style="width: 12px; height: 12px; border-radius: 50%; background: ${location.color}; margin-right: 8px;"></div>
                        <span class="small fw-medium">${location.name}</span>
                    </div>
                    <span class="badge bg-primary">${location.count}</span>
                </div>
            `;
        }
    });
    
    document.getElementById('domicileStats').innerHTML = statsHtml;
});
</script>

<style>
.card {
    border: none;
    border-radius: 15px;
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.card-header {
    border-radius: 15px 15px 0 0 !important;
    border-bottom: none;
}

.bg-primary {
    background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%) !important;
}

.bg-success {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%) !important;
}

.bg-warning {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%) !important;
}

.bg-info {
    background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%) !important;
}

.table th {
    border-top: none;
    font-weight: 600;
    color: #495057;
}

.badge {
    font-size: 0.875rem;
    padding: 0.5rem 1rem;
}

#jurusanChart, #dailyChart {
    height: 300px !important;
}

.period-buttons {
    display: flex;
    gap: 4px;
    background: rgba(255,255,255,0.1);
    padding: 4px;
    border-radius: 12px;
    backdrop-filter: blur(10px);
}

.period-btn {
    background: transparent;
    border: none;
    color: rgba(255,255,255,0.7);
    padding: 8px 12px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 500;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.period-btn:hover {
    color: white;
    background: rgba(255,255,255,0.1);
    transform: translateY(-1px);
}

.period-btn.active {
    background: rgba(255,255,255,0.2);
    color: white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    transform: translateY(-1px);
}

.modern-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    border: 1px solid #f1f3f4;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
}

.modern-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    border-color: #e3f2fd;
}

.modern-number {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
    color: white;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 16px;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
}

.student-name {
    color: #1a202c;
    font-weight: 600;
    font-size: 16px;
    margin-bottom: 6px;
}

.student-nisn {
    color: #718096;
    font-size: 13px;
    font-weight: 500;
}

.jurusan-badge {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-align: center;
    box-shadow: 0 2px 8px rgba(79, 172, 254, 0.3);
}

.btn-modern {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    font-size: 14px;
    cursor: pointer;
    text-decoration: none;
}

.btn-view {
    background: linear-gradient(135deg, #17a2b8, #138496);
    color: white;
    box-shadow: 0 2px 8px rgba(23, 162, 184, 0.3);
}

.btn-delete {
    background: linear-gradient(135deg, #dc3545, #c82333);
    color: white;
    box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
}

#domicileMap {
    border: 2px solid #e9ecef;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.map-legend {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    border: 1px solid #e9ecef;
}
</style>

@endsection
