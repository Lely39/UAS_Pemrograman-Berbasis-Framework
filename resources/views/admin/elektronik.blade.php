@extends('admin.layouts_admin.app')
@section('content')

<div id="content" class="app-content">
    <div class="container">

        <!-- Header -->
        <div class="row mb-4">
            <div class="col">
                <h1 class="page-header">
                    Data Elektronik
                    <small class="text-muted">Manajemen Produk</small>
                </h1>
                <hr>
            </div>
        </div>

        <!-- Table -->
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong>Daftar Elektronik</strong>
                <button class="btn btn-primary btn-sm" onclick="showForm()">
                    <i class="fa fa-plus"></i> Tambah
                </button>
            </div>

            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="50">No</th>
                            <th width="80">Gambar</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="elektronik-table">
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Memuat data...
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Form -->
        <div class="card shadow-sm mt-4 d-none" id="form-elektronik">
            <div class="card-header">
                <strong id="form-title">Tambah Elektronik</strong>
            </div>

            <div class="card-body">
                <input type="hidden" id="elektronik_id">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Barang</label>
                        <input type="text" id="nama_barang" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" id="harga" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" id="stok" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Gambar Produk</label>
                        <input type="file" id="gambar" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea id="deskripsi" class="form-control" rows="3" required></textarea>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button class="btn btn-success" onclick="saveData()">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                    <button class="btn btn-secondary" onclick="hideForm()">Batal</button>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Scroll Top -->
<a href="#" data-click="scroll-top" class="btn-scroll-top fade">
    <i class="fa fa-arrow-up"></i>
</a>

<script>
const API_URL = '/api/elektronik';

document.addEventListener('DOMContentLoaded', loadData);

function loadData() {
    fetch(API_URL)
        .then(res => res.json())
        .then(data => {
            let rows = '';
            data.forEach((item, index) => {
                rows += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>
                            <img src="/storage/${item.gambar ?? 'default.png'}"
                                 class="rounded" width="60">
                        </td>
                        <td>${item.nama_barang}</td>
                        <td>Rp ${Number(item.harga).toLocaleString()}</td>
                        <td>${item.stok}</td>
                        <td>
                            <button class="btn btn-warning btn-sm"
                                onclick="editData(${item.id})">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-sm"
                                onclick="deleteData(${item.id})">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
            });
            document.getElementById('elektronik-table').innerHTML = rows;
        });
}

function showForm() {
    document.getElementById('form-elektronik').classList.remove('d-none');
    document.getElementById('form-title').innerText = 'Tambah Elektronik';
    clearForm();
}

function hideForm() {
    document.getElementById('form-elektronik').classList.add('d-none');
}

function clearForm() {
    document.getElementById('elektronik_id').value = '';
    document.getElementById('nama_barang').value = '';
    document.getElementById('deskripsi').value = '';
    document.getElementById('harga').value = '';
    document.getElementById('stok').value = '';
    document.getElementById('gambar').value = '';
}

function saveData() {
    const id = document.getElementById('elektronik_id').value;

    const formData = new FormData();
    formData.append('nama_barang', document.getElementById('nama_barang').value);
    formData.append('deskripsi', document.getElementById('deskripsi').value);
    formData.append('harga', document.getElementById('harga').value);
    formData.append('stok', document.getElementById('stok').value);

    const gambar = document.getElementById('gambar').files[0];
    if (gambar) {
        formData.append('gambar', gambar);
    }

    let url = API_URL;
    let method = 'POST';

    if (id) {
        url = `${API_URL}/${id}`;
        formData.append('_method', 'PUT');
    }

    fetch(url, {
        method: method,
        body: formData,
        headers: {
            'Accept': 'application/json'
        }
    }).then(() => {
        hideForm();
        loadData();
    });
}

function editData(id) {
    fetch(`${API_URL}/${id}`)
        .then(res => res.json())
        .then(data => {
            showForm();
            document.getElementById('form-title').innerText = 'Edit Elektronik';
            document.getElementById('elektronik_id').value = data.id;
            document.getElementById('nama_barang').value = data.nama_barang;
            document.getElementById('deskripsi').value = data.deskripsi;
            document.getElementById('harga').value = data.harga;
            document.getElementById('stok').value = data.stok;
        });
}

function deleteData(id) {
    if (!confirm('Hapus data ini?')) return;

    fetch(`${API_URL}/${id}`, {
        method: 'DELETE',
        headers: { 'Accept': 'application/json' }
    }).then(() => loadData());
}
</script>

@endsection
