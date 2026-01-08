@extends('admin.layouts_admin.app')

@section('content')
<div id="content" class="app-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-11">

                <!-- TABLE -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Data Pesanan</h5>
                        <button class="btn btn-primary btn-sm" onclick="showForm()">Tambah Pesanan</button>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Produk</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Jumlah</th>
                                <th>Metode</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody id="pesanan-table"></tbody>
                        </table>
                    </div>
                </div>

                <!-- FORM -->
                <div class="card mt-4 d-none" id="form-pesanan">
                    <div class="card-header">
                        <h5 id="form-title">Tambah Pesanan</h5>
                    </div>

                    <div class="card-body">
                        <input type="hidden" id="pesanan_id">

                        <div class="mb-2">
                            <label>Produk</label>
                            <select id="elektronik_id" class="form-control"></select>
                        </div>

                        <div class="mb-2">
                            <label>Nama Pemesan</label>
                            <input type="text" id="nama_pemesan" class="form-control">
                        </div>

                        <div class="mb-2">
                            <label>Alamat</label>
                            <textarea id="alamat" class="form-control"></textarea>
                        </div>

                        <div class="mb-2">
                            <label>Jumlah</label>
                            <input type="number" id="jumlah_pesanan" class="form-control">
                        </div>

                        <div class="mb-2">
                            <label>Metode Pembayaran</label>
                            <select id="metode_pembayaran" class="form-control">
                                <option value="transfer_bank">Transfer Bank</option>
                                <option value="e_wallet">E-Wallet</option>
                                <option value="cod">COD</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Status Pembayaran</label>
                            <select id="setatus_pembayaran" class="form-control">
                                <option value="menunggu">Menunggu</option>
                                <option value="dibayar">Dibayar</option>
                                <option value="gagal">Gagal</option>
                            </select>
                        </div>

                        <button class="btn btn-success" onclick="saveData()">Simpan</button>
                        <button class="btn btn-secondary" onclick="hideForm()">Batal</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
const API_PESANAN = '/api/pesanan';
const API_ELEKTRONIK = '/api/elektronik';
let stokElektronik = {};

document.addEventListener('DOMContentLoaded', () => {
    loadData();
    loadElektronik();
});

function loadData() {
    fetch(API_PESANAN)
        .then(res => res.json())
        .then(data => {
            let html = '';
            data.forEach((item, i) => {
                html += `
                <tr>
                    <td>${i+1}</td>
                    <td>${item.elektronik?.nama_barang ?? '-'}</td>
                    <td>${item.nama_pemesan}</td>
                    <td>${item.alamat}</td>
                    <td>${item.jumlah_pesanan}</td>
                    <td>${item.metode_pembayaran}</td>
                    <td>
                        <span class="badge bg-${
                            item.setatus_pembayaran === 'dibayar' ? 'success' :
                            item.setatus_pembayaran === 'gagal' ? 'danger' : 'warning'
                        }">${item.setatus_pembayaran}</span>
                    </td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="editData(${item.id})">Edit</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteData(${item.id})">Hapus</button>
                    </td>
                </tr>`;
            });
            document.getElementById('pesanan-table').innerHTML = html;
        });
}

function loadElektronik() {
    fetch(API_ELEKTRONIK)
        .then(res => res.json())
        .then(data => {
            let opt = '';
            data.forEach(item => {
                stokElektronik[item.id] = item.stok;
                opt += `<option value="${item.id}">
                    ${item.nama_barang} (stok: ${item.stok})
                </option>`;
            });
            document.getElementById('elektronik_id').innerHTML = opt;
        });
}

function showForm() {
    document.getElementById('form-pesanan').classList.remove('d-none');
    document.getElementById('form-title').innerText = 'Tambah Pesanan';
    clearForm();
}

function hideForm() {
    document.getElementById('form-pesanan').classList.add('d-none');
}

function clearForm() {
    document.getElementById('pesanan_id').value = '';
    document.getElementById('nama_pemesan').value = '';
    document.getElementById('alamat').value = '';
    document.getElementById('jumlah_pesanan').value = '';
    document.getElementById('setatus_pembayaran').value = 'menunggu';
}

function saveData() {
    const id = document.getElementById('pesanan_id').value;
    const elektronikId = document.getElementById('elektronik_id').value;
    const jumlah = parseInt(document.getElementById('jumlah_pesanan').value);

    if (jumlah > stokElektronik[elektronikId]) {
        alert('Jumlah pesanan melebihi stok!');
        return;
    }

    const payload = {
        elektronik_id: elektronikId,
        nama_pemesan: document.getElementById('nama_pemesan').value,
        alamat: document.getElementById('alamat').value,
        jumlah_pesanan: jumlah,
        metode_pembayaran: document.getElementById('metode_pembayaran').value,
        setatus_pembayaran: document.getElementById('setatus_pembayaran').value
    };

    fetch(id ? `${API_PESANAN}/${id}` : API_PESANAN, {
        method: id ? 'PUT' : 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify(payload)
    })
    .then(res => {
        if (!res.ok) return res.json().then(e => Promise.reject(e));
        return res.json();
    })
    .then(() => {
        hideForm();
        loadData();
        loadElektronik();
    })
    .catch(err => {
        alert(err.message ?? 'Gagal menyimpan data');
    });
}

function editData(id) {
    fetch(`${API_PESANAN}/${id}`)
        .then(res => res.json())
        .then(data => {
            showForm();
            document.getElementById('form-title').innerText = 'Edit Pesanan';
            document.getElementById('pesanan_id').value = data.id;
            document.getElementById('elektronik_id').value = data.elektronik_id;
            document.getElementById('nama_pemesan').value = data.nama_pemesan;
            document.getElementById('alamat').value = data.alamat;
            document.getElementById('jumlah_pesanan').value = data.jumlah_pesanan;
            document.getElementById('metode_pembayaran').value = data.metode_pembayaran;
            document.getElementById('setatus_pembayaran').value = data.setatus_pembayaran;
        });
}

function deleteData(id) {
    if (!confirm('Hapus pesanan ini?')) return;
    fetch(`${API_PESANAN}/${id}`, { method: 'DELETE' })
        .then(() => {
            loadData();
            loadElektronik();
        });
}
</script>
@endsection
