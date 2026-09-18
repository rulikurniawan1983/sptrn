@extends('layouts.front-new.app')

@section('title', $product->nama_produk . ' — Etalase UMKM SPARTAN')
@section('meta_description', substr(strip_tags($product->deskripsi ?? 'Beli ' . $product->nama_produk . ' langsung dari UMKM ' . ($product->user->name ?? 'Kabupaten Bogor') . ' di etalase resmi SPARTAN.'), 0, 160))
@section('body_class', 'page-umkm-detail')
@section('data_page', 'umkm-detail')

@push('styles')
<style>
    /* Shopee E-Commerce Style Custom Theme for SPARTAN */
    :root {
        --shopee-orange: #ee4d2d;
        --shopee-orange-hover: #d73211;
        --shopee-orange-bg: #fff5f1;
        --spartan-green: #15963a;
        --spartan-green-hover: #0f752c;
        --spartan-dark: #1e293b;
    }

    .detail-container {
        padding-top: 100px;
        padding-bottom: 60px;
        background: #f8fafc;
    }

    .shopee-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        font-size: 0.88rem;
        margin-bottom: 20px;
        color: #64748b;
    }
    .shopee-breadcrumb a {
        color: #334155;
        text-decoration: none;
        transition: color 0.2s;
    }
    .shopee-breadcrumb a:hover {
        color: var(--shopee-orange);
    }
    .shopee-breadcrumb .separator {
        color: #94a3b8;
    }

    .product-main-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        border: 1px solid #e2e8f0;
        overflow: hidden;
        margin-bottom: 30px;
    }

    /* Product Gallery */
    .product-gallery-wrapper {
        padding: 24px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .main-img-box {
        width: 100%;
        max-width: 420px;
        aspect-ratio: 1/1;
        border-radius: 10px;
        overflow: hidden;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e2e8f0;
        position: relative;
    }
    .main-img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .main-img-box:hover img {
        transform: scale(1.05);
    }

    .trust-badges-strip {
        display: flex;
        gap: 10px;
        margin-top: 16px;
        width: 100%;
        justify-content: center;
        flex-wrap: wrap;
    }
    .trust-badge-item {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 0.75rem;
        background: #f0fdf4;
        color: #166534;
        padding: 6px 10px;
        border-radius: 20px;
        border: 1px solid #bbf7d0;
        font-weight: 500;
    }

    .share-strip {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 20px;
        font-size: 0.85rem;
        color: #64748b;
    }
    .share-btn-round {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        text-decoration: none;
        transition: opacity 0.2s;
        border: none;
        cursor: pointer;
    }
    .share-btn-round:hover {
        opacity: 0.85;
    }

    /* Product Info Section */
    .product-details-wrapper {
        padding: 24px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .product-title-text {
        font-size: 1.45rem;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.35;
        margin-bottom: 10px;
    }

    .rating-row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        font-size: 0.85rem;
        margin-bottom: 18px;
        padding-bottom: 12px;
        border-bottom: 1px solid #f1f5f9;
    }
    .rating-stars {
        color: #f59e0b;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 3px;
    }
    .rating-divider {
        color: #cbd5e1;
    }

    /* Shopee Style Price Box */
    .shopee-price-container {
        background: var(--shopee-orange-bg);
        border: 1px solid #fed7aa;
        border-radius: 8px;
        padding: 16px 20px;
        margin-bottom: 24px;
    }
    .price-kicker {
        font-size: 0.75rem;
        text-transform: uppercase;
        color: #9a3412;
        font-weight: 700;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }
    .price-value-row {
        display: flex;
        align-items: baseline;
        gap: 8px;
    }
    .price-currency {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--shopee-orange);
    }
    .price-number {
        font-size: 2.1rem;
        font-weight: 800;
        color: var(--shopee-orange);
        line-height: 1;
    }
    .price-unit-tag {
        font-size: 0.95rem;
        color: #64748b;
        font-weight: 500;
    }

    /* Spec Table */
    .spec-grid {
        display: grid;
        grid-template-columns: 140px 1fr;
        gap: 12px;
        font-size: 0.9rem;
        margin-bottom: 24px;
    }
    .spec-label {
        color: #64748b;
    }
    .spec-value {
        color: #1e293b;
        font-weight: 600;
    }

    /* Seller Card */
    .seller-card-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 14px 18px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }
    .seller-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: var(--spartan-green);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    /* Quantity Box */
    .qty-row {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 28px;
    }
    .qty-control {
        display: inline-flex;
        align-items: center;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        overflow: hidden;
        background: #fff;
    }
    .qty-btn {
        width: 38px;
        height: 38px;
        background: #f8fafc;
        border: none;
        font-size: 1.1rem;
        font-weight: 700;
        color: #334155;
        cursor: pointer;
        transition: background 0.15s;
    }
    .qty-btn:hover {
        background: #e2e8f0;
    }
    .qty-input {
        width: 50px;
        height: 38px;
        border: none;
        text-align: center;
        font-weight: 700;
        font-size: 0.95rem;
        color: #0f172a;
        outline: none;
    }
    .subtotal-preview {
        font-size: 0.9rem;
        color: #475569;
    }
    .subtotal-amount {
        font-weight: 700;
        color: var(--shopee-orange);
    }

    /* CTA Buttons */
    .cta-button-group {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    .btn-buy-shopee {
        flex: 1;
        min-width: 200px;
        background: linear-gradient(135deg, #ee4d2d 0%, #d73211 100%);
        color: #ffffff !important;
        font-weight: 700;
        font-size: 1.05rem;
        padding: 14px 20px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        box-shadow: 0 4px 14px rgba(238, 77, 45, 0.35);
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }
    .btn-buy-shopee:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(238, 77, 45, 0.45);
        color: #fff !important;
    }
    .btn-chat-seller {
        background: #f0fdf4;
        color: var(--spartan-green) !important;
        border: 1.5px solid var(--spartan-green);
        font-weight: 600;
        font-size: 0.95rem;
        padding: 14px 20px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.2s;
    }
    .btn-chat-seller:hover {
        background: var(--spartan-green);
        color: #fff !important;
    }

    /* Description & Info Card */
    .content-box-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        border: 1px solid #e2e8f0;
        padding: 30px;
        margin-bottom: 40px;
    }
    .section-headline {
        font-size: 1.2rem;
        font-weight: 700;
        color: #0f172a;
        padding-bottom: 12px;
        margin-bottom: 18px;
        border-bottom: 2px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .desc-body-text {
        font-size: 0.95rem;
        line-height: 1.75;
        color: #334155;
        white-space: pre-line;
    }

    /* Related Products Grid */
    .related-products-section {
        margin-top: 20px;
    }

    @media (max-width: 768px) {
        .detail-container {
            padding-top: 80px;
        }
        .product-gallery-wrapper, .product-details-wrapper {
            padding: 16px;
        }
        .price-number {
            font-size: 1.7rem;
        }
        .cta-button-group {
            flex-direction: column;
        }
        .btn-buy-shopee, .btn-chat-seller {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="detail-container">
    <div class="container">

        <!-- Breadcrumb Navigation -->
        <nav aria-label="Breadcrumb" class="shopee-breadcrumb">
            <a href="{{ route('front.home.index') }}">Beranda</a>
            <span class="separator">›</span>
            <a href="{{ route('front.umkm-info') }}">Etalase UMKM</a>
            <span class="separator">›</span>
            @php
                $roleId = $product->user ? $product->user->current_role_id : 101;
                $sektorName = $roleId == 102 ? 'Perikanan' : 'Peternakan';
            @endphp
            <a href="{{ $roleId == 102 ? route('front.perikanan-info') : route('front.peternakan-info') }}">{{ $sektorName }}</a>
            <span class="separator">›</span>
            <span class="text-truncate fw-semibold" style="max-width: 250px;">{{ $product->nama_produk }}</span>
        </nav>

        <!-- Main Product Card (Shopee Style 2-Columns) -->
        <div class="product-main-card">
            <div class="row g-0">
                
                <!-- Left Column: Product Gallery & Image -->
                <div class="col-lg-5 col-md-6 border-end">
                    <div class="product-gallery-wrapper">
                        <div class="main-img-box">
                            <img id="mainProductImg" src="{{ $product->foto_produk_url }}" alt="{{ $product->nama_produk }}">
                        </div>

                        <!-- Trust Badges -->
                        <div class="trust-badges-strip">
                            <div class="trust-badge-item">
                                <span>⭐</span> <span>UMKM Binaan SPARTAN</span>
                            </div>
                            <div class="trust-badge-item">
                                <span>🛡️</span> <span>100% Produk Asli Bogor</span>
                            </div>
                            <div class="trust-badge-item">
                                <span>🌱</span> <span>Langsung dari Petani/Peternak</span>
                            </div>
                        </div>

                        <!-- Social Share Strip -->
                        <div class="share-strip">
                            <span>Bagikan:</span>
                            <a href="https://api.whatsapp.com/send?text={{ urlencode('Cek produk ' . $product->nama_produk . ' di SPARTAN Kabupaten Bogor: ' . url()->current()) }}" target="_blank" class="share-btn-round" style="background:#25D366;" title="Bagikan ke WhatsApp">
                                <i class="ti ti-brand-whatsapp"></i>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="share-btn-round" style="background:#1877F2;" title="Bagikan ke Facebook">
                                <i class="ti ti-brand-facebook"></i>
                            </a>
                            <button type="button" class="share-btn-round" style="background:#64748b;" onclick="copyProductLink()" title="Salin Tautan">
                                <i class="ti ti-link"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Product Info & Shopee Buy Box -->
                <div class="col-lg-7 col-md-6">
                    <div class="product-details-wrapper">
                        <div>
                            <!-- Title -->
                            <h1 class="product-title-text">{{ $product->nama_produk }}</h1>

                            <!-- Rating & Stats Row -->
                            <div class="rating-row">
                                <div class="rating-stars">
                                    <span>5.0</span>
                                    <span>★★★★★</span>
                                </div>
                                <span class="rating-divider">|</span>
                                <span class="text-success fw-semibold"><i class="ti ti-circle-check me-1"></i>Terverifikasi SPARTAN</span>
                                <span class="rating-divider">|</span>
                                <span class="text-muted"><i class="ti ti-eye me-1"></i>Produk Pilihan</span>
                            </div>

                            <!-- Shopee Highlighted Price Box -->
                            <div class="shopee-price-container">
                                <div class="price-kicker">Harga Spesial Produsen Lokal</div>
                                <div class="price-value-row">
                                    <span class="price-currency">Rp</span>
                                    <span class="price-number" id="basePriceDisplay">{{ number_format($product->harga, 0, ',', '.') }}</span>
                                    <span class="price-unit-tag">/ {{ $product->satuan ?? 'Satuan' }}</span>
                                </div>
                                <small class="text-muted d-block mt-1">
                                    <i class="ti ti-discount-2 me-1 text-danger"></i>
                                    Harga langsung dari UMKM produsen tanpa biaya perantara.
                                </small>
                            </div>

                            <!-- Product Specifications -->
                            <div class="spec-grid">
                                <div class="spec-label">Sektor Usaha</div>
                                <div class="spec-value">
                                    @if($roleId == 102)
                                        <span class="badge bg-info"><i class="ti ti-fish me-1"></i>Perikanan</span>
                                    @else
                                        <span class="badge bg-warning text-dark"><i class="ti ti-building-cottage me-1"></i>Peternakan</span>
                                    @endif
                                </div>

                                <div class="spec-label">Satuan Jual</div>
                                <div class="spec-value">{{ $product->satuan ?? 'Per Pcs' }}</div>

                                <div class="spec-label">Lokasi UMKM</div>
                                <div class="spec-value"><i class="ti ti-map-pin me-1 text-danger"></i>Kabupaten Bogor, Jawa Barat</div>

                                <div class="spec-label">Status Legalitas</div>
                                <div class="spec-value text-success"><i class="ti ti-certificate me-1"></i>NIB Terdaftar (SPARTAN)</div>
                            </div>

                            <!-- Seller Info Box (Shopee Store Profile) -->
                            <div class="seller-card-box">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="seller-avatar">
                                        {{ strtoupper(substr($product->user->name ?? 'UMKM', 0, 1)) }}
                                    </div>
                                    <div>
                                        <a href="{{ $product->user ? route('front.umkm-profile', $product->user->id) : '#' }}" style="text-decoration: none; color: inherit;">
                                            <h6 class="mb-0 fw-bold text-dark" style="transition: color 0.2s;" onmouseover="this.style.color='#ea580c'" onmouseout="this.style.color='#1e293b'">
                                                {{ $product->user->name ?? 'Pelaku UMKM Bogor' }}
                                            </h6>
                                        </a>
                                        <small class="text-muted d-block">
                                            <i class="ti ti-shield-check text-success me-1"></i>Penjual Terpercaya • Aktif
                                        </small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    @if($product->user)
                                        <a href="{{ route('front.umkm-profile', $product->user->id) }}" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1" style="font-size: 0.8rem; padding: 4px 10px; border-radius: 6px;">
                                            <i class="ti ti-building-store"></i> Kunjungi Profil
                                        </a>
                                    @endif
                                    @php
                                        $rawPhone = $product->user ? $product->user->no_hp : '';
                                        $phoneClean = preg_replace('/[^0-9]/', '', $rawPhone);
                                        if(str_starts_with($phoneClean, '0')) {
                                            $phoneClean = '62' . substr($phoneClean, 1);
                                        }
                                    @endphp
                                    @if($phoneClean)
                                        <a href="https://wa.me/{{ $phoneClean }}" target="_blank" class="btn btn-sm btn-outline-success d-none d-sm-inline-flex align-items-center gap-1">
                                            <i class="ti ti-brand-whatsapp"></i> Chat Penjual
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <!-- Quantity Selector -->
                            <div class="qty-row">
                                <span class="spec-label">Jumlah Pesanan:</span>
                                <div class="qty-control">
                                    <button type="button" class="qty-btn" onclick="changeQty(-1)">−</button>
                                    <input type="number" id="orderQty" class="qty-input" value="1" min="1" max="999" onchange="calculateTotal()">
                                    <button type="button" class="qty-btn" onclick="changeQty(1)">+</button>
                                </div>
                                <div class="subtotal-preview">
                                    Estimasi: <span class="subtotal-amount" id="subtotalDisplay">Rp{{ number_format($product->harga, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- CTA Button Group -->
                        <div class="cta-button-group">
                            @if($phoneClean)
                                <a id="btnBuyWhatsApp" class="btn-buy-shopee" href="#" target="_blank" onclick="updateWhatsAppLink(event)">
                                    <i class="ti ti-brand-whatsapp fs-5"></i>
                                    <span>Beli Sekarang via WhatsApp</span>
                                </a>
                                <a class="btn-chat-seller" href="https://wa.me/{{ $phoneClean }}?text={{ urlencode('Halo '.$product->user->name.', saya ingin bertanya tentang produk '.$product->nama_produk.' di SPARTAN.') }}" target="_blank">
                                    <i class="ti ti-message-circle fs-5"></i>
                                    <span>Tanya Produk</span>
                                </a>
                            @else
                                <button class="btn-buy-shopee" style="opacity:0.6; cursor:not-allowed;" onclick="alert('Nomor kontak WhatsApp UMKM belum tercantum.')">
                                    <i class="ti ti-brand-whatsapp fs-5"></i>
                                    <span>Kontak Penjual Belum Tersedia</span>
                                </button>
                            @endif
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <!-- Product Description & Guidelines Box -->
        <div class="content-box-card">
            <h3 class="section-headline">
                <i class="ti ti-file-description text-primary"></i>
                <span>Deskripsi &amp; Informasi Produk</span>
            </h3>
            <div class="desc-body-text">
                @if(!empty(trim($product->deskripsi)))
                    {{ $product->deskripsi }}
                @else
                    <p class="text-muted fst-italic">Penjual belum menambahkan deskripsi rinci untuk produk ini. Silakan hubungi penjual melalui WhatsApp untuk spesifikasi detail dan informasi ketersediaan.</p>
                @endif
            </div>

            <div class="mt-4 pt-3 border-top">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="d-flex gap-3 align-items-start p-3 bg-light rounded">
                            <div class="avatar bg-white text-primary rounded-circle shadow-sm d-flex align-items-center justify-content-center">
                                <i class="ti ti-truck-delivery fs-5"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-bold text-dark">Pengiriman Cepat</h6>
                                <small class="text-muted">Pengiriman langsung oleh produsen lokal ke lokasi Anda.</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex gap-3 align-items-start p-3 bg-light rounded">
                            <div class="avatar bg-white text-success rounded-circle shadow-sm d-flex align-items-center justify-content-center">
                                <i class="ti ti-shield-check fs-5"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-bold text-dark">Jaminan Kualitas</h6>
                                <small class="text-muted">Produk segar &amp; higienis terdaftar di portal SPARTAN.</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex gap-3 align-items-start p-3 bg-light rounded">
                            <div class="avatar bg-white text-warning rounded-circle shadow-sm d-flex align-items-center justify-content-center">
                                <i class="ti ti-currency-dollar fs-5"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-bold text-dark">Transaksi Langsung</h6>
                                <small class="text-muted">Pembayaran dan negosiasi aman langsung ke pemilik usaha.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products Section -->
        @if($relatedProducts->count() > 0)
            <div class="related-products-section">
                <div class="section-title-row mb-3">
                    <h3 class="section-title" style="font-size: 1.3rem;"><span class="leaf-mark">❧</span>Rekomendasi Produk Serupa</h3>
                    <a href="{{ route('front.umkm-info') }}" class="section-link">Lihat Semua Produk →</a>
                </div>
                <div class="products-grid">
                    @foreach($relatedProducts as $rel)
                        <article class="product-card">
                            <a href="{{ route('front.umkm-product-detail', $rel->id) }}" style="text-decoration: none; color: inherit; display: block;">
                                <img alt="{{ $rel->nama_produk }}" src="{{ $rel->foto_produk_url }}" />
                                <div class="product-info">
                                    <h3>{{ $rel->nama_produk }}</h3>
                                    <small>{{ $rel->satuan ?? 'Satuan' }}</small>
                                    <div class="price">Rp{{ number_format($rel->harga, 0, ',', '.') }}</div>
                                </div>
                            </a>
                            <div style="padding: 0 1rem 1rem;">
                                <a href="{{ route('front.umkm-product-detail', $rel->id) }}" class="buy-btn" style="text-decoration: none; display: block; text-align: center; color: #fff; background: var(--primary-green); padding: 0.5rem; border-radius: 4px;">
                                    Lihat Detail
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>
@endsection

@push('script')
<script>
    const unitPrice = {{ (float)$product->harga }};
    const sellerPhone = "{{ $phoneClean }}";
    const productName = "{{ addslashes($product->nama_produk) }}";
    const sellerName = "{{ addslashes($product->user->name ?? 'UMKM') }}";
    const productUnit = "{{ addslashes($product->satuan ?? 'Satuan') }}";
    const productUrl = "{{ url()->current() }}";

    function changeQty(delta) {
        const input = document.getElementById('orderQty');
        let currentVal = parseInt(input.value) || 1;
        currentVal += delta;
        if (currentVal < 1) currentVal = 1;
        if (currentVal > 999) currentVal = 999;
        input.value = currentVal;
        calculateTotal();
    }

    function calculateTotal() {
        const input = document.getElementById('orderQty');
        let qty = parseInt(input.value) || 1;
        if (qty < 1) {
            qty = 1;
            input.value = 1;
        }
        const total = qty * unitPrice;
        document.getElementById('subtotalDisplay').innerText = 'Rp' + total.toLocaleString('id-ID');
    }

    function updateWhatsAppLink(event) {
        if (!sellerPhone) {
            event.preventDefault();
            alert('Nomor WhatsApp penjual belum tersedia.');
            return;
        }

        const qty = parseInt(document.getElementById('orderQty').value) || 1;
        const total = (qty * unitPrice).toLocaleString('id-ID');

        const message = `Halo *${sellerName}*,\n\nSaya ingin memesan produk Anda melalui Portal SPARTAN Kab. Bogor:\n` +
                        `• Produk: *${productName}*\n` +
                        `• Jumlah: *${qty} ${productUnit}*\n` +
                        `• Estimasi Total: *Rp ${total}*\n` +
                        `• Link Produk: ${productUrl}\n\n` +
                        `Mohon info ketersediaan stok dan konfirmasi pesanannya. Terima kasih!`;

        const waUrl = `https://wa.me/${sellerPhone}?text=${encodeURIComponent(message)}`;
        window.open(waUrl, '_blank');
        event.preventDefault();
    }

    function copyProductLink() {
        navigator.clipboard.writeText(window.location.href).then(() => {
            alert('Tautan produk berhasil disalin!');
        }).catch(() => {
            prompt('Salin tautan produk di bawah ini:', window.location.href);
        });
    }
</script>
@endpush

