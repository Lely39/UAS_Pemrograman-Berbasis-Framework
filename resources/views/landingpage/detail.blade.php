@extends('landingpage.layouts.app')

@section('content')
<div class="container py-5">
    <div class="row g-5">
        <!-- Product Image -->
        <div class="col-lg-6 col-md-6">
            <div class="product-image-wrapper shadow-sm rounded-3 overflow-hidden position-relative">
                <div class="position-relative" style="padding-top: 100%; background: #f8f9fa;">
                    @if($produk->gambar)
                    <img src="{{ asset('storage/' . $produk->gambar) }}"
                         class="position-absolute top-0 start-0 w-100 h-100 object-fit-contain p-4"
                         alt="{{ $produk->nama_barang }}"
                         loading="lazy">
                    @else
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                        <i class="fas fa-image fa-4x text-secondary opacity-50"></i>
                    </div>
                    @endif
                </div>
                
                @if($produk->stok == 0)
                <div class="position-absolute top-3 end-3">
                    <span class="badge bg-danger fs-6 px-3 py-2 shadow">
                        <i class="fas fa-times-circle me-1"></i> Habis
                    </span>
                </div>
                @elseif($produk->stok < 5)
                <div class="position-absolute top-3 end-3">
                    <span class="badge bg-warning text-dark fs-6 px-3 py-2 shadow">
                        <i class="fas fa-exclamation-triangle me-1"></i> Stok Terbatas
                    </span>
                </div>
                @endif
            </div>
            
            <!-- Thumbnail Gallery (if you have multiple images) -->
            <div class="row mt-3 g-2">
                <div class="col-3">
                    <div class="thumbnail-item border rounded p-1 cursor-pointer active">
                        <img src="{{ asset('storage/' . $produk->gambar) }}" 
                             class="img-fluid rounded"
                             alt="Thumbnail 1">
                    </div>
                </div>
                <!-- Add more thumbnails here if you have multiple images -->
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-lg-6 col-md-6">
            <!-- Product Title & Category -->
            <div class="mb-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('elektronik') }}" class="text-decoration-none">Produk</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $produk->nama_barang }}</li>
                    </ol>
                </nav>
                
                <h1 class="h2 fw-bold text-dark mb-2">{{ $produk->nama_barang }}</h1>
                
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="rating">
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star-half-alt text-warning"></i>
                        <span class="ms-2 text-muted">(4.5)</span>
                    </div>
                    <span class="text-muted">•</span>
                    <span class="text-success"><i class="fas fa-check-circle me-1"></i> Garansi 1 Tahun</span>
                </div>
            </div>

            <!-- Price Section -->
            <div class="card border-0 bg-light mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted mb-1">Harga</div>
                            <h2 class="text-primary fw-bold display-6 mb-0">
                                Rp {{ number_format($produk->harga, 0, ',', '.') }}
                            </h2>
                        </div>
                        <div class="text-end">
                            <div class="text-muted mb-1">Status Stok</div>
                            @if($produk->stok > 0)
                            <div class="d-flex align-items-center gap-2">
                                <div class="availability-indicator bg-success rounded-circle" style="width: 12px; height: 12px;"></div>
                                <span class="fw-bold text-success">
                                    <i class="fas fa-box me-1"></i>{{ $produk->stok }} Tersedia
                                </span>
                            </div>
                            @else
                            <div class="d-flex align-items-center gap-2">
                                <div class="availability-indicator bg-danger rounded-circle" style="width: 12px; height: 12px;"></div>
                                <span class="fw-bold text-danger">
                                    <i class="fas fa-times-circle me-1"></i>Habis
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Description -->
            <div class="mb-5">
                <h5 class="fw-bold mb-3">Deskripsi Produk</h5>
                <div class="product-description bg-white p-4 rounded-3 border">
                    <p class="mb-0 text-muted" style="line-height: 1.8;">
                        {{ $produk->deskripsi }}
                    </p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="sticky-bottom bg-white py-4 border-top">
                <div class="row g-3">
                    <div class="col-md-6">
                        <a href="{{ route('elektronik') }}" 
                           class="btn btn-outline-dark btn-lg w-100 py-3">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                    <div class="col-md-6">
                        @if($produk->stok > 0)
                        <a href="{{ route('beli', $produk->id) }}" 
                           class="btn btn-primary btn-lg w-100 py-3 shadow">
                            <i class="fas fa-shopping-cart me-2"></i>Beli Sekarang
                        </a>
                        <small class="d-block text-center text-muted mt-2">
                            <i class="fas fa-shipping-fast me-1"></i>Gratis Ongkir • 
                            <i class="fas fa-shield-alt ms-2 me-1"></i>Garansi Resmi
                        </small>
                        @else
                        <button class="btn btn-secondary btn-lg w-100 py-3" disabled>
                            <i class="fas fa-times-circle me-2"></i>Stok Habis
                        </button>
                        <div class="alert alert-warning mt-2 mb-0">
                            <small>
                                <i class="fas fa-info-circle me-1"></i>
                                Produk akan tersedia kembali dalam waktu dekat
                            </small>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Product Features -->
            <div class="mt-5 pt-4 border-top">
                <h5 class="fw-bold mb-4">Fitur Utama</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3 p-3 bg-light rounded">
                            <div class="feature-icon bg-primary text-white rounded-circle p-2">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-bold">Garansi 1 Tahun</h6>
                                <small class="text-muted">Garansi resmi produsen</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3 p-3 bg-light rounded">
                            <div class="feature-icon bg-success text-white rounded-circle p-2">
                                <i class="fas fa-shipping-fast"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-bold">Gratis Ongkir</h6>
                                <small class="text-muted">Min. pembelian Rp 500.000</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3 p-3 bg-light rounded">
                            <div class="feature-icon bg-warning text-white rounded-circle p-2">
                                <i class="fas fa-headset"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-bold">Support 24/7</h6>
                                <small class="text-muted">Customer service siap membantu</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3 p-3 bg-light rounded">
                            <div class="feature-icon bg-info text-white rounded-circle p-2">
                                <i class="fas fa-undo-alt"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-bold">Return 14 Hari</h6>
                                <small class="text-muted">Garansi uang kembali</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
    <div class="row mt-5 pt-5 border-top">
        <div class="col-12">
            <h4 class="fw-bold mb-4">Produk Serupa</h4>
            <div class="row g-4">
                @foreach($relatedProducts as $related)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card product-card h-100 border-0 shadow-sm hover-lift">
                        <div class="position-relative overflow-hidden rounded-top" style="height: 200px;">
                            @if($related->gambar)
                            <img src="{{ asset('storage/' . $related->gambar) }}" 
                                 class="card-img-top h-100 object-fit-contain p-3"
                                 alt="{{ $related->nama_barang }}">
                            @endif
                            @if($related->stok == 0)
                            <div class="position-absolute top-0 start-0 bg-danger text-white px-3 py-1">
                                <small>Habis</small>
                            </div>
                            @endif
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title fw-bold mb-2">{{ Str::limit($related->nama_barang, 40) }}</h6>
                            <p class="text-muted small flex-grow-1">{{ Str::limit($related->deskripsi, 60) }}</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="text-primary mb-0">Rp {{ number_format($related->harga, 0, ',', '.') }}</h5>
                                    <span class="badge bg-secondary">{{ $related->stok }} stok</span>
                                </div>
                                <a href="{{ route('beli', $related->id) }}" 
                                   class="btn btn-outline-primary w-100">
                                    <i class="fas fa-eye me-2"></i>Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('styles')
<style>
.product-image-wrapper {
    border: 1px solid #eee;
    background: white;
}

.thumbnail-item {
    cursor: pointer;
    transition: all 0.3s ease;
}

.thumbnail-item:hover,
.thumbnail-item.active {
    border-color: #0d6efd !important;
    transform: translateY(-2px);
}

.product-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}

.feature-icon {
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.availability-indicator {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { opacity: 1; }
    50% { opacity: 0.5; }
    100% { opacity: 1; }
}

.sticky-bottom {
    position: sticky;
    bottom: 0;
    z-index: 10;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
}

.hover-lift {
    transition: all 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-8px);
}

.breadcrumb {
    background: transparent;
    padding-left: 0;
}

.object-fit-contain {
    object-fit: contain;
}

.rating i {
    font-size: 0.9rem;
}

.product-description {
    line-height: 1.8;
    font-size: 1rem;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll for page load
    window.scrollTo(0, 0);
    
    // Thumbnail interaction
    const thumbnails = document.querySelectorAll('.thumbnail-item');
    const mainImage = document.querySelector('.product-image-wrapper img');
    
    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
            // Remove active class from all thumbnails
            thumbnails.forEach(t => t.classList.remove('active'));
            
            // Add active class to clicked thumbnail
            this.classList.add('active');
            
            // Change main image
            const thumbImg = this.querySelector('img');
            if (thumbImg && mainImage) {
                mainImage.src = thumbImg.src;
            }
        });
    });
    
    // Add to wishlist functionality
    const wishlistBtn = document.querySelector('.wishlist-btn');
    if (wishlistBtn) {
        wishlistBtn.addEventListener('click', function() {
            this.classList.toggle('text-danger');
            const icon = this.querySelector('i');
            if (icon.classList.contains('far')) {
                icon.classList.replace('far', 'fas');
                showToast('Ditambahkan ke wishlist');
            } else {
                icon.classList.replace('fas', 'far');
                showToast('Dihapus dari wishlist');
            }
        });
    }
    
    // Share functionality
    const shareBtn = document.querySelector('.share-btn');
    if (shareBtn && navigator.share) {
        shareBtn.style.display = 'block';
        shareBtn.addEventListener('click', async () => {
            try {
                await navigator.share({
                    title: '{{ $produk->nama_barang }}',
                    text: 'Lihat produk ini: {{ $produk->nama_barang }}',
                    url: window.location.href,
                });
            } catch (err) {
                console.log('Error sharing:', err);
            }
        });
    }
    
    function showToast(message) {
        // Simple toast implementation
        const toast = document.createElement('div');
        toast.className = 'position-fixed bottom-0 end-0 m-3 p-3 bg-dark text-white rounded shadow';
        toast.textContent = message;
        toast.style.zIndex = '9999';
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.remove();
        }, 3000);
    }
    
    // Stock warning for low stock
    const stock = {{ $produk->stok }};
    if (stock > 0 && stock < 5) {
        const stockWarning = document.createElement('div');
        stockWarning.className = 'alert alert-warning alert-dismissible fade show mt-3';
        stockWarning.innerHTML = `
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Hati-hati!</strong> Hanya tersisa ${stock} unit. Buruan sebelum kehabisan!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.querySelector('.action-buttons').prepend(stockWarning);
    }
});
</script>
@endpush