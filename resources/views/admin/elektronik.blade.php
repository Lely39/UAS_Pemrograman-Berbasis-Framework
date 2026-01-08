@extends('admin.layouts_admin.app')

@section('content')
<div id="content" class="app-content">
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="row align-items-center mb-4">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 d-flex align-items-center justify-content-center">
                        <i class="fas fa-boxes text-primary fs-4"></i>
                    </div>
                    <div>
                        <h1 class="h2 mb-1 fw-bold text-dark">Manajemen Produk Elektronik</h1>
                        <p class="text-muted mb-0">Kelola inventaris produk elektronik Anda dengan mudah</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex justify-content-end">
                    <div class="input-group search-group rounded-pill bg-light" style="max-width: 300px;">
                        <span class="input-group-text border-0 bg-transparent">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-0 bg-transparent" 
                               placeholder="Cari produk..." id="searchInput">
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card border-0 shadow-sm bg-gradient-primary bg-opacity-10">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-primary bg-opacity-20 p-3 me-3">
                                <i class="fas fa-boxes text-primary fs-3"></i>
                            </div>
                            <div>
                                <div class="text-muted small">Total Produk</div>
                                <div class="h4 fw-bold mt-1" id="totalProduk">0</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card border-0 shadow-sm bg-gradient-success bg-opacity-10">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-success bg-opacity-20 p-3 me-3">
                                <i class="fas fa-box text-success fs-3"></i>
                            </div>
                            <div>
                                <div class="text-muted small">Stok Tersedia</div>
                                <div class="h4 fw-bold mt-1" id="totalStok">0</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card border-0 shadow-sm bg-gradient-info bg-opacity-10">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-info bg-opacity-20 p-3 me-3">
                                <i class="fas fa-tags text-info fs-3"></i>
                            </div>
                            <div>
                                <div class="text-muted small">Total Nilai</div>
                                <div class="h4 fw-bold mt-1" id="totalNilai">Rp 0</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card border-0 shadow-sm bg-gradient-warning bg-opacity-10">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-warning bg-opacity-20 p-3 me-3">
                                <i class="fas fa-exclamation-triangle text-warning fs-3"></i>
                            </div>
                            <div>
                                <div class="text-muted small">Stok Rendah</div>
                                <div class="h4 fw-bold mt-1" id="stokRendah">0</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row">
            <div class="col-lg-8">
                <!-- Products Table -->
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-transparent border-0 py-4 px-4 d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="mb-1 fw-bold">Daftar Produk Elektronik</h5>
                            <p class="text-muted small mb-0">Semua produk yang tersedia</p>
                        </div>
                        <button class="btn btn-primary rounded-pill px-4" onclick="showForm()">
                            <i class="fas fa-plus-circle me-2"></i> Tambah Produk
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive rounded-3">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 rounded-start ps-4" width="50">#</th>
                                        <th class="border-0" width="80">Gambar</th>
                                        <th class="border-0">Produk</th>
                                        <th class="border-0">Harga</th>
                                        <th class="border-0 text-center">Stok</th>
                                        <th class="border-0 rounded-end pe-4">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="elektronik-table">
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <div class="spinner-border text-primary" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <p class="text-muted mt-3">Memuat data produk...</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Quick Actions -->
                <div class="card border-0 shadow-lg mb-4">
                    <div class="card-header bg-transparent border-0 py-4 px-4">
                        <h5 class="mb-1 fw-bold">Aksi Cepat</h5>
                        <p class="text-muted small mb-0">Kelola produk dengan cepat</p>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-grid gap-3">
                            <button class="btn btn-outline-primary rounded-pill text-start p-3" 
                                    onclick="exportToExcel()">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-3">
                                        <i class="fas fa-file-excel text-primary"></i>
                                    </div>
                                    <div>
                                        <div class="fw-medium">Export ke Excel</div>
                                        <small class="text-muted">Unduh data produk</small>
                                    </div>
                                </div>
                            </button>
                            <button class="btn btn-outline-success rounded-pill text-start p-3" 
                                    onclick="printProducts()">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-success bg-opacity-10 p-2 me-3">
                                        <i class="fas fa-print text-success"></i>
                                    </div>
                                    <div>
                                        <div class="fw-medium">Cetak Laporan</div>
                                        <small class="text-muted">Cetak daftar produk</small>
                                    </div>
                                </div>
                            </button>
                            <button class="btn btn-outline-info rounded-pill text-start p-3" 
                                    onclick="refreshData()">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-info bg-opacity-10 p-2 me-3">
                                        <i class="fas fa-sync-alt text-info"></i>
                                    </div>
                                    <div>
                                        <div class="fw-medium">Refresh Data</div>
                                        <small class="text-muted">Perbarui daftar produk</small>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Low Stock Alert -->
                <div class="card border-0 shadow-lg" id="lowStockAlert">
                    <div class="card-header bg-transparent border-0 py-4 px-4">
                        <h5 class="mb-1 fw-bold text-warning">Peringatan Stok</h5>
                        <p class="text-muted small mb-0">Produk dengan stok rendah</p>
                    </div>
                    <div class="card-body p-4">
                        <div id="lowStockList">
                            <div class="text-center py-3">
                                <div class="spinner-border spinner-border-sm text-warning" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p class="text-muted mt-2 small">Memeriksa stok...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Form Modal -->
        <div class="modal fade" id="productFormModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header border-0 py-4 px-4">
                        <h5 class="modal-title fw-bold" id="form-title">Tambah Produk Baru</h5>
                        <button type="button" class="btn-close" onclick="hideForm()" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <input type="hidden" id="elektronik_id">

                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-medium mb-2">
                                        <i class="fas fa-box me-2 text-primary"></i>Nama Barang
                                    </label>
                                    <input type="text" id="nama_barang" class="form-control form-control-lg rounded-3" 
                                           placeholder="Masukkan nama produk" required>
                                    <div class="form-text text-muted">Nama lengkap produk elektronik</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-medium mb-2">
                                        <i class="fas fa-tag me-2 text-success"></i>Harga
                                    </label>
                                    <div class="input-group input-group-lg rounded-3">
                                        <span class="input-group-text bg-light border-0">Rp</span>
                                        <input type="number" id="harga" class="form-control border-0" 
                                               placeholder="Harga produk" required>
                                    </div>
                                    <div class="form-text text-muted">Harga satuan produk</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-medium mb-2">
                                        <i class="fas fa-boxes me-2 text-info"></i>Stok
                                    </label>
                                    <input type="number" id="stok" class="form-control form-control-lg rounded-3" 
                                           placeholder="Jumlah stok" required>
                                    <div class="form-text text-muted">Stok awal produk</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-medium mb-2">
                                        <i class="fas fa-image me-2 text-warning"></i>Gambar Produk
                                    </label>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="flex-grow-1">
                                            <input type="file" id="gambar" class="form-control form-control-lg rounded-3" 
                                                   accept="image/*">
                                        </div>
                                        <div id="previewContainer" class="d-none">
                                            <img id="imagePreview" class="rounded-2" width="60" height="60" 
                                                 style="object-fit: cover;">
                                        </div>
                                    </div>
                                    <div class="form-text text-muted">Format: JPG, PNG, maksimal 2MB</div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label fw-medium mb-2">
                                        <i class="fas fa-align-left me-2 text-secondary"></i>Deskripsi
                                    </label>
                                    <textarea id="deskripsi" class="form-control rounded-3" rows="4" 
                                              placeholder="Deskripsi lengkap produk" required></textarea>
                                    <div class="form-text text-muted">Jelaskan spesifikasi dan fitur produk</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 py-4 px-4">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" 
                                onclick="hideForm()">Batal</button>
                        <button type="button" class="btn btn-primary rounded-pill px-4" onclick="saveData()">
                            <i class="fas fa-save me-2"></i> Simpan Produk
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Scroll Top -->
<a href="#" data-click="scroll-top" class="btn-scroll-top fade">
    <i class="fa fa-arrow-up"></i>
</a>

<style>
.search-group {
    transition: all 0.3s ease;
    border: 1px solid transparent;
}

.search-group:focus-within {
    border-color: #4e73df;
    box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.1);
}

.card {
    border-radius: 12px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
}

.table {
    --bs-table-hover-bg: rgba(78, 115, 223, 0.05);
    margin-bottom: 0;
}

.table thead th {
    font-weight: 600;
    color: #6c757d;
    background-color: #f8f9fa;
    border-bottom: 2px solid #e9ecef;
    padding: 1rem;
    font-size: 0.9rem;
}

.table tbody tr {
    border-bottom: 1px solid #f0f0f0;
    transition: all 0.2s ease;
}

.table tbody tr:hover {
    background-color: var(--bs-table-hover-bg);
}

.table tbody td {
    padding: 1rem;
    vertical-align: middle;
}

.product-image {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid #f0f0f0;
}

.stock-badge {
    padding: 0.5rem 1rem;
    font-weight: 500;
    border-radius: 20px;
}

.stock-badge.low {
    background-color: rgba(231, 74, 59, 0.1);
    color: #e74a3b;
}

.stock-badge.medium {
    background-color: rgba(246, 194, 62, 0.1);
    color: #f6c23e;
}

.stock-badge.high {
    background-color: rgba(28, 200, 138, 0.1);
    color: #1cc88a;
}

.action-btn {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
}

.action-btn:hover {
    transform: scale(1.1);
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.bg-gradient-success {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
}

.bg-gradient-info {
    background: linear-gradient(135deg, #36d1dc 0%, #5b86e5 100%);
}

.bg-gradient-warning {
    background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);
}

.modal-content {
    border-radius: 16px;
}

.form-control, .form-select {
    border: 1px solid #e0e0e0;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.1);
}

.btn-rounded {
    border-radius: 20px;
    padding: 0.5rem 1.5rem;
}

@media (max-width: 768px) {
    .table-responsive {
        border-radius: 8px;
    }
    
    .product-image {
        width: 50px;
        height: 50px;
    }
    
    .action-btn {
        width: 36px;
        height: 36px;
    }
}
</style>

<script>
const API_URL = '/api/elektronik';
let productsData = [];

document.addEventListener('DOMContentLoaded', function() {
    loadData();
    setupEventListeners();
});

function setupEventListeners() {
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            filterProducts(searchTerm);
        });
    }

    // Image preview
    const gambarInput = document.getElementById('gambar');
    if (gambarInput) {
        gambarInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('imagePreview');
                    const container = document.getElementById('previewContainer');
                    preview.src = e.target.result;
                    container.classList.remove('d-none');
                }
                reader.readAsDataURL(file);
            }
        });
    }
}

function loadData() {
    showLoading();
    
    fetch(API_URL)
        .then(res => res.json())
        .then(data => {
            productsData = data;
            renderTable(data);
            updateStats(data);
            updateLowStockAlert(data);
        })
        .catch(error => {
            console.error('Error loading data:', error);
            showError();
        });
}

function showLoading() {
    const tbody = document.getElementById('elektronik-table');
    tbody.innerHTML = `
        <tr>
            <td colspan="6" class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="text-muted mt-3">Memuat data produk...</p>
            </td>
        </tr>
    `;
}

function showError() {
    const tbody = document.getElementById('elektronik-table');
    tbody.innerHTML = `
        <tr>
            <td colspan="6" class="text-center py-5">
                <div class="rounded-circle bg-danger bg-opacity-10 p-4 d-inline-flex align-items-center justify-content-center mb-3">
                    <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
                </div>
                <h5 class="text-danger fw-medium">Gagal Memuat Data</h5>
                <p class="text-muted">Terjadi kesalahan saat mengambil data produk</p>
                <button class="btn btn-outline-primary rounded-pill px-4 mt-2" onclick="loadData()">
                    <i class="fas fa-redo me-2"></i>Coba Lagi
                </button>
            </td>
        </tr>
    `;
}

function renderTable(data) {
    if (data.length === 0) {
        document.getElementById('elektronik-table').innerHTML = `
            <tr>
                <td colspan="6" class="text-center py-5">
                    <div class="py-4">
                        <i class="fas fa-box-open fa-3x text-light mb-3"></i>
                        <h5 class="text-muted">Belum Ada Produk</h5>
                        <p class="text-muted small">Mulai dengan menambahkan produk pertama Anda</p>
                        <button class="btn btn-primary rounded-pill px-4 mt-2" onclick="showForm()">
                            <i class="fas fa-plus me-2"></i>Tambah Produk Pertama
                        </button>
                    </div>
                </td>
            </tr>
        `;
        return;
    }

    let rows = '';
    data.forEach((item, index) => {
        const stockClass = getStockClass(item.stok);
        rows += `
            <tr>
                <td class="ps-4">
                    <div class="fw-medium">${index + 1}</div>
                </td>
                <td>
                    <img src="${item.gambar ? '/storage/' + item.gambar : '/images/default-product.png'}"
                         class="product-image" 
                         alt="${item.nama_barang}"
                         onerror="this.src='/images/default-product.png'">
                </td>
                <td>
                    <div class="fw-medium mb-1">${item.nama_barang}</div>
                    <small class="text-muted">${item.deskripsi ? item.deskripsi.substring(0, 50) + '...' : 'Tidak ada deskripsi'}</small>
                </td>
                <td>
                    <div class="fw-bold text-dark">Rp ${Number(item.harga).toLocaleString('id-ID')}</div>
                </td>
                <td class="text-center">
                    <span class="stock-badge ${stockClass}">
                        ${item.stok} Unit
                    </span>
                </td>
                <td class="pe-4">
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-warning action-btn" 
                                onclick="editData(${item.id})"
                                data-bs-toggle="tooltip" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-outline-danger action-btn" 
                                onclick="deleteData(${item.id})"
                                data-bs-toggle="tooltip" title="Hapus">
                            <i class="fas fa-trash"></i>
                        </button>
                        <button class="btn btn-outline-info action-btn" 
                                onclick="viewDetails(${item.id})"
                                data-bs-toggle="tooltip" title="Detail">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `;
    });
    
    document.getElementById('elektronik-table').innerHTML = rows;
    
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
}

function getStockClass(stock) {
    if (stock <= 5) return 'low';
    if (stock <= 10) return 'medium';
    return 'high';
}

function updateStats(data) {
    const totalProducts = data.length;
    const totalStock = data.reduce((sum, item) => sum + parseInt(item.stok), 0);
    const totalValue = data.reduce((sum, item) => sum + (parseInt(item.harga) * parseInt(item.stok)), 0);
    const lowStock = data.filter(item => parseInt(item.stok) <= 5).length;

    document.getElementById('totalProduk').textContent = totalProducts;
    document.getElementById('totalStok').textContent = totalStock.toLocaleString('id-ID');
    document.getElementById('totalNilai').textContent = `Rp ${totalValue.toLocaleString('id-ID')}`;
    document.getElementById('stokRendah').textContent = lowStock;
}

function updateLowStockAlert(data) {
    const lowStockProducts = data.filter(item => parseInt(item.stok) <= 5);
    const container = document.getElementById('lowStockList');
    
    if (lowStockProducts.length === 0) {
        container.innerHTML = `
            <div class="text-center py-3">
                <div class="rounded-circle bg-success bg-opacity-10 p-3 d-inline-flex align-items-center justify-content-center mb-3">
                    <i class="fas fa-check-circle fa-2x text-success"></i>
                </div>
                <h6 class="text-success fw-medium">Semua Stok Aman</h6>
                <p class="text-muted small mb-0">Tidak ada produk dengan stok rendah</p>
            </div>
        `;
        return;
    }

    let html = '';
    lowStockProducts.slice(0, 5).forEach(product => {
        html += `
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="d-flex align-items-center">
                    <img src="${product.gambar ? '/storage/' + product.gambar : '/images/default-product.png'}"
                         class="rounded me-3" width="45" height="45"
                         style="object-fit: cover;"
                         alt="${product.nama_barang}">
                    <div>
                        <div class="fw-medium">${product.nama_barang.substring(0, 20)}${product.nama_barang.length > 20 ? '...' : ''}</div>
                        <small class="text-muted">Rp ${Number(product.harga).toLocaleString('id-ID')}</small>
                    </div>
                </div>
                <div class="text-end">
                    <span class="badge bg-danger px-3 py-2">${product.stok}</span>
                    <small class="d-block text-muted">Stok</small>
                </div>
            </div>
        `;
    });
    
    if (lowStockProducts.length > 5) {
        html += `
            <div class="text-center mt-3">
                <small class="text-muted">+${lowStockProducts.length - 5} produk lainnya</small>
            </div>
        `;
    }
    
    container.innerHTML = html;
}

function filterProducts(searchTerm) {
    if (!searchTerm) {
        renderTable(productsData);
        return;
    }
    
    const filtered = productsData.filter(product => 
        product.nama_barang.toLowerCase().includes(searchTerm) ||
        product.deskripsi.toLowerCase().includes(searchTerm) ||
        product.harga.toString().includes(searchTerm)
    );
    
    renderTable(filtered);
}

function showForm() {
    document.getElementById('form-title').textContent = 'Tambah Produk Baru';
    clearForm();
    const modal = new bootstrap.Modal(document.getElementById('productFormModal'));
    modal.show();
}

function hideForm() {
    const modal = bootstrap.Modal.getInstance(document.getElementById('productFormModal'));
    modal.hide();
    clearForm();
}

function clearForm() {
    document.getElementById('elektronik_id').value = '';
    document.getElementById('nama_barang').value = '';
    document.getElementById('deskripsi').value = '';
    document.getElementById('harga').value = '';
    document.getElementById('stok').value = '';
    document.getElementById('gambar').value = '';
    
    const previewContainer = document.getElementById('previewContainer');
    if (previewContainer) {
        previewContainer.classList.add('d-none');
    }
}

function saveData() {
    const id = document.getElementById('elektronik_id').value;
    const formData = new FormData();
    
    formData.append('nama_barang', document.getElementById('nama_barang').value.trim());
    formData.append('deskripsi', document.getElementById('deskripsi').value.trim());
    formData.append('harga', document.getElementById('harga').value);
    formData.append('stok', document.getElementById('stok').value);
    
    const gambar = document.getElementById('gambar').files[0];
    if (gambar) {
        formData.append('gambar', gambar);
    }
    
    const url = id ? `${API_URL}/${id}` : API_URL;
    const method = id ? 'PUT' : 'POST';
    
    if (id) {
        formData.append('_method', 'PUT');
    }
    
    // Show loading state
    const saveBtn = document.querySelector('.modal-footer .btn-primary');
    const originalText = saveBtn.innerHTML;
    saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Menyimpan...';
    saveBtn.disabled = true;
    
    fetch(url, {
        method: 'POST',
        body: formData,
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        hideForm();
        loadData();
        showToast('success', 'Berhasil!', 'Data produk berhasil disimpan');
    })
    .catch(error => {
        console.error('Error saving data:', error);
        showToast('error', 'Gagal!', 'Terjadi kesalahan saat menyimpan data');
    })
    .finally(() => {
        saveBtn.innerHTML = originalText;
        saveBtn.disabled = false;
    });
}

function editData(id) {
    fetch(`${API_URL}/${id}`)
        .then(res => res.json())
        .then(data => {
            document.getElementById('form-title').textContent = 'Edit Produk';
            document.getElementById('elektronik_id').value = data.id;
            document.getElementById('nama_barang').value = data.nama_barang;
            document.getElementById('deskripsi').value = data.deskripsi;
            document.getElementById('harga').value = data.harga;
            document.getElementById('stok').value = data.stok;
            
            // Handle image preview
            if (data.gambar) {
                const preview = document.getElementById('imagePreview');
                const container = document.getElementById('previewContainer');
                preview.src = '/storage/' + data.gambar;
                container.classList.remove('d-none');
            }
            
            const modal = new bootstrap.Modal(document.getElementById('productFormModal'));
            modal.show();
        })
        .catch(error => {
            console.error('Error loading product data:', error);
            showToast('error', 'Gagal!', 'Terjadi kesalahan saat memuat data produk');
        });
}

function deleteData(id) {
    Swal.fire({
        title: 'Hapus Produk?',
        text: "Produk yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        customClass: {
            confirmButton: 'btn btn-danger',
            cancelButton: 'btn btn-secondary'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`${API_URL}/${id}`, {
                method: 'DELETE',
                headers: { 
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(() => {
                loadData();
                showToast('success', 'Berhasil!', 'Produk berhasil dihapus');
            })
            .catch(error => {
                console.error('Error deleting data:', error);
                showToast('error', 'Gagal!', 'Terjadi kesalahan saat menghapus produk');
            });
        }
    });
}

function viewDetails(id) {
    fetch(`${API_URL}/${id}`)
        .then(res => res.json())
        .then(data => {
            Swal.fire({
                title: data.nama_barang,
                html: `
                    <div class="text-start">
                        <div class="text-center mb-3">
                            <img src="${data.gambar ? '/storage/' + data.gambar : '/images/default-product.png'}"
                                 class="rounded img-fluid" style="max-height: 200px;">
                        </div>
                        <div class="mb-2">
                            <strong>Harga:</strong> Rp ${Number(data.harga).toLocaleString('id-ID')}
                        </div>
                        <div class="mb-2">
                            <strong>Stok:</strong> ${data.stok} Unit
                        </div>
                        <div>
                            <strong>Deskripsi:</strong>
                            <p class="mt-2">${data.deskripsi || 'Tidak ada deskripsi'}</p>
                        </div>
                    </div>
                `,
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: 'Edit Produk',
                cancelButtonText: 'Tutup',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-secondary'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    editData(id);
                }
            });
        });
}

function exportToExcel() {
    showToast('info', 'Info', 'Fitur export ke Excel akan segera tersedia');
}

function printProducts() {
    showToast('info', 'Info', 'Fitur cetak laporan akan segera tersedia');
}

function refreshData() {
    loadData();
    showToast('success', 'Berhasil!', 'Data berhasil diperbarui');
}

function showToast(icon, title, text) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.continueTimer)
        }
    });

    Toast.fire({
        icon: icon,
        title: title,
        text: text
    });
}
</script>
@endsection