@extends('layouts.front-new.app')

@section('title', 'Profil UMKM ' . $umkm->name . ' — SPARTAN')
@section('meta_description', 'Profil UMKM ' . $umkm->name . ' binaan Dinas Perikanan dan Peternakan Kabupaten Bogor.')
@section('body_class', 'page-umkm-profile')
@section('data_page', 'umkm-profile')

@push('styles')
<style>
    .profile-container {
        padding-top: 100px;
        padding-bottom: 60px;
        background: #f8fafc;
        min-height: 80vh;
    }

    .shopee-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        font-size: 0.88rem;
        margin-bottom: 24px;
        color: #64748b;
    }
    .shopee-breadcrumb a {
        color: #334155;
        text-decoration: none;
        transition: color 0.2s;
    }
    .shopee-breadcrumb a:hover {
        color: #ea580c;
    }
    .shopee-breadcrumb .separator {
        color: #94a3b8;
    }

    /* UMKM Profile Banner Card */
    .umkm-profile-card {
        background: #ffffff;
        border-radius: 18px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 25px rgba(0,0,0,0.05);
        overflow: hidden;
        margin-bottom: 35px;
        position: relative;
    }

    .umkm-profile-header-bg {
        height: 120px;
        background: linear-gradient(135deg, #0284c7 0%, #0d9488 50%, #16a34a 100%);
        position: relative;
    }

    .umkm-profile-body {
        padding: 0 32px 32px;
        position: relative;
    }

    .umkm-avatar-wrapper {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        margin-top: -50px;
        margin-bottom: 20px;
    }

    .umkm-avatar-circle {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: #ffffff;
        border: 4px solid #ffffff;
        box-shadow: 0 4px 14px rgba(0,0,0,0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.4rem;
        font-weight: 800;
        color: #0369a1;
        background: linear-gradient(135deg, #e0f2fe, #bae6fd);
    }

    .umkm-meta-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .chip-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 0.8rem;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 20px;
    }
    .chip-green {
        background: #dcfce7;
        color: #166534;
    }
    .chip-blue {
        background: #e0f2fe;
        color: #0369a1;
    }
    .chip-orange {
        background: #ffedd5;
        color: #c2410c;
    }

    .umkm-title-row h1 {
        font-size: 1.75rem;
        font-weight: 800;
        color: #0f172a;
        margin: 0 0 6px;
    }

    .umkm-desc-text {
        font-size: 0.95rem;
        color: #475569;
        line-height: 1.6;
        max-width: 850px;
        margin-bottom: 24px;
    }

    .umkm-stats-bar {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 16px;
        background: #f8fafc;
        border-radius: 12px;
        padding: 16px 20px;
        border: 1px solid #edf2f7;
    }

    .umkm-stat-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .umkm-stat-cell .icon-box {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
    .umkm-stat-cell .label {
        font-size: 0.78rem;
        color: #64748b;
        display: block;
    }
    .umkm-stat-cell .value {
        font-size: 1rem;
        font-weight: 700;
        color: #1e293b;
        display: block;
    }

    /* Products Section */
    .products-section-title {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 20px;
    }

    .products-section-title h2 {
        font-size: 1.35rem;
        font-weight: 800;
        color: #1e293b;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 20px;
    }

    .product-card {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        display: flex;
        flex-direction: column;
        box-shadow: 0 2px 10px rgba(0,0,0,0.03);
    }

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.08);
    }

    .product-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        background: #f1f5f9;
    }

    .product-info {
        padding: 16px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .product-info h3 {
        font-size: 1.05rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 4px;
        line-height: 1.35;
    }

    .product-info small {
        color: #64748b;
        font-size: 0.8rem;
        margin-bottom: 8px;
    }

    .product-info .price {
        font-size: 1.25rem;
        font-weight: 800;
        color: #ea580c;
        margin-top: auto;
        padding-top: 8px;
    }

    .btn-detail-product {
        margin: 0 16px 16px;
        background: #15963a;
        color: #ffffff !important;
        text-align: center;
        padding: 10px 14px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.88rem;
        text-decoration: none;
        transition: background 0.2s;
        display: block;
    }
    .btn-detail-product:hover {
        background: #0f752c;
    }

    .empty-products-box {
        text-align: center;
        padding: 50px 20px;
        background: #ffffff;
        border-radius: 14px;
        border: 1px dashed #cbd5e1;
        grid-column: 1 / -1;
    }

    @media (max-width: 640px) {
        .umkm-profile-body {
            padding: 0 20px 20px;
        }
        .umkm-title-row h1 {
            font-size: 1.4rem;
        }
        .products-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
        .product-card img {
            height: 140px;
        }
        .product-info h3 {
            font-size: 0.92rem;
        }
        .product-info .price {
            font-size: 1.05rem;
        }
    }
</style>
@endpush

@section('content')
<div class="profile-container">
    <div class="container">
        <!-- Breadcrumb Navigation -->
        <nav class="shopee-breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('front.home.index') }}">Beranda</a>
            <span class="separator">›</span>
            <a href="{{ route('front.umkm-info') }}">UMKM</a>
            <span class="separator">›</span>
            <a href="{{ route('front.umkm-info') }}#tabel-pelaku-umkm">Daftar Pelaku Usaha</a>
            <span class="separator">›</span>
            <span style="color: #0f172a; font-weight: 600;">{{ $umkm->name }}</span>
        </nav>

        @php
            $roles = $umkm->roles->pluck('name')->implode(', ') ?: 'UMKM';
            $isFish = str_contains(strtolower($roles), 'ikan') || str_contains(strtolower($roles), 'perikanan');
            $isFarm = str_contains(strtolower($roles), 'ternak') || str_contains(strtolower($roles), 'peternakan');
            $chipClass = $isFish ? 'chip-blue' : ($isFarm ? 'chip-green' : 'chip-orange');
            $icon = $isFish ? '🐟' : ($isFarm ? '🐄' : '🏪');
            $kecamatanNames = $umkm->users_kecamatan->map(function($uk) {
                return $uk->kecamatan?->nama;
            })->filter()->implode(', ') ?: 'Kabupaten Bogor';
        @endphp

        <!-- UMKM Profile Main Card -->
        <article class="umkm-profile-card">
            <div class="umkm-profile-header-bg"></div>
            <div class="umkm-profile-body">
                <div class="umkm-avatar-wrapper">
                    <div class="umkm-avatar-circle">
                        {{ $icon }}
                    </div>
                    <div class="umkm-meta-chips">
                        <span class="chip-badge {{ $chipClass }}">
                            <i class="ti ti-tag"></i> Sektor {{ $roles }}
                        </span>
                        <span class="chip-badge chip-green">
                            <i class="ti ti-shield-check"></i> Terverifikasi SPARTAN
                        </span>
                        <span class="chip-badge chip-orange">
                            <i class="ti ti-map-pin"></i> Kec. {{ $kecamatanNames }}
                        </span>
                    </div>
                </div>

                <div class="umkm-title-row">
                    <h1>{{ $umkm->name }}</h1>
                </div>

                <p class="umkm-desc-text">
                    {{ $umkm->deskripsi ?: 'Pelaku usaha binaan resmi Dinas Perikanan dan Peternakan Kabupaten Bogor yang berkomitmen menyajikan produk berkualitas, higienis, dan berdaya saing lokal.' }}
                </p>

                <!-- Statistics Bar -->
                <div class="umkm-stats-bar">
                    <div class="umkm-stat-cell">
                        <div class="icon-box">🛍️</div>
                        <div>
                            <span class="label">Total Produk</span>
                            <span class="value">{{ $products->count() }} Produk Aktif</span>
                        </div>
                    </div>
                    <div class="umkm-stat-cell">
                        <div class="icon-box">📍</div>
                        <div>
                            <span class="label">Wilayah Usaha</span>
                            <span class="value">Kec. {{ $kecamatanNames }}</span>
                        </div>
                    </div>
                    <div class="umkm-stat-cell">
                        <div class="icon-box">🛡️</div>
                        <div>
                            <span class="label">Legalitas & Status</span>
                            <span class="value text-success">Terdaftar Resmi</span>
                        </div>
                    </div>
                    <div class="umkm-stat-cell">
                        <div class="icon-box">📅</div>
                        <div>
                            <span class="label">Tahun Terdaftar</span>
                            <span class="value">{{ $umkm->created_at ? \Carbon\Carbon::parse($umkm->created_at)->format('Y') : '2025' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </article>

        <!-- Products Section -->
        <section class="umkm-products-catalog">
            <div class="products-section-title">
                <h2><span>🛍️</span> Semua Produk dari {{ $umkm->name }}</h2>
                <span style="font-size: 0.88rem; color: #64748b;">Menampilkan {{ $products->count() }} produk</span>
            </div>

            <div class="products-grid">
                @forelse($products as $product)
                    <article class="product-card">
                        <a href="{{ route('front.umkm-product-detail', $product->id) }}" style="text-decoration: none; color: inherit; display: block;">
                            <img alt="{{ $product->nama_produk }}" src="{{ $product->foto_produk_url }}" />
                            <div class="product-info">
                                <h3>{{ $product->nama_produk }}</h3>
                                <small>{{ $product->satuan ?: 'Per Satuan' }}</small>
                                <div class="price">Rp{{ number_format($product->harga, 0, ',', '.') }}</div>
                            </div>
                        </a>
                        <a class="btn-detail-product" href="{{ route('front.umkm-product-detail', $product->id) }}">
                            🔍 Lihat Detail Produk
                        </a>
                    </article>
                @empty
                    <div class="empty-products-box">
                        <div style="font-size: 2.5rem; margin-bottom: 8px;">📦</div>
                        <h3 style="font-size: 1.15rem; color: #1e293b; margin: 0 0 6px;">Belum Ada Produk yang Diunggah</h3>
                        <p style="font-size: 0.88rem; color: #64748b; margin: 0 0 16px;">Pelaku UMKM ini belum menambahkan produk aktif ke etalase SPARTAN.</p>
                        <a href="{{ route('front.umkm-info') }}" class="btn btn-orange" style="text-decoration: none; padding: 8px 18px; border-radius: 8px; font-size: 0.88rem;">
                            ← Kembali ke Etalase UMKM
                        </a>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- Bottom Return CTA -->
        <div style="margin-top: 40px; text-align: center;">
            <a href="{{ route('front.umkm-info') }}#tabel-pelaku-umkm" class="btn btn-outline-secondary" style="text-decoration: none; padding: 10px 22px; border-radius: 8px; font-weight: 600; font-size: 0.9rem; border: 1px solid #cbd5e1; color: #475569; background: #fff;">
                ← Kembali ke Daftar Pelaku UMKM
            </a>
        </div>
    </div>
</div>
@endsection
