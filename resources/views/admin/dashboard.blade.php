@extends('admin.layouts_admin.app')

@section('content')
<div id="content" class="app-content">
    <div class="container-fluid">
        {{-- PAGE HEADER --}}
        <div class="row align-items-center mb-4">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 d-flex align-items-center justify-content-center">
                        <i class="fas fa-chart-line text-primary fs-4"></i>
                    </div>
                    <div>
                        <h1 class="h2 mb-1 fw-bold text-dark">Dashboard Analytics</h1>
                        <p class="text-muted mb-0 d-flex align-items-center gap-2">
                            <i class="fas fa-calendar-alt"></i>
                            <span>{{ now()->isoFormat('dddd, D MMMM YYYY') }}</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex align-items-center justify-content-end gap-2">
                    <div class="d-flex align-items-center bg-light rounded-pill px-3 py-2">
                        <i class="fas fa-clock text-primary me-2"></i>
                        <span class="text-dark fw-medium">{{ now()->format('H:i') }}</span>
                    </div>
                    <button class="btn btn-primary rounded-pill px-4" onclick="refreshDashboard()">
                        <i class="fas fa-sync-alt me-2"></i> Refresh Data
                    </button>
                </div>
            </div>
        </div>

        {{-- KPI CARDS --}}
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-hover border-0 shadow-lg h-100" style="border-top: 4px solid #4e73df;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="text-muted small fw-semibold text-uppercase mb-1">Total Produk</div>
                                <h2 class="fw-bold text-dark mb-0 display-6">{{ $totalElektronik }}</h2>
                                <div class="mt-3">
                                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-1 rounded-pill">
                                        <i class="fas fa-arrow-up me-1"></i>12% dari bulan lalu
                                    </span>
                                </div>
                            </div>
                            <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                                <i class="fas fa-boxes fs-2 text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 py-3 px-4">
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Total semua produk elektronik
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-hover border-0 shadow-lg h-100" style="border-top: 4px solid #1cc88a;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="text-muted small fw-semibold text-uppercase mb-1">Total Pesanan</div>
                                <h2 class="fw-bold text-dark mb-0 display-6">{{ $totalPesanan }}</h2>
                                <div class="mt-3">
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-1 rounded-pill">
                                        <i class="fas fa-arrow-up me-1"></i>8% dari bulan lalu
                                    </span>
                                </div>
                            </div>
                            <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                                <i class="fas fa-shopping-cart fs-2 text-success"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 py-3 px-4">
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Total transaksi yang masuk
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-hover border-0 shadow-lg h-100" style="border-top: 4px solid #36b9cc;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="text-muted small fw-semibold text-uppercase mb-1">Pendapatan Bulan Ini</div>
                                <h2 class="fw-bold text-dark mb-0 display-6">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</h2>
                                <div class="mt-3">
                                    <span class="badge bg-info bg-opacity-10 text-info px-3 py-1 rounded-pill">
                                        <i class="fas fa-arrow-up me-1"></i>15% dari bulan lalu
                                    </span>
                                </div>
                            </div>
                            <div class="bg-info bg-opacity-10 p-3 rounded-circle">
                                <i class="fas fa-wallet fs-2 text-info"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 py-3 px-4">
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Total pendapatan bulan ini
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-hover border-0 shadow-lg h-100" style="border-top: 4px solid #f6c23e;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="text-muted small fw-semibold text-uppercase mb-1">Stok Menipis</div>
                                <h2 class="fw-bold text-dark mb-0 display-6">{{ $stokMenipis }}</h2>
                                <div class="mt-3">
                                    <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-1 rounded-pill">
                                        <i class="fas fa-exclamation-triangle me-1"></i>Perlu perhatian
                                    </span>
                                </div>
                            </div>
                            <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                                <i class="fas fa-exclamation-triangle fs-2 text-warning"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 py-3 px-4">
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Produk dengan stok kurang dari 10
                        </small>
                    </div>
                </div>
            </div>
        </div>

        {{-- CHARTS SECTION --}}
        <div class="row mb-4">
            <!-- Pendapatan Chart -->
            <div class="col-xl-8 mb-4">
                <div class="card border-0 shadow-lg h-100">
                    <div class="card-header bg-transparent border-0 py-4 px-4 d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="mb-1 fw-bold">Statistik Pendapatan</h5>
                            <p class="text-muted small mb-0">Grafik perkembangan pendapatan</p>
                        </div>
                        <div class="dropdown">
                            <select class="form-select border-0 bg-light rounded-pill px-4 py-2" id="periodeChart">
                                <option value="month">Bulan Ini</option>
                                <option value="year">Tahun Ini</option>
                                <option value="week">Minggu Ini</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="chart-area" style="height: 300px;">
                            <canvas id="pendapatanChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Pesanan Chart -->
            <div class="col-xl-4 mb-4">
                <div class="card border-0 shadow-lg h-100">
                    <div class="card-header bg-transparent border-0 py-4 px-4">
                        <h5 class="mb-1 fw-bold">Status Pesanan</h5>
                        <p class="text-muted small mb-0">Distribusi status pembayaran</p>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-center mb-4">
                            <div style="width: 200px; height: 200px;">
                                <canvas id="statusPesananChart"></canvas>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-4">
                                <div class="text-center p-3 rounded-3 bg-success bg-opacity-10">
                                    <div class="h4 fw-bold text-success mb-1">{{ $statusPesanan['dibayar'] ?? 0 }}</div>
                                    <div class="small">Dibayar</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="text-center p-3 rounded-3 bg-warning bg-opacity-10">
                                    <div class="h4 fw-bold text-warning mb-1">{{ $statusPesanan['menunggu'] ?? 0 }}</div>
                                    <div class="small">Menunggu</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="text-center p-3 rounded-3 bg-danger bg-opacity-10">
                                    <div class="h4 fw-bold text-danger mb-1">{{ $statusPesanan['gagal'] ?? 0 }}</div>
                                    <div class="small">Gagal</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- TABLES SECTION --}}
        <div class="row mb-4">
            <!-- Pesanan Terbaru -->
            <div class="col-xl-8 mb-4">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-transparent border-0 py-4 px-4 d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="mb-1 fw-bold">Pesanan Terbaru</h5>
                            <p class="text-muted small mb-0">5 pesanan terbaru yang masuk</p>
                        </div>
                        <a href="{{ route('pesanan') }}" class="btn btn-outline-primary rounded-pill px-4">
                            Lihat Semua <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive rounded-3">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 rounded-start">Produk</th>
                                        <th class="border-0">Pemesan</th>
                                        <th class="border-0 text-center">Jumlah</th>
                                        <th class="border-0 text-end">Total</th>
                                        <th class="border-0 text-center">Status</th>
                                        <th class="border-0 text-center rounded-end">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pesananTerbaru as $pesanan)
                                    <tr class="border-bottom">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="position-relative">
                                                    @if($pesanan->elektronik && $pesanan->elektronik->gambar)
                                                    <img src="{{ asset('storage/' . $pesanan->elektronik->gambar) }}" 
                                                         class="rounded-2 me-3" width="45" height="45" 
                                                         alt="{{ $pesanan->elektronik->nama_barang }}">
                                                    @else
                                                    <div class="rounded-2 bg-light d-flex align-items-center justify-content-center me-3" 
                                                         style="width: 45px; height: 45px;">
                                                        <i class="fas fa-box text-muted"></i>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 fw-medium">{{ Str::limit($pesanan->elektronik->nama_barang ?? '-', 20) }}</h6>
                                                    <small class="text-muted">{{ Str::limit($pesanan->elektronik->kategori ?? 'Uncategorized', 15) }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-medium">{{ $pesanan->nama_pemesan }}</div>
                                            <small class="text-muted">{{ Str::limit($pesanan->email ?? '', 20) }}</small>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-dark rounded-pill px-3 py-2">
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
                                            <span class="badge bg-{{ $statusClass }} rounded-pill px-3 py-2">
                                                {{ ucfirst($pesanan->setatus_pembayaran) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="fw-medium">{{ $pesanan->created_at->format('d/m/Y') }}</div>
                                            <small class="text-muted">{{ $pesanan->created_at->format('H:i') }}</small>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <div class="py-4">
                                                <i class="fas fa-shopping-cart fa-3x text-light mb-3"></i>
                                                <h5 class="text-muted">Tidak ada pesanan terbaru</h5>
                                                <p class="text-muted small">Belum ada transaksi yang masuk hari ini</p>
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

            <!-- Produk Stok Rendah -->
            <div class="col-xl-4 mb-4">
                <div class="card border-0 shadow-lg h-100">
                    <div class="card-header bg-transparent border-0 py-4 px-4 d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="mb-1 fw-bold text-warning">Produk Stok Rendah</h5>
                            <p class="text-muted small mb-0">Segera lakukan restock</p>
                        </div>
                        <a href="{{ route('elektronik') }}" class="btn btn-outline-warning rounded-pill px-4">
                            <i class="fas fa-box me-2"></i> Kelola
                        </a>
                    </div>
                    <div class="card-body p-4">
                        <div class="list-group list-group-flush">
                            @forelse($produkStokRendah as $produk)
                            <div class="list-group-item border-0 px-0 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="position-relative">
                                        @if($produk->gambar)
                                        <img src="{{ asset('storage/' . $produk->gambar) }}" 
                                             class="rounded-2 me-3" width="50" height="50" 
                                             alt="{{ $produk->nama_barang }}">
                                        @else
                                        <div class="rounded-2 bg-light d-flex align-items-center justify-content-center me-3" 
                                             style="width: 50px; height: 50px;">
                                            <i class="fas fa-box text-muted"></i>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 fw-medium">{{ Str::limit($produk->nama_barang, 22) }}</h6>
                                        <small class="text-muted">Stok: {{ $produk->stok }} unit</small>
                                    </div>
                                    <div class="text-end">
                                        <div class="fw-bold text-danger">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
                                        <small class="text-muted">per unit</small>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-5">
                                <div class="rounded-circle bg-success bg-opacity-10 p-4 d-inline-flex align-items-center justify-content-center mb-3">
                                    <i class="fas fa-check-circle fa-2x text-success"></i>
                                </div>
                                <h5 class="text-success fw-medium">Stok Aman</h5>
                                <p class="text-muted small">Semua produk memiliki stok yang mencukupi</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- QUICK STATS --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-transparent border-0 py-4 px-4">
                        <h5 class="mb-1 fw-bold">Ringkasan Hari Ini</h5>
                        <p class="text-muted small mb-0">Statistik performa hari ini</p>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-3 col-6">
                                <div class="card border-0 bg-primary bg-opacity-5 h-100 hover-lift">
                                    <div class="card-body text-center p-4">
                                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 d-inline-flex align-items-center justify-content-center mb-3">
                                            <i class="fas fa-shopping-cart fa-lg text-primary"></i>
                                        </div>
                                        <h3 class="fw-bold text-dark mb-1">{{ $pesananHariIni }}</h3>
                                        <p class="text-muted mb-0">Pesanan Baru</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="card border-0 bg-success bg-opacity-5 h-100 hover-lift">
                                    <div class="card-body text-center p-4">
                                        <div class="rounded-circle bg-success bg-opacity-10 p-3 d-inline-flex align-items-center justify-content-center mb-3">
                                            <i class="fas fa-wallet fa-lg text-success"></i>
                                        </div>
                                        <h3 class="fw-bold text-dark mb-1">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</h3>
                                        <p class="text-muted mb-0">Pendapatan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="card border-0 bg-info bg-opacity-5 h-100 hover-lift">
                                    <div class="card-body text-center p-4">
                                        <div class="rounded-circle bg-info bg-opacity-10 p-3 d-inline-flex align-items-center justify-content-center mb-3">
                                            <i class="fas fa-chart-line fa-lg text-info"></i>
                                        </div>
                                        <h3 class="fw-bold text-dark mb-1">{{ $produkTerjualHariIni }}</h3>
                                        <p class="text-muted mb-0">Produk Terjual</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="card border-0 bg-warning bg-opacity-5 h-100 hover-lift">
                                    <div class="card-body text-center p-4">
                                        <div class="rounded-circle bg-warning bg-opacity-10 p-3 d-inline-flex align-items-center justify-content-center mb-3">
                                            <i class="fas fa-plus-circle fa-lg text-warning"></i>
                                        </div>
                                        <h3 class="fw-bold text-dark mb-1">{{ $produkBaruHariIni }}</h3>
                                        <p class="text-muted mb-0">Produk Baru</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- RECENT ACTIVITY --}}
        @if(isset($aktivitasTerbaru) && count($aktivitasTerbaru) > 0)
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-transparent border-0 py-4 px-4">
                        <h5 class="mb-1 fw-bold">Aktivitas Terbaru</h5>
                        <p class="text-muted small mb-0">Riwayat aktivitas sistem</p>
                    </div>
                    <div class="card-body p-4">
                        <div class="timeline">
                            @foreach($aktivitasTerbaru as $aktivitas)
                            <div class="timeline-item d-flex mb-3">
                                <div class="timeline-marker flex-shrink-0 me-3">
                                    <div class="rounded-circle p-2 bg-{{ 
                                        $aktivitas['type'] == 'pesanan' ? 'success' : 
                                        ($aktivitas['type'] == 'produk' ? 'primary' : 'warning') 
                                    }}-10 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-{{
                                            $aktivitas['type'] == 'pesanan' ? 'shopping-cart' : 
                                            ($aktivitas['type'] == 'produk' ? 'box' : 'bell')
                                        }} text-{{ 
                                            $aktivitas['type'] == 'pesanan' ? 'success' : 
                                            ($aktivitas['type'] == 'produk' ? 'primary' : 'warning') 
                                        }}"></i>
                                    </div>
                                </div>
                                <div class="timeline-content flex-grow-1">
                                    <h6 class="fw-medium mb-1">{{ $aktivitas['title'] }}</h6>
                                    <p class="text-muted mb-1 small">{{ $aktivitas['description'] }}</p>
                                    <small class="text-muted">
                                        <i class="far fa-clock me-1"></i>{{ $aktivitas['time'] }}
                                    </small>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Add Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
:root {
    --primary-color: #4e73df;
    --success-color: #1cc88a;
    --info-color: #36b9cc;
    --warning-color: #f6c23e;
    --danger-color: #e74a3b;
}

.card-hover:hover {
    transform: translateY(-5px);
    transition: all 0.3s ease;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
}

.hover-lift:hover {
    transform: translateY(-3px);
    transition: transform 0.2s ease;
}

.timeline-item {
    border-left: 2px solid #f0f0f0;
    padding-left: 1.5rem;
    position: relative;
}

.timeline-marker {
    position: absolute;
    left: -0.75rem;
    top: 0;
    width: 1.5rem;
    height: 1.5rem;
}

.timeline-content {
    padding-bottom: 1rem;
}

.table thead th {
    font-weight: 600;
    color: #6c757d;
    background-color: #f8f9fa;
    border-bottom: 2px solid #e9ecef;
    padding: 1rem;
}

.table tbody tr {
    transition: background-color 0.2s ease;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
}

.badge {
    font-weight: 500;
    padding: 0.5rem 1rem;
}

.bg-primary-10 { background-color: rgba(78, 115, 223, 0.1); }
.bg-success-10 { background-color: rgba(28, 200, 138, 0.1); }
.bg-info-10 { background-color: rgba(54, 185, 204, 0.1); }
.bg-warning-10 { background-color: rgba(246, 194, 62, 0.1); }
.bg-danger-10 { background-color: rgba(231, 74, 59, 0.1); }

.rounded-2 { border-radius: 10px; }
.rounded-3 { border-radius: 15px; }

.shadow-lg {
    box-shadow: 0 5px 20px rgba(0,0,0,0.08) !important;
}

.display-6 {
    font-size: 2.5rem;
    font-weight: 700;
}

@media (max-width: 768px) {
    .display-6 {
        font-size: 2rem;
    }
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
                backgroundColor: 'rgba(78, 115, 223, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#4e73df',
                pointBorderColor: '#fff',
                pointBorderWidth: 3,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    titleFont: {
                        size: 14
                    },
                    bodyFont: {
                        size: 14
                    },
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        },
                        font: {
                            size: 11
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 11
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
                backgroundColor: [
                    'rgba(28, 200, 138, 0.8)',
                    'rgba(246, 194, 62, 0.8)',
                    'rgba(231, 74, 59, 0.8)'
                ],
                borderColor: [
                    'rgba(28, 200, 138, 1)',
                    'rgba(246, 194, 62, 1)',
                    'rgba(231, 74, 59, 1)'
                ],
                borderWidth: 2,
                hoverOffset: 15
            }]
        },
        options: {
            maintainAspectRatio: false,
            cutout: '75%',
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    bodyFont: {
                        size: 14
                    }
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
    const btn = event.currentTarget;
    const originalHTML = btn.innerHTML;
    
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Loading...';
    btn.disabled = true;
    
    // Add loading animation to cards
    document.querySelectorAll('.card-hover').forEach(card => {
        card.classList.add('opacity-75');
    });
    
    setTimeout(() => {
        location.reload();
    }, 1500);
}

// Auto-refresh every 5 minutes (optional)
setTimeout(() => {
    if (confirm('Dashboard akan direfresh secara otomatis. Lanjutkan?')) {
        location.reload();
    }
}, 300000);
</script>
@endsection