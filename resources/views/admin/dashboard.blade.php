@extends('admin.layouts_admin.app')

@section('content')
<div id="content" class="app-content">
    <div class="container-fluid">
        {{-- PAGE HEADER --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Dashboard</h1>
                <p class="text-muted mb-0">Analisis data elektronik dan transaksi</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="text-muted small">{{ now()->format('l, d F Y') }}</span>
                <button class="btn btn-sm btn-primary" onclick="refreshDashboard()">
                    <i class="fas fa-sync-alt me-1"></i> Refresh
                </button>
            </div>
        </div>

        {{-- KPI CARDS --}}
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Produk
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $totalElektronik }}
                                </div>
                                <div class="mt-2">
                                    <span class="text-success small">
                                        <i class="fas fa-arrow-up me-1"></i>
                                        12% dari bulan lalu
                                    </span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-boxes fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Pesanan
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $totalPesanan }}
                                </div>
                                <div class="mt-2">
                                    <span class="text-success small">
                                        <i class="fas fa-arrow-up me-1"></i>
                                        8% dari bulan lalu
                                    </span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Pendapatan Bulan Ini
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}
                                </div>
                                <div class="mt-2">
                                    <span class="text-success small">
                                        <i class="fas fa-arrow-up me-1"></i>
                                        15% dari bulan lalu
                                    </span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Stok Menipis
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $stokMenipis }}
                                </div>
                                <div class="mt-2">
                                    <span class="text-danger small">
                                        <i class="fas fa-exclamation-triangle me-1"></i>
                                        Perlu perhatian
                                    </span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-exclamation-triangle fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CHARTS SECTION --}}
        <div class="row">
            <!-- Pendapatan Chart -->
            <div class="col-xl-8 col-lg-7 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Statistik Pendapatan</h6>
                        <div class="dropdown">
                            <select class="form-control form-control-sm" id="periodeChart">
                                <option value="month">Bulan Ini</option>
                                <option value="year">Tahun Ini</option>
                                <option value="week">Minggu Ini</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="pendapatanChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Pesanan Chart -->
            <div class="col-xl-4 col-lg-5 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Status Pesanan</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <canvas id="statusPesananChart" height="200"></canvas>
                        </div>
                        <div class="mt-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span>
                                    <span class="dot bg-success"></span> Dibayar
                                </span>
                                <span class="font-weight-bold">{{ $statusPesanan['dibayar'] ?? 0 }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>
                                    <span class="dot bg-warning"></span> Menunggu
                                </span>
                                <span class="font-weight-bold">{{ $statusPesanan['menunggu'] ?? 0 }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>
                                    <span class="dot bg-danger"></span> Gagal
                                </span>
                                <span class="font-weight-bold">{{ $statusPesanan['gagal'] ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- TABLES SECTION --}}
        <div class="row">
            <!-- Pesanan Terbaru -->
            <div class="col-xl-8 col-lg-7 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Pesanan Terbaru</h6>
                        <a href="{{ route('pesanan') }}" class="btn btn-sm btn-primary">
                            Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th width="50" class="text-center">#</th>
                                        <th>Produk</th>
                                        <th width="120">Pemesan</th>
                                        <th width="80" class="text-center">Jumlah</th>
                                        <th width="120" class="text-end">Total</th>
                                        <th width="100" class="text-center">Status</th>
                                        <th width="120" class="text-center">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pesananTerbaru as $pesanan)
                                    <tr class="align-middle">
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($pesanan->elektronik && $pesanan->elektronik->gambar)
                                                <img src="{{ asset('storage/' . $pesanan->elektronik->gambar) }}" 
                                                     class="rounded me-2" width="40" height="40" 
                                                     alt="{{ $pesanan->elektronik->nama_barang }}">
                                                @else
                                                <div class="rounded me-2 bg-light d-flex align-items-center justify-content-center" 
                                                     style="width: 40px; height: 40px;">
                                                    <i class="fas fa-box text-muted"></i>
                                                </div>
                                                @endif
                                                <div>
                                                    <div class="fw-medium">{{ $pesanan->elektronik->nama_barang ?? '-' }}</div>
                                                    <small class="text-muted">
                                                        {{ Str::limit($pesanan->elektronik->deskripsi ?? '', 30) }}
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-medium">{{ $pesanan->nama_pemesan }}</div>
                                            <small class="text-muted">
                                                {{ Str::limit($pesanan->alamat ?? '', 15) }}
                                            </small>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-secondary px-3 py-1">
                                                {{ $pesanan->jumlah_pesanan }}
                                            </span>
                                        </td>
                                        <td class="text-end fw-bold">
                                            Rp {{ number_format(($pesanan->elektronik->harga ?? 0) * $pesanan->jumlah_pesanan, 0, ',', '.') }}
                                        </td>
                                        <td class="text-center">
                                            @php
                                                $statusClass = [
                                                    'dibayar' => 'success',
                                                    'menunggu' => 'warning',
                                                    'gagal' => 'danger'
                                                ][$pesanan->setatus_pembayaran] ?? 'secondary';
                                            @endphp
                                            <span class="badge bg-{{ $statusClass }} px-3 py-1">
                                                {{ ucfirst($pesanan->setatus_pembayaran) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div>{{ $pesanan->created_at->format('d/m/Y') }}</div>
                                            <small class="text-muted">{{ $pesanan->created_at->format('H:i') }}</small>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">
                                            <i class="fas fa-shopping-cart fa-2x mb-3"></i>
                                            <div>Tidak ada pesanan terbaru</div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Produk Stok Rendah -->
            <div class="col-xl-4 col-lg-5 mb-4">
                <div class="card shadow">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-warning">Produk Stok Rendah</h6>
                        <a href="{{ route('elektronik') }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-box me-1"></i> Kelola
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @forelse($produkStokRendah as $produk)
                            <a href="{{ route('elektronik', $produk->id) }}" 
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3 px-4 border-bottom">
                                <div class="d-flex align-items-center">
                                    @if($produk->gambar)
                                    <img src="{{ asset('storage/' . $produk->gambar) }}" 
                                         class="rounded me-3" width="50" height="50" 
                                         alt="{{ $produk->nama_barang }}">
                                    @else
                                    <div class="rounded me-3 bg-light d-flex align-items-center justify-content-center" 
                                         style="width: 50px; height: 50px;">
                                        <i class="fas fa-box text-muted"></i>
                                    </div>
                                    @endif
                                    <div>
                                        <h6 class="mb-1 fw-medium">{{ Str::limit($produk->nama_barang, 20) }}</h6>
                                        <small class="text-muted">
                                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                        </small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-danger badge-pill px-3 py-2 mb-1 fs-6">
                                        {{ $produk->stok }}
                                    </span>
                                    <small class="d-block text-muted">Stok tersisa</small>
                                </div>
                            </a>
                            @empty
                            <div class="text-center py-5 text-muted">
                                <i class="fas fa-check-circle fa-3x mb-3 text-success"></i>
                                <p class="mb-0 fw-medium">Semua stok aman</p>
                                <small>Tidak ada produk dengan stok rendah</small>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- QUICK STATS --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Ringkasan Hari Ini</h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-3 mb-3">
                                <div class="card border-left-primary h-100">
                                    <div class="card-body">
                                        <div class="text-primary mb-2">
                                            <i class="fas fa-shopping-cart fa-2x"></i>
                                        </div>
                                        <h5 class="card-title">{{ $pesananHariIni }}</h5>
                                        <p class="card-text text-muted">Pesanan Baru</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="card border-left-success h-100">
                                    <div class="card-body">
                                        <div class="text-success mb-2">
                                            <i class="fas fa-money-bill-wave fa-2x"></i>
                                        </div>
                                        <h5 class="card-title">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</h5>
                                        <p class="card-text text-muted">Pendapatan Hari Ini</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="card border-left-info h-100">
                                    <div class="card-body">
                                        <div class="text-info mb-2">
                                            <i class="fas fa-chart-line fa-2x"></i>
                                        </div>
                                        <h5 class="card-title">{{ $produkTerjualHariIni }}</h5>
                                        <p class="card-text text-muted">Produk Terjual</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="card border-left-warning h-100">
                                    <div class="card-body">
                                        <div class="text-warning mb-2">
                                            <i class="fas fa-plus-circle fa-2x"></i>
                                        </div>
                                        <h5 class="card-title">{{ $produkBaruHariIni }}</h5>
                                        <p class="card-text text-muted">Produk Baru</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- RECENT ACTIVITY --}}
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Aktivitas Terbaru</h6>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            @foreach($aktivitasTerbaru as $aktivitas)
                            <div class="timeline-item">
                                <div class="timeline-marker 
                                    {{ $aktivitas['type'] == 'pesanan' ? 'bg-success' : 
                                       ($aktivitas['type'] == 'produk' ? 'bg-primary' : 'bg-warning') }}">
                                </div>
                                <div class="timeline-content">
                                    <h6 class="font-weight-bold">{{ $aktivitas['title'] }}</h6>
                                    <p class="text-muted mb-0">{{ $aktivitas['description'] }}</p>
                                    <small class="text-muted">{{ $aktivitas['time'] }}</small>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Add Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
.dot {
    height: 12px;
    width: 12px;
    border-radius: 50%;
    display: inline-block;
    margin-right: 8px;
}
.border-left-primary { border-left: 4px solid #4e73df !important; }
.border-left-success { border-left: 4px solid #1cc88a !important; }
.border-left-info { border-left: 4px solid #36b9cc !important; }
.border-left-warning { border-left: 4px solid #f6c23e !important; }
.timeline {
    position: relative;
    padding-left: 40px;
}
.timeline-item {
    position: relative;
    margin-bottom: 20px;
}
.timeline-marker {
    position: absolute;
    left: -40px;
    top: 0;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #ddd;
}
.timeline-content {
    padding-left: 20px;
}
.card {
    border-radius: 8px;
    border: none;
}
.table th {
    font-weight: 600;
    color: #495057;
    background-color: #f8f9fa;
    border-bottom: 2px solid #dee2e6;
}
.badge {
    font-weight: 500;
    letter-spacing: 0.5px;
}
.table-responsive {
    border-radius: 8px;
}
.list-group-item {
    border-left: none;
    border-right: none;
    transition: all 0.2s ease;
}
.list-group-item:hover {
    background-color: #f8f9fa;
}
.list-group-item:first-child {
    border-top: none;
}
.list-group-item:last-child {
    border-bottom: none;
}
</style>

<script>
// Initialize Charts when page loads
document.addEventListener('DOMContentLoaded', function() {
    initializeCharts();
});

// Pendapatan Chart
function initializeCharts() {
    // Pendapatan Chart
    const ctx1 = document.getElementById('pendapatanChart').getContext('2d');
    const pendapatanChart = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: @json($chartData['labels'] ?? []),
            datasets: [{
                label: 'Pendapatan',
                data: @json($chartData['values'] ?? []),
                borderColor: '#4e73df',
                backgroundColor: 'rgba(78, 115, 223, 0.05)',
                borderWidth: 2,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#4e73df',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 4
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString();
                        }
                    },
                    grid: {
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            }
        }
    });

    // Status Pesanan Chart
    const ctx2 = document.getElementById('statusPesananChart').getContext('2d');
    const statusPesananChart = new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Dibayar', 'Menunggu', 'Gagal'],
            datasets: [{
                data: [
                    {{ $statusPesanan['dibayar'] ?? 0 }},
                    {{ $statusPesanan['menunggu'] ?? 0 }},
                    {{ $statusPesanan['gagal'] ?? 0 }}
                ],
                backgroundColor: ['#1cc88a', '#f6c23e', '#e74a3b'],
                hoverBackgroundColor: ['#17a673', '#dda20a', '#d52a1e'],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Update chart on period change
    document.getElementById('periodeChart').addEventListener('change', function() {
        fetchChartData(this.value);
    });
}

// Fetch chart data based on period
function fetchChartData(periode) {
    fetch(`/api/dashboard/chart?periode=${periode}`)
        .then(response => response.json())
        .then(data => {
            console.log('Updated chart data:', data);
        });
}

// Refresh dashboard data
function refreshDashboard() {
    const btn = event.target;
    const originalHTML = btn.innerHTML;
    
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Loading...';
    btn.disabled = true;
    
    setTimeout(() => {
        location.reload();
    }, 1000);
}

// Auto-refresh every 2 minutes (optional)
setTimeout(() => {
    location.reload();
}, 120000);
</script>
@endsection