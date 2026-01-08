@extends('landingpage.layouts.app')

@section('content')
<br>
<br>
<div class="container py-5">
    <h3 class="mb-4 fw-bold">Beli Produk</h3>

    <form id="formBeli" class="bg-white p-4 rounded shadow-sm">
        <input type="hidden" id="elektronik_id" value="{{ $produk->id }}">

        <div class="mb-3">
            <label class="form-label fw-medium">Nama Pemesan</label>
            <input type="text" 
                   id="nama_pemesan" 
                   class="form-control form-control-lg" 
                   placeholder="Masukkan nama lengkap" 
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Alamat</label>
            <textarea id="alamat" 
                      class="form-control" 
                      rows="3" 
                      placeholder="Masukkan alamat lengkap" 
                      required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Jumlah</label>
            <input type="number" 
                   id="jumlah_pesanan"
                   class="form-control form-control-lg"
                   min="1"
                   max="{{ $produk->stok }}"
                   value="1"
                   required>
            <div class="form-text">
                Stok tersedia: <span class="fw-bold">{{ $produk->stok }}</span> unit
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label fw-medium">Metode Pembayaran</label>
            <select id="metode_pembayaran" class="form-select form-select-lg">
                <option value="transfer_bank">Transfer Bank</option>
                <option value="e_wallet">E-Wallet</option>
                <option value="cod">COD</option>
            </select>
        </div>

        <div class="d-flex gap-3">
            <button type="submit" class="btn btn-dark btn-lg flex-fill">
                Pesan Sekarang
            </button>
            <a href="/" class="btn btn-outline-secondary btn-lg">
                Batal
            </a>
        </div>
    </form>
</div>

<style>
    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #dee2e6;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    
    .form-control-lg {
        padding: 0.75rem 1rem;
        font-size: 1rem;
    }
    
    .btn-lg {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        font-weight: 500;
    }
    
    .form-label {
        color: #333;
        margin-bottom: 0.5rem;
    }
    
    .form-text {
        margin-top: 0.5rem;
        color: #6c757d;
    }
    
    .shadow-sm {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
    }
    
    .rounded {
        border-radius: 10px !important;
    }
</style>

<script>
document.getElementById('formBeli').addEventListener('submit', function(e) {
    e.preventDefault();

    const payload = {
        elektronik_id: document.getElementById('elektronik_id').value,
        nama_pemesan: document.getElementById('nama_pemesan').value,
        alamat: document.getElementById('alamat').value,
        jumlah_pesanan: document.getElementById('jumlah_pesanan').value,
        metode_pembayaran: document.getElementById('metode_pembayaran').value,
        setatus_pembayaran: 'menunggu'
    };

    fetch('/api/pesanan', {
        method: 'POST',
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
        alert('Pesanan berhasil dibuat');
        window.location.href = '/';
    })
    .catch(err => {
        alert(err.message ?? 'Gagal memesan');
    });
});
</script>
@endsection