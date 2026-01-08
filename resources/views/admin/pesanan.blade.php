@extends('admin.layouts_admin.app')

@section('content')
<div id="content" class="app-content">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="row align-items-center mb-4">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 d-flex align-items-center justify-content-center">
                        <i class="fas fa-shopping-cart text-primary fs-4"></i>
                    </div>
                    <div>
                        <h1 class="h2 mb-1 fw-bold text-dark">Manajemen Pesanan</h1>
                        <p class="text-muted mb-0">Kelola semua transaksi dan pemesanan pelanggan</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex justify-content-end gap-3">
                    <div class="dropdown">
                        <button class="btn btn-outline-primary rounded-pill px-4 dropdown-toggle" 
                                type="button" id="filterDropdown" data-bs-toggle="dropdown">
                            <i class="fas fa-filter me-2"></i>Filter Status
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg">
                            <li><a class="dropdown-item" href="#" onclick="filterOrders('all')">Semua Status</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#" onclick="filterOrders('dibayar')">
                                <span class="badge bg-success me-2">●</span> Dibayar
                            </a></li>
                            <li><a class="dropdown-item" href="#" onclick="filterOrders('menunggu')">
                                <span class="badge bg-warning me-2">●</span> Menunggu
                            </a></li>
                            <li><a class="dropdown-item" href="#" onclick="filterOrders('gagal')">
                                <span class="badge bg-danger me-2">●</span> Gagal
                            </a></li>
                        </ul>
                    </div>
                    <button class="btn btn-primary rounded-pill px-4" onclick="showForm()">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Pesanan
                    </button>
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
                                <i class="fas fa-receipt text-primary fs-3"></i>
                            </div>
                            <div>
                                <div class="text-muted small">Total Pesanan</div>
                                <div class="h4 fw-bold mt-1" id="totalOrders">0</div>
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
                                <i class="fas fa-check-circle text-success fs-3"></i>
                            </div>
                            <div>
                                <div class="text-muted small">Dibayar</div>
                                <div class="h4 fw-bold mt-1" id="paidOrders">0</div>
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
                                <i class="fas fa-clock text-warning fs-3"></i>
                            </div>
                            <div>
                                <div class="text-muted small">Menunggu</div>
                                <div class="h4 fw-bold mt-1" id="pendingOrders">0</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card border-0 shadow-sm bg-gradient-danger bg-opacity-10">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-danger bg-opacity-20 p-3 me-3">
                                <i class="fas fa-times-circle text-danger fs-3"></i>
                            </div>
                            <div>
                                <div class="text-muted small">Gagal</div>
                                <div class="h4 fw-bold mt-1" id="failedOrders">0</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Table -->
        <div class="card border-0 shadow-lg">
            <div class="card-header bg-transparent border-0 py-4 px-4 d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="mb-1 fw-bold">Daftar Pesanan</h5>
                    <p class="text-muted small mb-0">Semua transaksi yang tercatat</p>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="input-group search-group rounded-pill bg-light" style="max-width: 300px;">
                        <span class="input-group-text border-0 bg-transparent">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-0 bg-transparent" 
                               placeholder="Cari pesanan..." id="searchInput" onkeyup="filterTable()">
                    </div>
                    <button class="btn btn-outline-primary rounded-pill px-4" onclick="exportOrders()">
                        <i class="fas fa-file-export me-2"></i>Export
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive rounded-3">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 rounded-start ps-4" width="50">#</th>
                                <th class="border-0">Produk</th>
                                <th class="border-0">Pelanggan</th>
                                <th class="border-0 text-center">Jumlah</th>
                                <th class="border-0">Metode</th>
                                <th class="border-0">Total</th>
                                <th class="border-0 text-center">Status</th>
                                <th class="border-0 text-center">Tanggal</th>
                                <th class="border-0 rounded-end pe-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="pesanan-table">
                            <tr>
                                <td colspan="9" class="text-center py-5">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <p class="text-muted mt-3">Memuat data pesanan...</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 py-4 px-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Menampilkan <span id="showingCount">0</span> dari <span id="totalCount">0</span> pesanan
                    </div>
                    <div class="pagination-buttons">
                        <button class="btn btn-outline-primary btn-sm rounded-pill me-2" id="prevBtn" disabled>
                            <i class="fas fa-chevron-left me-1"></i>Sebelumnya
                        </button>
                        <button class="btn btn-outline-primary btn-sm rounded-pill" id="nextBtn" disabled>
                            Selanjutnya<i class="fas fa-chevron-right ms-1"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Order Form Modal -->
<div class="modal fade" id="orderFormModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-0 py-4 px-4">
                <h5 class="modal-title fw-bold" id="form-title">Tambah Pesanan Baru</h5>
                <button type="button" class="btn-close" onclick="hideForm()" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <input type="hidden" id="pesanan_id">
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label fw-medium mb-2">
                                <i class="fas fa-box me-2 text-primary"></i>Pilih Produk
                            </label>
                            <select id="elektronik_id" class="form-select form-select-lg rounded-3">
                                <option value="">Pilih produk...</option>
                            </select>
                            <div class="form-text text-muted">
                                Stok tersedia: <span id="stockInfo" class="fw-medium">0 unit</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label fw-medium mb-2">
                                <i class="fas fa-user me-2 text-success"></i>Nama Pemesan
                            </label>
                            <input type="text" id="nama_pemesan" class="form-control form-control-lg rounded-3" 
                                   placeholder="Nama lengkap pemesan" required>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label fw-medium mb-2">
                                <i class="fas fa-map-marker-alt me-2 text-info"></i>Alamat Pengiriman
                            </label>
                            <textarea id="alamat" class="form-control rounded-3" rows="3" 
                                      placeholder="Alamat lengkap pengiriman" required></textarea>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label fw-medium mb-2">
                                <i class="fas fa-calculator me-2 text-warning"></i>Jumlah Pesanan
                            </label>
                            <input type="number" id="jumlah_pesanan" class="form-control form-control-lg rounded-3" 
                                   placeholder="Jumlah unit" min="1" required>
                            <div class="form-text text-muted">Maksimal: <span id="maxStock" class="fw-medium">0 unit</span></div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label fw-medium mb-2">
                                <i class="fas fa-credit-card me-2 text-danger"></i>Metode Pembayaran
                            </label>
                            <select id="metode_pembayaran" class="form-select form-select-lg rounded-3">
                                <option value="transfer_bank">Transfer Bank</option>
                                <option value="e_wallet">E-Wallet</option>
                                <option value="cod">COD (Cash On Delivery)</option>
                                <option value="kredit">Kartu Kredit</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label fw-medium mb-2">
                                <i class="fas fa-tag me-2 text-secondary"></i>Status Pembayaran
                            </label>
                            <select id="setatus_pembayaran" class="form-select form-select-lg rounded-3">
                                <option value="menunggu">Menunggu Pembayaran</option>
                                <option value="dibayar">Dibayar</option>
                                <option value="gagal">Gagal</option>
                                <option value="dibatalkan">Dibatalkan</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label fw-medium mb-2">
                                <i class="fas fa-calendar-alt me-2 text-primary"></i>Tanggal Pesanan
                            </label>
                            <input type="date" id="tanggal_pesanan" class="form-control form-control-lg rounded-3" 
                                   value="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                    
                    <!-- Price Calculation -->
                    <div class="col-12">
                        <div class="card bg-light border-0">
                            <div class="card-body p-4">
                                <h6 class="fw-bold mb-3">Rincian Harga</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <div class="text-muted small">Harga Satuan</div>
                                            <div class="h5 fw-bold text-primary" id="unitPrice">Rp 0</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <div class="text-muted small">Jumlah Pesanan</div>
                                            <div class="h5 fw-bold text-success" id="quantityDisplay">0 unit</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr class="my-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="text-muted">Total Pembayaran</div>
                                            <div class="h4 fw-bold text-dark" id="totalPrice">Rp 0</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 py-4 px-4">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-4" 
                        onclick="hideForm()">Batal</button>
                <button type="button" class="btn btn-primary rounded-pill px-4" onclick="saveData()">
                    <i class="fas fa-save me-2"></i>Simpan Pesanan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Order Details Modal -->
<div class="modal fade" id="orderDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-0 py-4 px-4">
                <h5 class="modal-title fw-bold">Detail Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div id="orderDetailContent"></div>
            </div>
        </div>
    </div>
</div>

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

.status-badge {
    padding: 0.5rem 1rem;
    font-weight: 500;
    border-radius: 20px;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.status-badge.dibayar {
    background-color: rgba(28, 200, 138, 0.1);
    color: #1cc88a;
}

.status-badge.menunggu {
    background-color: rgba(246, 194, 62, 0.1);
    color: #f6c23e;
}

.status-badge.gagal {
    background-color: rgba(231, 74, 59, 0.1);
    color: #e74a3b;
}

.status-badge.dibatalkan {
    background-color: rgba(108, 117, 125, 0.1);
    color: #6c757d;
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

.bg-gradient-warning {
    background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);
}

.bg-gradient-danger {
    background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
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

.payment-method {
    padding: 0.75rem 1rem;
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: white;
}

.payment-method:hover {
    border-color: #4e73df;
    background: rgba(78, 115, 223, 0.05);
}

.payment-method.active {
    border-color: #4e73df;
    background: rgba(78, 115, 223, 0.1);
}

.customer-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 14px;
}

.product-image {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid #f0f0f0;
}

@media (max-width: 768px) {
    .table-responsive {
        border-radius: 8px;
    }
    
    .action-btn {
        width: 36px;
        height: 36px;
    }
    
    .search-group {
        max-width: 200px !important;
    }
}
</style>

<script>
const API_PESANAN = '/api/pesanan';
const API_ELEKTRONIK = '/api/elektronik';
let ordersData = [];
let elektronikData = [];
let currentPage = 1;
let itemsPerPage = 10;
let currentFilter = 'all';
let currentSearch = '';

document.addEventListener('DOMContentLoaded', function() {
    loadData();
    loadElektronik();
    setupEventListeners();
});

function setupEventListeners() {
    // Realtime price calculation
    const jumlahInput = document.getElementById('jumlah_pesanan');
    const productSelect = document.getElementById('elektronik_id');
    
    if (jumlahInput) {
        jumlahInput.addEventListener('input', calculateTotal);
    }
    
    if (productSelect) {
        productSelect.addEventListener('change', updateStockInfo);
    }
    
    // Pagination buttons
    document.getElementById('prevBtn').addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            renderTable();
        }
    });
    
    document.getElementById('nextBtn').addEventListener('click', () => {
        const totalPages = Math.ceil(getFilteredData().length / itemsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            renderTable();
        }
    });
}

function loadData() {
    showLoading();
    
    fetch(API_PESANAN)
        .then(res => res.json())
        .then(data => {
            ordersData = data;
            renderTable();
            updateStats(data);
        })
        .catch(error => {
            console.error('Error loading data:', error);
            showError();
        });
}

function loadElektronik() {
    fetch(API_ELEKTRONIK)
        .then(res => res.json())
        .then(data => {
            elektronikData = data;
            populateProductDropdown(data);
        });
}

function populateProductDropdown(data) {
    const select = document.getElementById('elektronik_id');
    if (!select) return;
    
    let options = '<option value="">Pilih produk...</option>';
    data.forEach(item => {
        options += `<option value="${item.id}" data-price="${item.harga}" data-stock="${item.stok}">
            ${item.nama_barang} - Rp ${Number(item.harga).toLocaleString('id-ID')} (Stok: ${item.stok})
        </option>`;
    });
    select.innerHTML = options;
}

function updateStockInfo() {
    const select = document.getElementById('elektronik_id');
    const selectedOption = select.options[select.selectedIndex];
    
    if (selectedOption.value) {
        const price = selectedOption.getAttribute('data-price');
        const stock = selectedOption.getAttribute('data-stock');
        
        document.getElementById('stockInfo').textContent = `${stock} unit`;
        document.getElementById('maxStock').textContent = `${stock} unit`;
        document.getElementById('unitPrice').textContent = `Rp ${Number(price).toLocaleString('id-ID')}`;
        
        // Update max attribute on quantity input
        document.getElementById('jumlah_pesanan').max = stock;
        calculateTotal();
    }
}

function calculateTotal() {
    const select = document.getElementById('elektronik_id');
    const quantity = parseInt(document.getElementById('jumlah_pesanan').value) || 0;
    
    if (select.value && quantity > 0) {
        const selectedOption = select.options[select.selectedIndex];
        const price = parseInt(selectedOption.getAttribute('data-price'));
        const total = price * quantity;
        
        document.getElementById('quantityDisplay').textContent = `${quantity} unit`;
        document.getElementById('totalPrice').textContent = `Rp ${Number(total).toLocaleString('id-ID')}`;
    }
}

function showLoading() {
    const tbody = document.getElementById('pesanan-table');
    tbody.innerHTML = `
        <tr>
            <td colspan="9" class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="text-muted mt-3">Memuat data pesanan...</p>
            </td>
        </tr>
    `;
}

function showError() {
    const tbody = document.getElementById('pesanan-table');
    tbody.innerHTML = `
        <tr>
            <td colspan="9" class="text-center py-5">
                <div class="rounded-circle bg-danger bg-opacity-10 p-4 d-inline-flex align-items-center justify-content-center mb-3">
                    <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
                </div>
                <h5 class="text-danger fw-medium">Gagal Memuat Data</h5>
                <p class="text-muted">Terjadi kesalahan saat mengambil data pesanan</p>
                <button class="btn btn-outline-primary rounded-pill px-4 mt-2" onclick="loadData()">
                    <i class="fas fa-redo me-2"></i>Coba Lagi
                </button>
            </td>
        </tr>
    `;
}

function renderTable() {
    const filteredData = getFilteredData();
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const paginatedData = filteredData.slice(startIndex, endIndex);
    
    if (paginatedData.length === 0) {
        document.getElementById('pesanan-table').innerHTML = `
            <tr>
                <td colspan="9" class="text-center py-5">
                    <div class="py-4">
                        <i class="fas fa-shopping-cart fa-3x text-light mb-3"></i>
                        <h5 class="text-muted">Tidak Ada Pesanan</h5>
                        <p class="text-muted small">${currentFilter !== 'all' || currentSearch ? 'Tidak ditemukan data dengan filter yang dipilih' : 'Mulai dengan menambahkan pesanan pertama'}</p>
                        ${currentFilter !== 'all' || currentSearch ? '' : '<button class="btn btn-primary rounded-pill px-4 mt-2" onclick="showForm()"><i class="fas fa-plus me-2"></i>Tambah Pesanan Pertama</button>'}
                    </div>
                </td>
            </tr>
        `;
        
        document.getElementById('showingCount').textContent = '0';
        document.getElementById('totalCount').textContent = '0';
        updatePaginationButtons(0);
        return;
    }
    
    let rows = '';
    paginatedData.forEach((item, index) => {
        const product = elektronikData.find(p => p.id == item.elektronik_id) || {};
        const totalPrice = (product.harga || 0) * item.jumlah_pesanan;
        const customerInitial = item.nama_pemesan ? item.nama_pemesan.charAt(0).toUpperCase() : '?';
        const orderDate = new Date(item.created_at);
        
        rows += `
            <tr>
                <td class="ps-4">
                    <div class="fw-medium">${startIndex + index + 1}</div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <img src="${product.gambar ? '/storage/' + product.gambar : '/images/default-product.png'}"
                             class="product-image me-3" 
                             alt="${product.nama_barang || 'Produk'}"
                             onerror="this.src='/images/default-product.png'">
                        <div>
                            <div class="fw-medium mb-1">${product.nama_barang || 'Produk tidak ditemukan'}</div>
                            <small class="text-muted">${product.deskripsi ? product.deskripsi.substring(0, 30) + '...' : ''}</small>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center gap-3">
                        <div class="customer-avatar">${customerInitial}</div>
                        <div>
                            <div class="fw-medium mb-1">${item.nama_pemesan}</div>
                            <small class="text-muted">${item.alamat ? item.alamat.substring(0, 20) + '...' : '-'}</small>
                        </div>
                    </div>
                </td>
                <td class="text-center">
                    <span class="badge bg-dark rounded-pill px-3 py-2">
                        ${item.jumlah_pesanan}
                    </span>
                </td>
                <td>
                    <div class="fw-medium">${formatPaymentMethod(item.metode_pembayaran)}</div>
                </td>
                <td>
                    <div class="fw-bold text-dark">Rp ${Number(totalPrice).toLocaleString('id-ID')}</div>
                </td>
                <td class="text-center">
                    <span class="status-badge ${item.setatus_pembayaran}">
                        <i class="fas ${getStatusIcon(item.setatus_pembayaran)}"></i>
                        ${formatStatus(item.setatus_pembayaran)}
                    </span>
                </td>
                <td class="text-center">
                    <div class="fw-medium">${orderDate.toLocaleDateString('id-ID')}</div>
                    <small class="text-muted">${orderDate.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })}</small>
                </td>
                <td class="pe-4 text-center">
                    <div class="d-flex gap-2 justify-content-center">
                        <button class="btn btn-outline-primary action-btn" 
                                onclick="viewOrderDetails(${item.id})"
                                data-bs-toggle="tooltip" title="Detail">
                            <i class="fas fa-eye"></i>
                        </button>
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
                    </div>
                </td>
            </tr>
        `;
    });
    
    document.getElementById('pesanan-table').innerHTML = rows;
    document.getElementById('showingCount').textContent = paginatedData.length;
    document.getElementById('totalCount').textContent = filteredData.length;
    updatePaginationButtons(filteredData.length);
    
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
}

function getFilteredData() {
    let filtered = ordersData;
    
    // Apply status filter
    if (currentFilter !== 'all') {
        filtered = filtered.filter(order => order.setatus_pembayaran === currentFilter);
    }
    
    // Apply search filter
    if (currentSearch) {
        const searchTerm = currentSearch.toLowerCase();
        filtered = filtered.filter(order => 
            order.nama_pemesan.toLowerCase().includes(searchTerm) ||
            order.alamat.toLowerCase().includes(searchTerm) ||
            order.metode_pembayaran.toLowerCase().includes(searchTerm)
        );
    }
    
    return filtered;
}

function formatPaymentMethod(method) {
    const methods = {
        'transfer_bank': 'Transfer Bank',
        'e_wallet': 'E-Wallet',
        'cod': 'COD',
        'kredit': 'Kartu Kredit'
    };
    return methods[method] || method;
}

function formatStatus(status) {
    const statusMap = {
        'dibayar': 'Dibayar',
        'menunggu': 'Menunggu',
        'gagal': 'Gagal',
        'dibatalkan': 'Dibatalkan'
    };
    return statusMap[status] || status;
}

function getStatusIcon(status) {
    const icons = {
        'dibayar': 'fa-check-circle',
        'menunggu': 'fa-clock',
        'gagal': 'fa-times-circle',
        'dibatalkan': 'fa-ban'
    };
    return icons[status] || 'fa-question-circle';
}

function updateStats(data) {
    const totalOrders = data.length;
    const paidOrders = data.filter(order => order.setatus_pembayaran === 'dibayar').length;
    const pendingOrders = data.filter(order => order.setatus_pembayaran === 'menunggu').length;
    const failedOrders = data.filter(order => order.setatus_pembayaran === 'gagal').length;
    
    document.getElementById('totalOrders').textContent = totalOrders;
    document.getElementById('paidOrders').textContent = paidOrders;
    document.getElementById('pendingOrders').textContent = pendingOrders;
    document.getElementById('failedOrders').textContent = failedOrders;
}

function updatePaginationButtons(totalItems) {
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    
    prevBtn.disabled = currentPage <= 1;
    nextBtn.disabled = currentPage >= totalPages;
}

function filterOrders(status) {
    currentFilter = status;
    currentPage = 1;
    renderTable();
    updateDropdownLabel(status);
}

function updateDropdownLabel(status) {
    const labelMap = {
        'all': 'Semua Status',
        'dibayar': 'Dibayar',
        'menunggu': 'Menunggu',
        'gagal': 'Gagal'
    };
    
    const dropdown = document.getElementById('filterDropdown');
    const icon = dropdown.querySelector('i');
    dropdown.innerHTML = icon.outerHTML + ' ' + labelMap[status];
}

function filterTable() {
    currentSearch = document.getElementById('searchInput').value;
    currentPage = 1;
    renderTable();
}

function showForm() {
    document.getElementById('form-title').textContent = 'Tambah Pesanan Baru';
    clearForm();
    const modal = new bootstrap.Modal(document.getElementById('orderFormModal'));
    modal.show();
}

function hideForm() {
    const modal = bootstrap.Modal.getInstance(document.getElementById('orderFormModal'));
    modal.hide();
    clearForm();
}

function clearForm() {
    document.getElementById('pesanan_id').value = '';
    document.getElementById('nama_pemesan').value = '';
    document.getElementById('alamat').value = '';
    document.getElementById('jumlah_pesanan').value = '';
    document.getElementById('metode_pembayaran').value = 'transfer_bank';
    document.getElementById('setatus_pembayaran').value = 'menunggu';
    document.getElementById('tanggal_pesanan').value = new Date().toISOString().split('T')[0];
    document.getElementById('elektronik_id').selectedIndex = 0;
    document.getElementById('unitPrice').textContent = 'Rp 0';
    document.getElementById('quantityDisplay').textContent = '0 unit';
    document.getElementById('totalPrice').textContent = 'Rp 0';
    document.getElementById('stockInfo').textContent = '0 unit';
    document.getElementById('maxStock').textContent = '0 unit';
}

function saveData() {
    const id = document.getElementById('pesanan_id').value;
    const elektronikId = document.getElementById('elektronik_id').value;
    const jumlah = parseInt(document.getElementById('jumlah_pesanan').value);
    const selectedProduct = elektronikData.find(p => p.id == elektronikId);
    
    if (!selectedProduct) {
        showToast('error', 'Gagal!', 'Silakan pilih produk terlebih dahulu');
        return;
    }
    
    if (jumlah > selectedProduct.stok) {
        showToast('error', 'Gagal!', `Jumlah pesanan melebihi stok yang tersedia (${selectedProduct.stok} unit)`);
        return;
    }
    
    if (jumlah <= 0) {
        showToast('error', 'Gagal!', 'Jumlah pesanan harus lebih dari 0');
        return;
    }
    
    const payload = {
        elektronik_id: elektronikId,
        nama_pemesan: document.getElementById('nama_pemesan').value.trim(),
        alamat: document.getElementById('alamat').value.trim(),
        jumlah_pesanan: jumlah,
        metode_pembayaran: document.getElementById('metode_pembayaran').value,
        setatus_pembayaran: document.getElementById('setatus_pembayaran').value,
        tanggal_pesanan: document.getElementById('tanggal_pesanan').value || new Date().toISOString().split('T')[0]
    };
    
    // Show loading state
    const saveBtn = document.querySelector('#orderFormModal .btn-primary');
    const originalText = saveBtn.innerHTML;
    saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Menyimpan...';
    saveBtn.disabled = true;
    
    const url = id ? `${API_PESANAN}/${id}` : API_PESANAN;
    const method = id ? 'PUT' : 'POST';
    
    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify(payload)
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => Promise.reject(err));
        }
        return response.json();
    })
    .then(data => {
        hideForm();
        loadData();
        loadElektronik();
        showToast('success', 'Berhasil!', 'Pesanan berhasil disimpan');
    })
    .catch(error => {
        console.error('Error saving data:', error);
        showToast('error', 'Gagal!', error.message || 'Terjadi kesalahan saat menyimpan data');
    })
    .finally(() => {
        saveBtn.innerHTML = originalText;
        saveBtn.disabled = false;
    });
}

function editData(id) {
    fetch(`${API_PESANAN}/${id}`)
        .then(res => res.json())
        .then(data => {
            document.getElementById('form-title').textContent = 'Edit Pesanan';
            document.getElementById('pesanan_id').value = data.id;
            document.getElementById('elektronik_id').value = data.elektronik_id;
            document.getElementById('nama_pemesan').value = data.nama_pemesan;
            document.getElementById('alamat').value = data.alamat;
            document.getElementById('jumlah_pesanan').value = data.jumlah_pesanan;
            document.getElementById('metode_pembayaran').value = data.metode_pembayaran;
            document.getElementById('setatus_pembayaran').value = data.setatus_pembayaran;
            document.getElementById('tanggal_pesanan').value = data.tanggal_pesanan || data.created_at.split('T')[0];
            
            // Update stock info and calculate total
            updateStockInfo();
            
            const modal = new bootstrap.Modal(document.getElementById('orderFormModal'));
            modal.show();
        })
        .catch(error => {
            console.error('Error loading order data:', error);
            showToast('error', 'Gagal!', 'Terjadi kesalahan saat memuat data pesanan');
        });
}

function viewOrderDetails(id) {
    fetch(`${API_PESANAN}/${id}`)
        .then(res => res.json())
        .then(data => {
            const product = elektronikData.find(p => p.id == data.elektronik_id) || {};
            const totalPrice = (product.harga || 0) * data.jumlah_pesanan;
            const orderDate = new Date(data.created_at);
            
            const detailContent = `
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card border-0 bg-light">
                            <div class="card-body p-4">
                                <h6 class="fw-bold mb-3">Informasi Pesanan</h6>
                                <div class="mb-3">
                                    <div class="text-muted small">Nomor Pesanan</div>
                                    <div class="fw-bold">#${String(id).padStart(6, '0')}</div>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted small">Tanggal Pesanan</div>
                                    <div class="fw-bold">${orderDate.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}</div>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted small">Status</div>
                                    <span class="status-badge ${data.setatus_pembayaran}">
                                        ${formatStatus(data.setatus_pembayaran)}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card border-0 bg-light">
                            <div class="card-body p-4">
                                <h6 class="fw-bold mb-3">Informasi Pembayaran</h6>
                                <div class="mb-3">
                                    <div class="text-muted small">Metode Pembayaran</div>
                                    <div class="fw-bold">${formatPaymentMethod(data.metode_pembayaran)}</div>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted small">Total Pembayaran</div>
                                    <div class="h4 fw-bold text-primary">Rp ${Number(totalPrice).toLocaleString('id-ID')}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="card border-0 bg-light">
                            <div class="card-body p-4">
                                <h6 class="fw-bold mb-3">Informasi Pelanggan</h6>
                                <div class="mb-3">
                                    <div class="text-muted small">Nama Pemesan</div>
                                    <div class="fw-bold">${data.nama_pemesan}</div>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted small">Alamat Pengiriman</div>
                                    <div class="fw-bold">${data.alamat}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card border-0 bg-light">
                            <div class="card-body p-4">
                                <h6 class="fw-bold mb-3">Produk</h6>
                                <div class="d-flex align-items-center">
                                    <img src="${product.gambar ? '/storage/' + product.gambar : '/images/default-product.png'}"
                                         class="product-image me-3" 
                                         alt="${product.nama_barang}"
                                         onerror="this.src='/images/default-product.png'">
                                    <div>
                                        <div class="fw-medium mb-1">${product.nama_barang || 'Produk tidak ditemukan'}</div>
                                        <div class="text-muted small">${data.jumlah_pesanan} x Rp ${Number(product.harga || 0).toLocaleString('id-ID')}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            document.getElementById('orderDetailContent').innerHTML = detailContent;
            const modal = new bootstrap.Modal(document.getElementById('orderDetailModal'));
            modal.show();
        });
}

function deleteData(id) {
    Swal.fire({
        title: 'Hapus Pesanan?',
        text: "Data pesanan yang dihapus tidak dapat dikembalikan!",
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
            fetch(`${API_PESANAN}/${id}`, {
                method: 'DELETE',
                headers: { 
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(() => {
                loadData();
                showToast('success', 'Berhasil!', 'Pesanan berhasil dihapus');
            })
            .catch(error => {
                console.error('Error deleting data:', error);
                showToast('error', 'Gagal!', 'Terjadi kesalahan saat menghapus pesanan');
            });
        }
    });
}

function exportOrders() {
    showToast('info', 'Info', 'Fitur export pesanan akan segera tersedia');
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