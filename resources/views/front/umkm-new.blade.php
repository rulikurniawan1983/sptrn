<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Etalase produk UMKM peternakan dan perikanan Kabupaten Bogor." name="description" />
    <title>SPARTAN — UMKM</title>
    <link rel="preload" as="video" href="{{ asset('assets-front-new/images/') }}/umkm.webm" fetchpriority="high" />
    <link href="{{ asset('assets-front-new/css/styles.css?v=14') }}" rel="stylesheet" />
</head>

<body class="page-umkm" data-page="umkm">
    <header class="site-header">
        <div class="container header-inner">
            <a aria-label="SPARTAN beranda" class="brand" href="{{ route('front.home.index') }}">
                <img alt="Logo Bogor" class="brand-logo" style="width: auto;" src="{{ asset('assets/img/logo.webp') }}" />
        <img alt="Logo SPARTAN" class="brand-logo" style="width: auto;" src="{{ asset('assets/img/17350108258803.png') }}" />
            </a>
            <nav aria-label="Navigasi utama" class="desktop-nav"><a data-nav="home" href="{{ route('front.home.index') }}">Beranda</a><a
                    data-nav="livestock" href="{{ route('front.peternakan-info') }}">Peternakan</a><a data-nav="fishery"
                    href="{{ route('front.perikanan-info') }}">Perikanan</a><a data-nav="umkm" href="{{ route('front.umkm-info') }}">UMKM</a><a data-nav="certification"
                     href="{{ route('front.nkv.index') }}">NKV</a></nav>
            <div class="header-actions">
                <form class="search-box" onsubmit="handleSearch(event)">
                    <input aria-label="Cari informasi" placeholder="Cari informasi..." type="search" />
                    <button aria-label="Cari" type="submit">⌕</button>
                </form>
                <a class="login-btn" href="{{ route('login') }}" style="text-decoration:none;"
                    >♙ <span>Login</span></a>
                <button aria-expanded="false" aria-label="Buka menu" class="menu-toggle" id="menuToggle"
                    type="button">☰</button>
            </div>
        </div>
    </header>
    <div class="mobile-panel" id="mobilePanel">
        <nav aria-label="Navigasi seluler" class="mobile-nav"><a data-nav="home" href="{{ route('front.home.index') }}">Beranda</a><a
                data-nav="livestock" href="{{ route('front.peternakan-info') }}">Peternakan</a><a data-nav="fishery"
                href="{{ route('front.perikanan-info') }}">Perikanan</a><a data-nav="umkm" href="{{ route('front.umkm-info') }}">UMKM</a><a data-nav="certification"
                 href="{{ route('front.nkv.index') }}">NKV</a></nav>
        <form class="search-box mobile-search" onsubmit="handleSearch(event)">
            <input aria-label="Cari informasi" placeholder="Cari informasi..." type="search" />
            <button aria-label="Cari" type="submit">⌕</button>
        </form>
        <button class="login-btn mobile-login"
            onclick="showToast('Fitur login siap dihubungkan ke sistem autentikasi.')" >♙ Login</a>
    </div>
    <main>
        <section class="page-hero umkm">
            <video class="hero-video" autoplay loop muted playsinline>
                <source src="{{ asset('assets-front-new/images/') }}/umkm.webm" type="video/webm">
            </video>
            <div class="container page-hero-inner">
                <div class="breadcrumbs"><a href="{{ route('front.home.index') }}">Beranda</a><span>›</span><span>UMKM</span></div>
                <span class="page-kicker">Etalase Lokal SPARTAN</span>
                <h1>UMKM Perikanan &amp; Peternakan</h1>
                <p>Ruang promosi produk lokal, sarana usaha, dan hasil olahan pelaku UMKM peternakan serta perikanan
                    Kabupaten Bogor.</p>
                <div class="page-hero-actions">
                    <a class="btn btn-orange" href="{{ url('register?jenis=UMKM') }}"><i class="ti ti-user-plus me-2"></i> Daftar UMKM</a>
                    <a class="btn btn-ghost" href="#produk">Lihat produk</a>
                    <a class="btn btn-ghost" href="#kategori-umkm">Jelajahi kategori</a>
                </div>
            </div>
        </section>
        <section aria-labelledby="judul-statistik-umkm" class="sector-statistics" id="statistik-umkm">
            <div class="sector-data-banner">
                <div class="container category-grid single-category-grid">
                    <article class="category-card umkm" id="ringkasan-umkm">
                        <div class="category-heading">
                            <div>
                                <h2>Data Pelaku Usaha UMKM DISKANAK</h2>
                                
                            </div>
                        </div>
                        <style>
                            #ringkasan-umkm.category-card {
                                padding: 24px;
                                display: flex;
                                flex-direction: column;
                                min-height: 250px;
                            }
                            #ringkasan-umkm .umkm-two-grid {
                                grid-template-columns: 1fr;
                                max-width: 240px;
                                gap: 8px;
                                margin-top: auto;
                                margin-bottom: 6px;
                            }
                            #ringkasan-umkm .umkm-two-grid .portal-card {
                                min-height: auto;
                                padding: 8px 12px;
                                display: flex;
                                flex-direction: row;
                                align-items: center;
                                gap: 10px;
                                border-radius: 10px;
                            }
                            #ringkasan-umkm .umkm-two-grid .portal-card h2 {
                                color: #1e293b !important;
                                font-size: 0.9rem;
                                margin: 0;
                                font-weight: 700;
                            }
                            #ringkasan-umkm .umkm-two-grid .portal-icon {
                                width: 28px;
                                height: 28px;
                                font-size: 16px;
                                margin-bottom: 0;
                                flex-shrink: 0;
                            }
                            @media (max-width: 640px) {
                                #ringkasan-umkm.category-card {
                                    min-height: auto !important;
                                    padding: 150px 16px 16px 16px !important;
                                }
                                #ringkasan-umkm.category-card::before {
                                    display: block !important;
                                    inset: 0 0 auto 0 !important;
                                    width: 100% !important;
                                    height: 140px !important;
                                    background-size: cover !important;
                                    background-position: center 40% !important;
                                }
                                #ringkasan-umkm.category-card::after {
                                    display: block !important;
                                    inset: 0 0 auto 0 !important;
                                    width: 100% !important;
                                    height: 140px !important;
                                    background: linear-gradient(180deg, rgba(0,0,0,0) 45%, rgba(255, 248, 240, 0.9) 95%, #fff8f0 100%) !important;
                                }
                                #ringkasan-umkm .umkm-two-grid {
                                    max-width: 100%;
                                    grid-template-columns: repeat(2, 1fr) !important;
                                    gap: 8px;
                                    margin: 12px 0;
                                }
                                #ringkasan-umkm .category-button {
                                    position: static;
                                    width: 100%;
                                    margin-top: 10px;
                                }
                            }
                            @media (max-width: 480px) {
                                #ringkasan-umkm .umkm-two-grid .portal-card {
                                    padding: 6px 8px !important;
                                    gap: 6px !important;
                                }
                                #ringkasan-umkm .umkm-two-grid .portal-card h2 {
                                    font-size: 0.8rem !important;
                                }
                                #ringkasan-umkm .umkm-two-grid .portal-icon {
                                    width: 24px !important;
                                    height: 24px !important;
                                    font-size: 14px !important;
                                }
                            }
                        </style>
                        <div class="portal-grid umkm-two-grid">
                            <a class="portal-card orange" href="#tabel-pelaku-umkm" style="text-decoration: none;">
                                <span class="portal-icon">👥</span>
                                <h2>Pelaku UMKM</h2>
                            </a>
                            <a class="portal-card green" href="#produk" style="text-decoration: none;">
                                <span class="portal-icon">🛍️</span>
                                <h2>Produk UMKM</h2>
                            </a>
                        </div>
                        <a class="btn btn-orange category-button" href="#tabel-pelaku-umkm">Lihat Data Pelaku UMKM
                            →</a>
                    </article>
                </div>
            </div>
            <div class="mini-data-strip sector-mini-data-strip">
                @php
                    // Hitung total unik user_id dari produk aktif sebagai "Total UMKM"
                    $total_umkm = \App\Models\UmkmProduct::where('is_active', 1)->distinct('user_id')->count('user_id');
                    // Hitung total produk aktif
                    $total_produk = \App\Models\UmkmProduct::where('is_active', 1)->count();
                    // Dummy/default karena belum ada tabel transaksi dan mitra
                    $total_transaksi = 0;
                    $mitra_bisnis = 0;
                @endphp
                <div class="stats-strip">
                    <div class="stat-item"><span class="stat-icon">🏪</span>
                        <div><b id="stat-umkm-total">{{ $total_umkm }}</b><small>Total UMKM</small></div>
                    </div>
                    <div class="stat-item"><span class="stat-icon">🛍️</span>
                        <div><b id="stat-umkm-produk">{{ $total_produk }}</b><small>Produk Lokal</small></div>
                    </div>
                    <div class="stat-item"><span class="stat-icon">📈</span>
                        <div><b id="stat-umkm-transaksi">{{ $total_transaksi }}</b><small>Total Transaksi</small></div>
                    </div>
                    <div class="stat-item"><span class="stat-icon">🤝</span>
                        <div><b id="stat-umkm-mitra">{{ $mitra_bisnis }}</b><small>Mitra Bisnis</small></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section section-soft-blue" id="tabel-pelaku-umkm">
            <div class="container">
                <div class="section-title-row">
                    <div>
                        <h2 class="section-title"><span class="leaf-mark">🏪</span>Data Pelaku Usaha &amp; UMKM Terdaftar</h2>
                        <p style="margin: 4px 0 0; font-size: 0.9rem; color: #64748b;">Daftar resmi pelaku usaha binaan Dinas Perikanan dan Peternakan Kabupaten Bogor.</p>
                    </div>
                </div>

                <div class="data-tabs-container" style="margin-top: 16px; background: #fff; border-radius: 16px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                    <div class="table-toolbar">
                        <div>
                            <h3 style="margin: 0 0 4px; font-size: 1.1rem; color: #1e293b;">Daftar UMKM Terdaftar</h3>
                            <p style="margin: 0; font-size: 0.82rem; color: #64748b;">Total {{ $umkmList->count() }} Pelaku UMKM aktif.</p>
                        </div>
                        <input type="text" class="table-search-input" id="search-umkm" placeholder="🔍 Cari nama UMKM / kecamatan..." onkeyup="filterTable('table-umkm-list', this.value)">
                    </div>
                    <div class="modern-table-responsive">
                        <table class="modern-data-table" id="table-umkm-list">
                            <thead>
                                <tr>
                                    <th style="width: 60px;">No</th>
                                    <th>Nama UMKM / Usaha</th>
                                    <th>Sektor Usaha</th>
                                    <th>Lokasi / Wilayah</th>
                                    <th>Jumlah Produk</th>
                                    <th>Status</th>
                                    <th style="text-align: center; width: 140px;">Profil UMKM</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($umkmList as $idx => $item)
                                    @php
                                        $roles = $item->roles->pluck('name')->implode(', ') ?: 'UMKM';
                                        $isFish = str_contains(strtolower($roles), 'ikan') || str_contains(strtolower($roles), 'perikanan');
                                        $isFarm = str_contains(strtolower($roles), 'ternak') || str_contains(strtolower($roles), 'peternakan');
                                        $badgeClass = $isFish ? 'badge-blue' : ($isFarm ? 'badge-green' : 'badge-orange');
                                        $kecamatanNames = $item->users_kecamatan->map(function($uk) {
                                            return $uk->kecamatan?->nama;
                                        })->filter()->implode(', ') ?: 'Kabupaten Bogor';
                                    @endphp
                                    <tr class="umkm-data-row">
                                        <td>{{ $idx + 1 }}</td>
                                        <td>
                                            <a href="{{ route('front.umkm-profile', $item->id) }}" style="color: #0f172a; font-weight: 700; text-decoration: none;" onmouseover="this.style.color='#ea580c'" onmouseout="this.style.color='#0f172a'">
                                                {{ $item->name }}
                                            </a>
                                        </td>
                                        <td><span class="badge-tag {{ $badgeClass }}">{{ $roles }}</span></td>
                                        <td>📍 Kec. {{ $kecamatanNames }}</td>
                                        <td>
                                            @if($item->umkm_products_count > 0)
                                                <a href="{{ route('front.umkm-profile', $item->id) }}" style="color: #0284c7; font-weight: 700; text-decoration: none;">{{ $item->umkm_products_count }} Produk</a>
                                            @else
                                                <span style="color: #94a3b8;">-</span>
                                            @endif
                                        </td>
                                        <td><span style="color: #16a34a; font-weight: 700;">✓ Terdaftar</span></td>
                                        <td style="text-align: center;">
                                            <a href="{{ route('front.umkm-profile', $item->id) }}" style="display: inline-flex; align-items: center; gap: 4px; padding: 5px 12px; border-radius: 6px; font-size: 0.8rem; font-weight: 700; text-decoration: none; color: #ea580c; background: #fff7ed; border: 1px solid #fed7aa; transition: all 0.2s;" onmouseover="this.style.background='#ea580c'; this.style.color='#fff';" onmouseout="this.style.background='#fff7ed'; this.style.color='#ea580c';">
                                                Lihat Profil →
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" style="text-align: center; padding: 24px; color: #94a3b8;">Belum ada data pelaku UMKM yang tersedia.</td>
                                    </tr>
                                @endforelse
                                <tr id="umkm-empty-search-row" style="display: none;">
                                    <td colspan="7" style="text-align: center; padding: 24px; color: #94a3b8;">Tidak ada data pelaku UMKM yang cocok dengan pencarian.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Control Strip -->
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-top: 18px; padding-top: 14px; border-top: 1px solid #e2e8f0;">
                        <div style="font-size: 0.85rem; color: #64748b;">
                            Menampilkan <b id="umkm-start-record" style="color: #1e293b;">1</b> - <b id="umkm-end-record" style="color: #1e293b;">10</b> dari <b id="umkm-total-records" style="color: #1e293b;">{{ $umkmList->count() }}</b> Pelaku UMKM
                        </div>
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <button type="button" id="btn-prev-page" onclick="goToPrevPage()" style="padding: 6px 14px; border-radius: 8px; border: 1px solid #cbd5e1; background: #ffffff; color: #334155; font-size: 0.85rem; font-weight: 600; cursor: pointer; transition: all 0.2s;">
                                ‹ Sebelumnya
                            </button>
                            <div id="page-numbers-container" style="display: flex; gap: 4px;"></div>
                            <button type="button" id="btn-next-page" onclick="goToNextPage()" style="padding: 6px 14px; border-radius: 8px; border: 1px solid #cbd5e1; background: #ffffff; color: #334155; font-size: 0.85rem; font-weight: 600; cursor: pointer; transition: all 0.2s;">
                                Selanjutnya ›
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section" id="produk">
            <div class="container">
                <div class="section-title-row">
                    <h2 class="section-title"><span class="leaf-mark">❧</span>Produk UMKM Pilihan</h2><span
                        class="section-link">Etalase SPARTAN</span>
                </div>
                <form method="GET" action="{{ route('front.umkm-info') }}" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: flex-end; margin-bottom: 18px; background: #f8fafc; padding: 16px; border-radius: 12px; border: 1px solid #e2e8f0;">
                    <div style="flex: 1 1 200px; display: flex; flex-direction: column; gap: 6px;">
                        <label style="font-size: 0.82rem; font-weight: 700; color: #334155;">Sektor Usaha</label>
                        <select name="sektor" onchange="this.form.submit()" style="padding: 8px 12px; border-radius: 8px; border: 1px solid #cbd5e1; background: #ffffff; color: #334155; font-size: 0.9rem;">
                            <option value="">Semua Sektor</option>
                            @foreach($sektorList as $key => $label)
                                <option value="{{ $key }}" {{ request('sektor') == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div style="flex: 1 1 220px; display: flex; flex-direction: column; gap: 6px;">
                        <label style="font-size: 0.82rem; font-weight: 700; color: #334155;">Lokasi UMKM</label>
                        <select name="lokasi" onchange="this.form.submit()" style="padding: 8px 12px; border-radius: 8px; border: 1px solid #cbd5e1; background: #ffffff; color: #334155; font-size: 0.9rem;">
                            <option value="">Semua Lokasi</option>
                            @foreach($lokasiList as $key => $label)
                                <option value="{{ $key }}" {{ request('lokasi') == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div style="flex: 1 1 200px; display: flex; flex-direction: column; gap: 6px;">
                        <label style="font-size: 0.82rem; font-weight: 700; color: #334155;">Urutkan Berdasarkan</label>
                        <select name="sort" onchange="this.form.submit()" style="padding: 8px 12px; border-radius: 8px; border: 1px solid #cbd5e1; background: #ffffff; color: #334155; font-size: 0.9rem;">
                            <option value="">Default</option>
                            <option value="harga_asc" {{ request('sort') == 'harga_asc' ? 'selected' : '' }}>Harga Termurah</option>
                            <option value="harga_desc" {{ request('sort') == 'harga_desc' ? 'selected' : '' }}>Harga Termahal</option>
                        </select>
                    </div>
                </form>
                <div class="products-grid">
                    @forelse($products as $product)
                        <article class="product-card">
                            <a href="{{ route('front.umkm-product-detail', $product->id) }}" style="text-decoration: none; color: inherit; display: block;">
                                <img alt="{{ $product->nama_produk }}" src="{{ $product->foto_produk_url }}" />
                                <div class="product-info">
                                    <h3>{{ $product->nama_produk }}</h3><small>{{ $product->satuan }}</small>
                                    <div class="price">Rp{{ number_format($product->harga, 0, ',', '.') }}</div>
                                </div>
                            </a>
                            <div style="padding: 0 1rem 1rem; display: flex; flex-direction: column; gap: 6px;">
                                <a class="buy-btn" style="text-decoration: none; display: block; text-align: center; color: #fff; background: var(--primary-green); padding: 0.5rem; border-radius: 4px; font-weight: 600;"
                                   href="{{ route('front.umkm-product-detail', $product->id) }}">
                                    🔍 Detail Produk
                                </a>
                            </div>
                        </article>
                    @empty
                        <p style="grid-column: 1/-1; text-align: center; padding: 2rem;">Belum ada produk UMKM yang tersedia.</p>
                    @endforelse
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-top: 18px; padding-top: 14px; border-top: 1px solid #e2e8f0;">
                    <div style="font-size: 0.85rem; color: #64748b;">
                        Menampilkan <b style="color: #1e293b;">{{ $products->firstItem() ?? 0 }}</b> - <b style="color: #1e293b;">{{ $products->lastItem() ?? 0 }}</b> dari <b style="color: #1e293b;">{{ $products->total() }}</b> Produk
                    </div>
                    <div style="display: flex; align-items: center; gap: 6px;">
                        @if ($products->onFirstPage())
                            <button type="button" disabled style="padding: 6px 14px; border-radius: 8px; border: 1px solid #cbd5e1; background: #f1f5f9; color: #94a3b8; font-size: 0.85rem; font-weight: 600; cursor: not-allowed;">‹ Sebelumnya</button>
                        @else
                            <a href="{{ $products->previousPageUrl() }}" style="padding: 6px 14px; border-radius: 8px; border: 1px solid #cbd5e1; background: #ffffff; color: #334155; font-size: 0.85rem; font-weight: 600; cursor: pointer; transition: all 0.2s; text-decoration: none;">‹ Sebelumnya</a>
                        @endif
                        @if ($products->hasMorePages())
                            <a href="{{ $products->nextPageUrl() }}" style="padding: 6px 14px; border-radius: 8px; border: 1px solid #cbd5e1; background: #ffffff; color: #334155; font-size: 0.85rem; font-weight: 600; cursor: pointer; transition: all 0.2s; text-decoration: none;">Selanjutnya ›</a>
                        @else
                            <button type="button" disabled style="padding: 6px 14px; border-radius: 8px; border: 1px solid #cbd5e1; background: #f1f5f9; color: #94a3b8; font-size: 0.85rem; font-weight: 600; cursor: not-allowed;">Selanjutnya ›</button>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <section class="section umkm-benefit-section">
            <div class="container value-strip umkm-benefit-strip">
                <div class="value-item"><span class="value-icon green">✓</span>
                    <div><strong>Produk Lokal</strong><small>Mendorong pemasaran pelaku usaha Kabupaten Bogor.</small>
                    </div>
                </div>
                <div class="value-item"><span class="value-icon blue">⌖</span>
                    <div><strong>Dekat dengan Konsumen</strong><small>Mempermudah akses informasi produk dan sektor
                            usaha.</small></div>
                </div>
                <div class="value-item"><span class="value-icon orange">↗</span>
                    <div><strong>Naik Kelas</strong><small>Mendukung penguatan promosi dan identitas produk.</small>
                    </div>
                </div>
                <div class="value-item"><span class="value-icon purple">◎</span>
                    <div><strong>Terhubung</strong><small>Membuka ruang kolaborasi antar pelaku usaha.</small></div>
                </div>
            </div>
        </section>
        <section class="container cta">
            <p>Daftarkan produk UMKM Perikanan atau Peternakan Anda ke dalam etalase SPARTAN.</p>
            <a class="btn btn-blue" href="{{ url('register?jenis=UMKM') }}" style="text-decoration: none;">Daftarkan Produk</a>
        </section>
    </main>
    <footer class="site-footer" id="kontak">
        <div class="footer-wave">
            <svg height="100%" preserveaspectratio="none" version="1.1" viewbox="0 0 1600 900" width="100%"
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <defs>
                    <lineargradient id="bg" x1="0%" x2="100%" y1="0%" y2="0%">
                        <stop offset="0%" style="stop-color:#0878bd;stop-opacity:.4"></stop>
                        <stop offset="50%" style="stop-color:#15963a;stop-opacity:.5"></stop>
                        <stop offset="100%" style="stop-color:#10772e;stop-opacity:.8"></stop>
                    </lineargradient>
                    <path
                        d="M-363.852,502.589c0,0,236.988-41.997,505.475,0s371.981,38.998,575.971,0s293.985-39.278,505.474,5.859s493.475,48.368,716.963-4.995v560.106H-363.852V502.589z"
                        fill="url(#bg)" id="wave"></path>
                </defs>
                <g>
                    <use opacity=".3" xlink:href="#wave">
                        <animatetransform attributename="transform" attributetype="XML" dur="10s"
                            repeatcount="indefinite" type="translate" values="270 230;-334 180;270 230">
                        </animatetransform>
                    </use>
                    <use opacity=".6" xlink:href="#wave">
                        <animatetransform attributename="transform" attributetype="XML" dur="8s"
                            repeatcount="indefinite" type="translate" values="-270 230;243 220;-270 230">
                        </animatetransform>
                    </use>
                    <use opacity=".9" xlink:href="#wave">
                        <animatetransform attributename="transform" attributetype="XML" dur="6s"
                            repeatcount="indefinite" type="translate" values="0 230;-140 200;0 230"></animatetransform>
                    </use>
                </g>
            </svg>
        </div>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand"><a class="brand" href="{{ route('front.home.index') }}"><img alt="Logo Bogor" class="brand-logo" style="width: auto;" src="{{ asset('assets/img/logo.webp') }}" />
        <img alt="Logo SPARTAN" class="brand-logo" style="width: auto;" src="{{ asset('assets/img/17350108258803.png') }}" /></a>
                    <p>SISTEM PELAYANAN AGRIBISNIS<br>PERIKANAN DAN PETERNAKAN</p>
                </div>
                <div class="footer-col">
                    <h4>Sektor</h4>
                    <ul>
                        <li><a href="{{ route('front.peternakan-info') }}">Peternakan</a></li>
                        <li><a href="{{ route('front.perikanan-info') }}">Perikanan</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Informasi</h4>
                    <ul>
                        <li><a href="{{ route('front.umkm-info') }}">Produk UMKM</a></li>
                        <li><a href="{{ route('front.nkv.index') }}">NKV</a></li>
                        <li><a href="{{ route('front.home.index') }}">Beranda</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Kontak</h4>
                    <ul class="contact-list">
                        <li>⌖ <span>Kabupaten Bogor, Jawa Barat</span></li>
                        <li>☎ <span>Dinas Perikanan dan Peternakan</span></li>
                        <li>↗ <span>diskanak.bogorkab.go.id</span></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Ikuti Kami</h4>
                    <div class="socials"><a aria-label="Facebook" href="#">f</a><a aria-label="Instagram"
                            href="#">◎</a><a aria-label="YouTube" href="#">▶</a><a aria-label="WhatsApp" href="#">✆</a>
                    </div>
                </div>
            </div>
            <div class="copyright"><span>© 2026 SPARTAN. Hak cipta dilindungi.</span><span>Peternakan • Perikanan • UMKM
                    • Informasi</span></div>
        </div>
    </footer>
    <div aria-live="polite" class="toast" id="toast" role="status"></div>
    <script src="{{ asset('assets-front-new/js/app.js') }}"></script>
    <script>
        let currentUmkmPage = 1;
        const umkmPerPage = 10;
        let filteredUmkmRows = [];

        function initUmkmPagination() {
            const table = document.getElementById('table-umkm-list');
            if (!table) return;
            filteredUmkmRows = Array.from(table.querySelectorAll('tbody tr.umkm-data-row'));
            renderUmkmPage(1);
        }

        function filterTable(tableId, query) {
            const table = document.getElementById(tableId);
            if (!table) return;
            const q = (query || '').toLowerCase().trim();
            const allRows = Array.from(table.querySelectorAll('tbody tr.umkm-data-row'));
            
            filteredUmkmRows = allRows.filter(row => {
                const text = row.textContent.toLowerCase();
                return text.includes(q);
            });

            // Hide all data rows first
            allRows.forEach(r => r.style.display = 'none');
            
            // Check empty state
            const emptyRow = document.getElementById('umkm-empty-search-row');
            if (emptyRow) {
                emptyRow.style.display = (allRows.length > 0 && filteredUmkmRows.length === 0) ? '' : 'none';
            }

            renderUmkmPage(1);
        }

        function renderUmkmPage(page) {
            currentUmkmPage = page;
            const total = filteredUmkmRows.length;
            const totalPages = Math.ceil(total / umkmPerPage) || 1;
            if (currentUmkmPage > totalPages) currentUmkmPage = totalPages;
            if (currentUmkmPage < 1) currentUmkmPage = 1;

            const startIdx = (currentUmkmPage - 1) * umkmPerPage;
            const endIdx = startIdx + umkmPerPage;

            // Hide all data rows
            const table = document.getElementById('table-umkm-list');
            if (!table) return;
            table.querySelectorAll('tbody tr.umkm-data-row').forEach(r => r.style.display = 'none');

            // Show slice of current page
            filteredUmkmRows.slice(startIdx, endIdx).forEach(r => r.style.display = '');

            // Update stats counter
            const startEl = document.getElementById('umkm-start-record');
            const endEl = document.getElementById('umkm-end-record');
            const totalEl = document.getElementById('umkm-total-records');
            if (startEl) startEl.textContent = total > 0 ? (startIdx + 1) : 0;
            if (endEl) endEl.textContent = Math.min(endIdx, total);
            if (totalEl) totalEl.textContent = total;

            // Update button states
            const prevBtn = document.getElementById('btn-prev-page');
            const nextBtn = document.getElementById('btn-next-page');
            if (prevBtn) {
                prevBtn.disabled = currentUmkmPage <= 1;
                prevBtn.style.opacity = currentUmkmPage <= 1 ? '0.45' : '1';
                prevBtn.style.cursor = currentUmkmPage <= 1 ? 'not-allowed' : 'pointer';
            }
            if (nextBtn) {
                nextBtn.disabled = currentUmkmPage >= totalPages;
                nextBtn.style.opacity = currentUmkmPage >= totalPages ? '0.45' : '1';
                nextBtn.style.cursor = currentUmkmPage >= totalPages ? 'not-allowed' : 'pointer';
            }

            // Render page buttons
            const container = document.getElementById('page-numbers-container');
            if (container) {
                container.innerHTML = '';
                for (let i = 1; i <= totalPages; i++) {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.textContent = i;
                    btn.style.padding = '6px 12px';
                    btn.style.borderRadius = '8px';
                    btn.style.fontSize = '0.85rem';
                    btn.style.fontWeight = '700';
                    btn.style.cursor = 'pointer';
                    btn.style.transition = 'all 0.2s';

                    if (i === currentUmkmPage) {
                        btn.style.background = '#ea580c';
                        btn.style.borderColor = '#ea580c';
                        btn.style.color = '#ffffff';
                        btn.style.border = '1px solid #ea580c';
                    } else {
                        btn.style.background = '#ffffff';
                        btn.style.borderColor = '#cbd5e1';
                        btn.style.color = '#334155';
                        btn.style.border = '1px solid #cbd5e1';
                    }

                    btn.onclick = () => renderUmkmPage(i);
                    container.appendChild(btn);
                }
            }
        }

        function goToPrevPage() {
            if (currentUmkmPage > 1) {
                renderUmkmPage(currentUmkmPage - 1);
            }
        }

        function goToNextPage() {
            const totalPages = Math.ceil(filteredUmkmRows.length / umkmPerPage);
            if (currentUmkmPage < totalPages) {
                renderUmkmPage(currentUmkmPage + 1);
            }
        }

        document.addEventListener('DOMContentLoaded', initUmkmPagination);
    </script>
</body>

</html>