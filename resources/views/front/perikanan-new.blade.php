<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Informasi budidaya, perikanan tangkap, produk, dan edukasi perikanan." name="description" />
    <title>SPARTAN — Perikanan</title>
    <link href="{{ asset('assets/vendor/libs/leaflet/leaflet.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendor/libs/select2/select2.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/leaflet/leaflet.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/highcharts/highcharts.js') }}"></script>
    <link href="{{ asset('assets-front-new/css/styles.css?v=14') }}" rel="stylesheet" />
</head>

<body class="page-fishery" data-page="fishery" data-sector="perikanan">
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
        <section class="page-hero fishery">
            <video class="hero-video" autoplay loop muted playsinline>
                <source src="{{ asset('assets-front-new/images/') }}/ikan.webm" type="video/webm">
            </video>
            <div class="container page-hero-inner">
                <div class="breadcrumbs"><a href="{{ route('front.home.index') }}">Beranda</a><span>›</span><span>Perikanan</span></div>
                <span class="page-kicker">Sektor SPARTAN</span>
                <h1>Perikanan</h1>
                <p>Halaman khusus informasi budidaya, perikanan tangkap, sarana, produk, dan edukasi perikanan Kabupaten
                    Bogor.</p>
                <div class="page-hero-actions">
                    <a class="btn btn-blue" href="#data-perikanan-2025" onclick="switchPerikananTab('tab-ikan-konsumsi')">Lihat informasi</a>
                    <a class="btn btn-ghost" href="#distribusi-perikanan">Buka statistik perikanan</a>
                </div>
            </div>

        </section>
        <!--
        <section class="section sector-intro">
            <div class="container category-grid single-category-grid">
                <article class="category-card fishery" id="ringkasan-perikanan">
                    <div class="category-heading">
                        <div>
                            <h2>Data Sektoral Perikanan</h2>
                           
                        </div>
                    </div>
                    <div class="category-items">
                        <div class="category-item"><span>≋</span>Budidaya</div>
                        <div class="category-item"><span>⚓</span>Tangkap</div>
                        <div class="category-item"><span>◔</span>Pakan Ikan</div>
                        <div class="category-item"><span>▣</span>Kolam</div>
                        <div class="category-item"><span>♜</span>Alat Tangkap</div>
                        <div class="category-item"><span>♙</span>Pasar Ikan</div>
                        <div class="category-item"><span>⚙</span>Teknologi</div>
                        <div class="category-item"><span>▦</span>Manajemen</div>
                    </div>
                    <a class="btn btn-blue category-button" href="#statistik-perikanan">Lihat Data &amp; Statistik →</a>
                </article>
            </div>
        </section>-->
        <section aria-labelledby="judul-statistik-perikanan" class="sector-statistics" id="statistik-perikanan">
            <div class="sector-data-banner">
                <div class="container category-grid single-category-grid">
                    <article class="category-card fishery" id="ringkasan-perikanan">
                        <div class="category-heading">
                            <div>
                                <h2>Data Sektoral Perikanan</h2>
                               
                            </div>
                        </div>
                        <style>
                            #ringkasan-perikanan.category-card {
                                padding: 24px;
                            }
                            #ringkasan-perikanan .fishery-category-grid {
                                grid-template-columns: 1fr;
                                max-width: 240px;
                                gap: 8px;
                                margin: 14px 0;
                            }
                            #ringkasan-perikanan .fishery-category-grid .portal-card {
                                min-height: auto;
                                padding: 8px 12px;
                                display: flex;
                                flex-direction: row;
                                align-items: center;
                                gap: 10px;
                                border-radius: 10px;
                            }
                            #ringkasan-perikanan .fishery-category-grid .portal-card h2 {
                                color: #1e293b !important;
                                font-size: 0.9rem;
                                margin: 0;
                                font-weight: 700;
                            }
                            #ringkasan-perikanan .fishery-category-grid .portal-icon {
                                width: 28px;
                                height: 28px;
                                font-size: 16px;
                                margin-bottom: 0;
                                flex-shrink: 0;
                            }
                            @media (max-width: 640px) {
                                #ringkasan-perikanan.category-card {
                                    min-height: auto !important;
                                    padding: 150px 16px 16px 16px !important;
                                }
                                #ringkasan-perikanan.category-card::before {
                                    display: block !important;
                                    inset: 0 0 auto 0 !important;
                                    width: 100% !important;
                                    height: 140px !important;
                                    background-size: cover !important;
                                    background-position: center 40% !important;
                                }
                                #ringkasan-perikanan.category-card::after {
                                    display: block !important;
                                    inset: 0 0 auto 0 !important;
                                    width: 100% !important;
                                    height: 140px !important;
                                    background: linear-gradient(180deg, rgba(0,0,0,0) 45%, rgba(239, 249, 255, 0.9) 95%, #eff9ff 100%) !important;
                                }
                                #ringkasan-perikanan .fishery-category-grid {
                                    max-width: 100%;
                                    grid-template-columns: repeat(2, 1fr);
                                    gap: 8px;
                                    margin: 12px 0;
                                }
                                #ringkasan-perikanan .category-button {
                                    position: static;
                                    width: 100%;
                                    margin-top: 10px;
                                }
                            }
                            @media (max-width: 480px) {
                                #ringkasan-perikanan .fishery-category-grid .portal-card {
                                    padding: 6px 8px !important;
                                    gap: 6px !important;
                                }
                                #ringkasan-perikanan .fishery-category-grid .portal-card h2 {
                                    font-size: 0.8rem !important;
                                }
                                #ringkasan-perikanan .fishery-category-grid .portal-icon {
                                    width: 24px !important;
                                    height: 24px !important;
                                    font-size: 14px !important;
                                }
                            }
                        </style>
                        <div class="portal-grid umkm-category-grid fishery-category-grid">
                            <a class="portal-card blue" href="#data-perikanan-2025" onclick="switchPerikananTab('tab-ikan-konsumsi')">
                                <span class="portal-icon">🐟</span>
                                <h2>Ikan Konsumsi</h2>
                            </a>
                            <a class="portal-card orange" href="#data-perikanan-2025" onclick="switchPerikananTab('tab-ikan-hias')">
                                <span class="portal-icon">🐠</span>
                                <h2>Ikan Hias</h2>
                            </a>
                            <a class="portal-card green" href="#data-perikanan-2025" onclick="switchPerikananTab('tab-benih-ikan')">
                                <span class="portal-icon">🐠</span>
                                <h2>Benih Ikan</h2>
                            </a>
                            <a class="portal-card purple" href="#data-perikanan-2025" onclick="switchPerikananTab('tab-lahan-budidaya')">
                                <span class="portal-icon">🏞️</span>
                                <h2>Lahan &amp; RTP</h2>
                            </a>
                        </div>
                        <a class="btn btn-blue category-button" href="#data-perikanan-2025">Lihat Data &amp; Statistik
                            →</a>
                    </article>
                </div>
            </div>
            <div class="mini-data-strip sector-mini-data-strip">
                <div class="stats-strip" style="display: flex; justify-content: center; align-items: center;">
                    <a href="{{ route('front.bukudata.perikanan') }}" target="_blank" class="stat-item" style="text-decoration: none; cursor: pointer; transition: transform 0.2s; border: none; flex-direction: column; gap: 8px; width: 100%;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        <div style="text-align: center;">
                            <b style="color: white; font-size: 1.25rem;">Buku Data Perikanan 2025</b>
                            <small style="color: rgba(255, 255, 255, 0.9); font-size: 0.85rem; margin-top: 4px;">Klik untuk melihat Laporan SPARTAN</small>
                        </div>
                    </a>
                </div>
            </div>
            <section class="section categories category-data-section sector-map-section" id="peta-perikanan">
                <div class="container category-grid single-category-grid">
                    <article class="category-card data-category-card map-category-card">
                        <div aria-hidden="true" class="data-card-illustration">🗺️</div>
                        <div class="category-heading"><span class="big-icon">⌖</span>
                            <div>
                                <h2>Peta Sebaran Perikanan</h2>
                                <p>Peta interaktif data perikanan per kecamatan hingga desa atau kelurahan di Kabupaten
                                    Bogor.</p>
                            </div>
                        </div>
                        <div class="category-control-row">
                            <div class="category-select-control"><label for="kecamatan-select">
                                    </label><select class="select2-kecamatan" id="kecamatan-select">
                                    <option value="">Semua Kecamatan</option>
                                </select></div>
                            <div aria-label="Keterangan peta" class="category-map-legend"><span><i
                                        class="legend-dot fishery"></i>Perikanan</span></div>
                        </div>
                        <div style="position: relative;">
                            <div aria-label="Peta sebaran perikanan Kabupaten Bogor" class="category-map-panel"
                                id="spartan-map"></div>

                        </div>
                        <span class="btn btn-blue category-button data-category-button">Data Perikanan Aktif</span>
                    </article>
                </div>
            </section>
            <section class="section categories category-data-section price-category-section" id="harga-perikanan">
                <div class="container"> <!--
                    <div class="category-grid single-category-grid">
                        <article class="category-card data-category-card stats-category-card">
                            <div aria-hidden="true" class="data-card-illustration">📊</div>
                            <div class="category-heading"><span class="big-icon">📊</span>
                                <div>
                                    <h2>Statistik Harga Komoditas Perikanan</h2>
                                    <p>Ringkasan harga terendah, tertinggi, rata-rata, dan perubahan harga khusus
                                        komoditas perikanan.</p>
                                </div>
                            </div>
                            <div class="category-items data-category-items stats-category-items">
                                <div class="category-item"><span>▾</span>Terendah</div>
                                <div class="category-item"><span>▴</span>Tertinggi</div>
                                <div class="category-item"><span>≈</span>Rata-Rata</div>
                                <div class="category-item"><span>↗</span>Perbandingan</div>
                            </div>
                            <span class="btn btn-blue category-button data-category-button">Data Harga Perikanan</span>
                        </article>
                    </div>
                    
                    <div class="price-category-grid" id="price-cards-container">
                        <article class="category-card price-category-card price-lowest-card">
                            <div aria-hidden="true" class="data-card-illustration">↓</div>
                            <div class="category-heading"><span class="big-icon">▾</span>
                                <div>
                                    <h2>Harga Terendah</h2>
                                    <p>Harga akhir terendah komoditas perikanan</p>
                                </div>
                            </div>
                            <div class="price-category-value"><span>Harga terkini</span>
                                <h3 id="card-lowest-val">Rp —</h3>
                            </div>
                            <div class="category-items price-category-items">
                                <div class="category-item"><span>▣</span><strong id="card-lowest-name">Memuat
                                        data…</strong></div>
                                <div class="category-item"><span>⌖</span><strong id="card-lowest-market">—</strong>
                                </div>
                            </div>
                        </article>
                        <article class="category-card price-category-card price-highest-card">
                            <div aria-hidden="true" class="data-card-illustration">↑</div>
                            <div class="category-heading"><span class="big-icon">▴</span>
                                <div>
                                    <h2>Harga Tertinggi</h2>
                                    <p>Harga akhir tertinggi komoditas perikanan</p>
                                </div>
                            </div>
                            <div class="price-category-value"><span>Harga terkini</span>
                                <h3 id="card-highest-val">Rp —</h3>
                            </div>
                            <div class="category-items price-category-items">
                                <div class="category-item"><span>▣</span><strong id="card-highest-name">Memuat
                                        data…</strong></div>
                                <div class="category-item"><span>⌖</span><strong id="card-highest-market">—</strong>
                                </div>
                            </div>
                        </article>
                        <article class="category-card price-category-card price-average-card">
                            <div aria-hidden="true" class="data-card-illustration">≈</div>
                            <div class="category-heading"><span class="big-icon">≈</span>
                                <div>
                                    <h2>Harga Rata-Rata</h2>
                                    <p>Rata-rata harga komoditas perikanan</p>
                                </div>
                            </div>
                            <div class="price-category-value"><span>Harga terkini</span>
                                <h3 id="card-avg-val">Rp —</h3>
                            </div>
                            <div class="category-items price-category-items">
                                <div class="category-item"><span>🐟</span><strong id="card-avg-name">Memuat
                                        data…</strong></div>
                                <div class="category-item"><span>↻</span><strong>Data terbaru</strong></div>
                            </div>
                        </article>
                    </div> -->
                    <div class="category-grid single-category-grid category-data-gap">
                        <article class="category-card data-category-card chart-category-card">
                            <div aria-hidden="true" class="data-card-illustration">📈</div>
                            <div class="category-heading"><span class="big-icon">↗</span>
                                <div>
                                    <h2>Grafik Perbandingan Harga Perikanan</h2>
                                    <p>Perbandingan harga awal dan harga akhir komoditas perikanan.</p>
                                </div>
                            </div>
                            <div class="category-items data-category-items chart-category-items">
                                <div class="category-item"><span>◔</span>Harga Awal</div>
                                <div class="category-item"><span>●</span>Harga Akhir</div>
                                <div class="category-item"><span>10</span>Komoditas</div>
                                <div class="category-item"><span>↻</span>Data API</div>
                            </div>
                            <div class="category-chart-panel" id="price-chart-container"></div><span
                                class="btn btn-blue category-button data-category-button">Perbandingan Harga</span>
                        </article>
                    </div>
                    <!--
                    <div class="category-grid single-category-grid category-data-gap">
                        <article class="category-card data-category-card table-category-card">
                            <div aria-hidden="true" class="data-card-illustration">▦</div>
                            <div class="category-heading"><span class="big-icon">▦</span>
                                <div>
                                    <h2>Daftar Perkembangan Harga Perikanan</h2>
                                    <p>Daftar harga difokuskan hanya pada komoditas sektor perikanan.</p>
                                </div>
                            </div>
                            <div class="category-table-panel">
                                <table class="commodity-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Komoditas</th>
                                            <th>Satuan</th>
                                            <th>Harga Awal</th>
                                            <th>Harga Akhir</th>
                                            <th>Perubahan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="commodity-table-body">
                                        <tr>
                                            <td class="table-empty-state" colspan="6">Memuat data harga perikanan...
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div><span class="btn btn-blue category-button data-category-button"
                                id="commodity-sector-status">Komoditas Perikanan</span>
                        </article>
                    </div> -->
                </div>
            </section>
            <section class="section categories district-distribution-section single-sector-distribution"
                id="distribusi-perikanan">
                <div class="container category-grid single-category-grid">
                    <article class="category-card data-category-card distribution-category-card">
                        <div aria-hidden="true" class="data-card-illustration">📍</div>
                        <div class="category-heading"><span class="big-icon">⌖</span>
                            <div>
                                <h2>Distribusi Perikanan Per Kecamatan</h2>
                                <p>Visualisasi jumlah data perikanan berdasarkan wilayah kecamatan di Kabupaten Bogor.
                                </p>
                            </div>
                        </div>
                        <div class="distribution-summary-grid single-sector-summary-grid">
                            <article class="distribution-summary-card fishery"><span
                                    class="distribution-summary-icon">🐟</span>
                                <div><small>Total Perikanan</small><strong id="distribution-total-sector">—</strong>
                                </div>
                            </article>
                            <article class="distribution-summary-card district"><span
                                    class="distribution-summary-icon">⌖</span>
                                <div><small>Total Kecamatan</small><strong id="distribution-total-districts">—</strong>
                                </div>
                            </article>
                            <article class="distribution-summary-card village"><span
                                    class="distribution-summary-icon">▦</span>
                                <div><small>Desa/Kelurahan</small><strong id="distribution-total-villages">—</strong>
                                </div>
                            </article>
                            <article class="distribution-summary-card active"><span
                                    class="distribution-summary-icon">●</span>
                                <div><small>Kecamatan Aktif</small><strong id="distribution-total-active">—</strong>
                                </div>
                            </article>
                        </div>
                        <div class="distribution-donut-grid single-sector-donut-grid">
                            <article class="district-chart-card fishery-chart-card">
                                <header class="district-chart-header">
                                    <div class="district-chart-title-wrap"><span aria-hidden="true"
                                            class="district-chart-icon">🐟</span>
                                        <div>
                                            <h3>Total Perikanan Per Kecamatan</h3>
                                            <p>Distribusi data perikanan</p>
                                        </div>
                                    </div><span class="distribution-live-badge"><i></i> Data API</span>
                                </header>
                                <div class="district-chart-body">
                                    <div aria-label="Diagram donat total perikanan per kecamatan"
                                        id="district-sector-chart" role="img"></div>
                                </div>
                            </article>
                        </div>
                        <span class="btn btn-blue category-button data-category-button"
                            id="distribution-data-status">Memuat Distribusi</span>
                    </article>
                </div>
            </section>
        </section>

        <!-- SECTION BUKU DATA PERIKANAN 2025 ANALYTICS & TABEL -->
        <section class="section bukudata-analytics-section" id="data-perikanan-2025">
            <div class="container">
                <div class="bukudata-header-card">
                    <span class="bukudata-badge">📚 Sumber Resmi: Buku Data Perikanan 2025</span>
                    <h2 style="margin: 0 0 8px; font-size: 1.45rem; font-weight: 800; color: #1e293b;">
                        Data Sektoral &amp; Indikator Kinerja Perikanan Kabupaten Bogor
                    </h2>
                    <p style="margin: 0; font-size: 0.9rem; color: #64748b; max-width: 900px;">
                        Penyajian lengkap data capaian produksi ikan konsumsi, produksi benih, ikan hias unggulan ekspor, sentra Kawasan Minapolitan, luasan lahan budidaya, serta inventaris situ dan unit pengolahan perikanan berdasarkan Buku Data Resmi Dinas Perikanan dan Peternakan Kabupaten Bogor Tahun 2025.
                    </p>

                </div>

                <!-- KAWASAN MINAPOLITAN 4 KECAMATAN -->
                <div class="section-title-row" style="margin-top: 10px;">
                    <h2 class="section-title"><span class="leaf-mark">🌊</span>Sentra Kawasan Minapolitan Kabupaten Bogor</h2>
                </div>
                <div class="zone-grid">
                    <div class="zone-card">
                        <h4><span>🐟</span> Ciseeng — Sentra Pembenihan</h4>
                        <p>Pusat pembenihan dan pembesaran ikan konsumsi air tawar terbesar di Jawa Barat.</p>
                        <div style="background: #e0f2fe; padding: 6px 12px; border-radius: 6px; margin-bottom: 8px; font-weight: 700; color: #0369a1; font-size: 0.85rem;">
                            Produksi: 28.743 Ton
                        </div>
                        <p style="font-size: 0.8rem; color: #475569;"><strong>Komoditas Unggulan:</strong> Benih Lele, Patin, Bawal, Gurame, dan P2MKP Bening Jati.</p>
                    </div>
                    <div class="zone-card">
                        <h4><span>🏪</span> Parung — Pasar &amp; Ikan Hias</h4>
                        <p>Pusat transaksi ikan higienis, pasar benih ikan, dan budidaya ikan hias air tawar.</p>
                        <div style="background: #e0f2fe; padding: 6px 12px; border-radius: 6px; margin-bottom: 8px; font-weight: 700; color: #0369a1; font-size: 0.85rem;">
                            Produksi: 22.020 Ton
                        </div>
                        <p style="font-size: 0.8rem; color: #475569;"><strong>Komoditas Unggulan:</strong> Pasar Ikan Parung, Neon Tetra, Cupang, Guppy, Manfish.</p>
                    </div>
                    <div class="zone-card">
                        <h4><span>🌾</span> Kemang — Sentra Bioflok &amp; Kolam</h4>
                        <p>Kawasan intensifikasi budidaya lele sistem bioflok dan kolam air tenang modern.</p>
                        <div style="background: #e0f2fe; padding: 6px 12px; border-radius: 6px; margin-bottom: 8px; font-weight: 700; color: #0369a1; font-size: 0.85rem;">
                            Produksi: 21.540 Ton
                        </div>
                        <p style="font-size: 0.8rem; color: #475569;"><strong>Komoditas Unggulan:</strong> Lele Dumbo/Sangkuriang, Gurame, Nila Merah, Pakan Mandiri.</p>
                    </div>
                    <div class="zone-card">
                        <h4><span>💧</span> Gunung Sindur — Kolam Tenang</h4>
                        <p>Kawasan budidaya kolam air tenang terintegrasi dengan penangkaran ikan hias ekspor.</p>
                        <div style="background: #e0f2fe; padding: 6px 12px; border-radius: 6px; margin-bottom: 8px; font-weight: 700; color: #0369a1; font-size: 0.85rem;">
                            Produksi: 16.302 Ton
                        </div>
                        <p style="font-size: 0.8rem; color: #475569;"><strong>Komoditas Unggulan:</strong> Ikan Hias Air Tawar, Ikan Mas, Nila, Patin.</p>
                    </div>
                </div>

                <!-- CHARTS ROW -->
                <div class="bukudata-charts-grid">
                    <div class="bukudata-chart-card">
                        <h3>📈 Tren Produksi Ikan Konsumsi (2021 - 2025)</h3>
                        <p>Pertumbuhan volume produksi ikan konsumsi Kabupaten Bogor dalam kurun 5 tahun (Ton).</p>
                        <div id="perikanan-chart-tren" class="bukudata-chart-panel"></div>
                    </div>
                    <div class="bukudata-chart-card">
                        <h3>🐟 Komposisi Komoditas Ikan Konsumsi</h3>
                        <p>Pangsa produksi komoditas ikan air tawar di Kabupaten Bogor.</p>
                        <div id="perikanan-chart-komoditas" class="bukudata-chart-panel"></div>
                    </div>
                </div>

                <!-- DATA TABS CONTAINER -->
                <div class="data-tabs-container">
                    <div class="data-tabs-nav">
                        <button type="button" class="data-tab-button active" onclick="switchPerikananTab('tab-ikan-konsumsi', this)">
                            <span class="stat-icon">🐟</span>
                            <span class="stat-label">Produksi Ikan Konsumsi</span>
                            <span class="stat-val">136.210 <small style="font-size: 0.9rem; font-weight: normal;">Ton</small></span>
                            <span class="stat-sub">Target: 135.546 Ton (Capaian 100,49% | Lele, Nila, Gurame, Mas)</span>
                        </button>
                        <button type="button" class="data-tab-button" onclick="switchPerikananTab('tab-benih-ikan', this)">
                            <span class="stat-icon">🌱</span>
                            <span class="stat-label">Produksi Benih Ikan</span>
                            <span class="stat-val">6.454.889 <small style="font-size: 0.9rem; font-weight: normal;">Ribu ekor</small></span>
                            <span class="stat-sub">2.734 RTP | 1.153,37 Ha Pembenihan di 40 Kecamatan</span>
                        </button>
                        <button type="button" class="data-tab-button" onclick="switchPerikananTab('tab-ikan-hias', this)">
                            <span class="stat-icon">🐠</span>
                            <span class="stat-label">Produksi Ikan Hias</span>
                            <span class="stat-val">335,0 <small style="font-size: 0.9rem; font-weight: normal;">Juta ekor</small></span>
                            <span class="stat-sub">Sentra Ekspor Nasional (Neon Tetra, Cupang, Guppy, Black Ghost, Koi)</span>
                        </button>

                        <button type="button" class="data-tab-button" onclick="switchPerikananTab('tab-lahan-budidaya', this)">
                            <span class="stat-icon">🏞️</span>
                            <span class="stat-label">Lahan &amp; RTP Perikanan</span>
                            <span class="stat-val">7.749 <small style="font-size: 0.9rem; font-weight: normal;">Ha</small></span>
                            <span class="stat-sub">14.064 RTP | Konsumsi Ikan: 38,80 Kg/kapita/tahun</span>
                        </button>
                        <button type="button" class="data-tab-button" onclick="switchPerikananTab('tab-situ-tangkap', this)">
                            <span class="stat-icon">⚓</span>
                            <span class="stat-label">Inventaris Situ &amp; Tangkap</span>
                            <span class="stat-val">95 <small style="font-size: 0.9rem; font-weight: normal;">Situ</small></span>
                            <span class="stat-sub">95 Situ Potensial &amp; 44 Situ Teridentifikasi di Kab. Bogor</span>
                        </button>
                    </div>

                    <!-- TAB 1: IKAN KONSUMSI -->
                    <div id="tab-ikan-konsumsi" class="tab-pane active">
                        <div class="table-toolbar">
                            <div>
                                <h3 style="margin: 0 0 4px; font-size: 1.1rem; color: #1e293b;">Data Produksi Ikan Konsumsi Kabupaten Bogor</h3>
                                <p style="margin: 0; font-size: 0.82rem; color: #64748b;">Rincian volume produksi ikan konsumsi berdasarkan komoditas unggulan.</p>
                            </div>
                            <div class="table-filter-group">
                                <input type="text" class="table-search-input" id="search-ikan-konsumsi" placeholder="🔍 Cari komoditas ikan..." onkeyup="filterIkanKonsumsi()">
                                <select class="table-select-filter" id="filter-komoditas-ikan" onchange="filterIkanKonsumsi()">
                                    <option value="">Semua Komoditas Ikan</option>
                                    <option value="Lele">Ikan Lele</option>
                                    <option value="Nila">Ikan Nila</option>
                                    <option value="Gurame">Ikan Gurame</option>
                                    <option value="Mas">Ikan Mas</option>
                                    <option value="Patin">Ikan Patin</option>
                                    <option value="Bawal">Ikan Bawal</option>
                                    <option value="Mujair">Ikan Mujair</option>
                                    <option value="Tawes">Ikan Tawes &amp; Nilem</option>
                                </select>
                                <select class="table-select-filter" id="filter-kecamatan-ikan" onchange="filterIkanKonsumsi()">
                                    <option value="">Semua Kecamatan</option>
                                    <option value="Babakan Madang">Babakan Madang</option>
                                    <option value="Bojonggede">Bojonggede</option>
                                    <option value="Caringin">Caringin</option>
                                    <option value="Cariu">Cariu</option>
                                    <option value="Ciampea">Ciampea</option>
                                    <option value="Ciawi">Ciawi</option>
                                    <option value="Cibinong">Cibinong</option>
                                    <option value="Cibungbulang">Cibungbulang</option>
                                    <option value="Cigombong">Cigombong</option>
                                    <option value="Cigudeg">Cigudeg</option>
                                    <option value="Cijeruk">Cijeruk</option>
                                    <option value="Cileungsi">Cileungsi</option>
                                    <option value="Ciomas">Ciomas</option>
                                    <option value="Cisarua">Cisarua</option>
                                    <option value="Ciseeng">Ciseeng</option>
                                    <option value="Citeureup">Citeureup</option>
                                    <option value="Dramaga">Dramaga</option>
                                    <option value="Gunung Putri">Gunung Putri</option>
                                    <option value="Gunung Sindur">Gunung Sindur</option>
                                    <option value="Jasinga">Jasinga</option>
                                    <option value="Jonggol">Jonggol</option>
                                    <option value="Kemang">Kemang</option>
                                    <option value="Klapanunggal">Klapanunggal</option>
                                    <option value="Leuwiliang">Leuwiliang</option>
                                    <option value="Leuwisadeng">Leuwisadeng</option>
                                    <option value="Megamendung">Megamendung</option>
                                    <option value="Nanggung">Nanggung</option>
                                    <option value="Pamijahan">Pamijahan</option>
                                    <option value="Parung">Parung</option>
                                    <option value="Parungpanjang">Parung Panjang</option>
                                    <option value="Rancabungur">Ranca Bungur</option>
                                    <option value="Rumpin">Rumpin</option>
                                    <option value="Sukajaya">Sukajaya</option>
                                    <option value="Sukamakmur">Sukamakmur</option>
                                    <option value="Sukaraja">Sukaraja</option>
                                    <option value="Tajurhalang">Tajurhalang</option>
                                    <option value="Tamansari">Tamansari</option>
                                    <option value="Tanjungsari">Tanjungsari</option>
                                    <option value="Tenjo">Tenjo</option>
                                    <option value="Tenjolaya">Tenjolaya</option>
                                </select>
                            </div>
                        </div>
                        <div class="modern-table-responsive">
                            <table class="modern-data-table" id="table-ikan-konsumsi">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Komoditas</th>
                                        <th>Nama Ilmiah</th>
                                        <th class="text-right">Produksi (Ton)</th>
                                        <th class="text-right">Pangsa (%)</th>
                                        <th>Metode Utama</th>
                                        <th>Sentra Kecamatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>1</td><td><strong>Ikan Lele</strong></td><td><em>Clarias gariepinus</em></td><td class="text-right"><strong>87.350,00</strong></td><td class="text-right">64,13%</td><td>Kolam Air Tenang &amp; Terpal Bioflok</td><td>Ciseeng, Parung, Kemang, Gunung Sindur</td></tr>
                                    <tr><td>2</td><td><strong>Ikan Nila</strong></td><td><em>Oreochromis niloticus</em></td><td class="text-right"><strong>22.180,00</strong></td><td class="text-right">16,28%</td><td>Kolam Air Tenang &amp; Deras</td><td>Caringin, Cijeruk, Babakan Madang, Jonggol</td></tr>
                                    <tr><td>3</td><td><strong>Ikan Gurame</strong></td><td><em>Osphronemus goramy</em></td><td class="text-right"><strong>11.450,00</strong></td><td class="text-right">8,41%</td><td>Kolam Tanah &amp; Air Tenang</td><td>Ciseeng, Parung, Ciampea, Cibungbulang</td></tr>
                                    <tr><td>4</td><td><strong>Ikan Mas</strong></td><td><em>Cyprinus carpio</em></td><td class="text-right"><strong>8.320,00</strong></td><td class="text-right">6,11%</td><td>Kolam Air Deras &amp; Sawah</td><td>Caringin, Megamendung, Ciawi, Sukamakmur</td></tr>
                                    <tr><td>5</td><td><strong>Ikan Patin</strong></td><td><em>Pangasius sp.</em></td><td class="text-right"><strong>4.120,00</strong></td><td class="text-right">3,02%</td><td>Kolam Air Tenang Luas</td><td>Ciseeng, Gunungsindur, Kemang</td></tr>
                                    <tr><td>6</td><td><strong>Ikan Bawal Air Tawar</strong></td><td><em>Colossoma macropomum</em></td><td class="text-right"><strong>2.126,00</strong></td><td class="text-right">1,56%</td><td>Kolam Air Tenang</td><td>Babakan Madang, Sukaraja, Kemang</td></tr>
                                    <tr><td>7</td><td><strong>Ikan Mujair</strong></td><td><em>Oreochromis mossambicus</em></td><td class="text-right"><strong>420,00</strong></td><td class="text-right">0,31%</td><td>Kolam Rakyat &amp; Perairan Umum</td><td>Tersebar</td></tr>
                                    <tr><td>8</td><td><strong>Ikan Tawes &amp; Nilem</strong></td><td><em>Barbonymus gonionotus</em></td><td class="text-right"><strong>244,00</strong></td><td class="text-right">0,18%</td><td>Kolam Air Tenang &amp; Sawah</td><td>Jonggol, Cariu, Tanjungsari</td></tr>
                                    <tr style="background:#f1f5f9; font-weight:bold;">
                                        <td>-</td><td><strong>TOTAL PRODUKSI IKAN KONSUMSI</strong></td><td>-</td><td class="text-right"><strong>136.210,00</strong></td><td class="text-right"><strong>100,00%</strong></td><td>Seluruh Sistem Budidaya</td><td>Kabupaten Bogor</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- TAB BENIH IKAN (HALAMAN 19) -->
                    <div id="tab-benih-ikan" class="tab-pane">
                        <div class="table-toolbar">
                            <div>
                                <h3 style="margin: 0 0 4px; font-size: 1.1rem; color: #1e293b;">Produksi Budidaya Benih Ikan di Kabupaten Bogor Tahun 2025</h3>
                                <p style="margin: 0; font-size: 0.82rem; color: #64748b;">Rincian RTP, luas pembenihan (Ha), total produksi, dan sebaran 10 komoditas benih di 40 kecamatan (Sumber: Buku Data Perikanan Halaman 19).</p>
                            </div>
                            <input type="text" class="table-search-input" id="search-benih" placeholder="🔍 Cari kecamatan / komoditas..." onkeyup="filterTable('table-benih', this.value)">
                        </div>
                        <div class="modern-table-responsive">
                            <table class="modern-data-table" id="table-benih">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kecamatan</th>
                                        <th class="text-right">RTP</th>
                                        <th class="text-right">Luas (Ha)</th>
                                        <th class="text-right">Total Produksi (Ribu Ekor)</th>
                                        <th class="text-right">Bawal</th>
                                        <th class="text-right">Gurame</th>
                                        <th class="text-right">Lele</th>
                                        <th class="text-right">Mas</th>
                                        <th class="text-right">Mujair</th>
                                        <th class="text-right">Nila</th>
                                        <th class="text-right">Nilem</th>
                                        <th class="text-right">Patin</th>
                                        <th class="text-right">Tambakan</th>
                                        <th class="text-right">Tawes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>1</td><td><strong>Babakan Madang</strong></td><td class="text-right">18</td><td class="text-right">2,82</td><td class="text-right"><strong>71.868,99</strong></td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">46.756,63</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">25.112,36</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>2</td><td><strong>Bojong Gede</strong></td><td class="text-right">42</td><td class="text-right">1,19</td><td class="text-right"><strong>36.504,08</strong></td><td class="text-right">-</td><td class="text-right">3.113,58</td><td class="text-right">32.729,64</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">660,85</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>3</td><td><strong>Caringin</strong></td><td class="text-right">28</td><td class="text-right">0,83</td><td class="text-right"><strong>47.625,98</strong></td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">9.351,33</td><td class="text-right">26.379,32</td><td class="text-right">-</td><td class="text-right">11.895,33</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>4</td><td><strong>Cariu</strong></td><td class="text-right">18</td><td class="text-right">0,61</td><td class="text-right"><strong>7.319,07</strong></td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">4.675,66</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">2.643,41</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>5</td><td><strong>Ciampea</strong></td><td class="text-right">118</td><td class="text-right">9,90</td><td class="text-right"><strong>523.998,98</strong></td><td class="text-right">75.763,87</td><td class="text-right">1.807,89</td><td class="text-right">331.972,10</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">15.199,59</td><td class="text-right">-</td><td class="text-right">99.255,54</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>6</td><td><strong>Ciawi</strong></td><td class="text-right">12</td><td class="text-right">0,40</td><td class="text-right"><strong>24.700,02</strong></td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">23.378,32</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">1.321,70</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>7</td><td><strong>Cibinong</strong></td><td class="text-right">38</td><td class="text-right">0,80</td><td class="text-right"><strong>31.601,33</strong></td><td class="text-right">-</td><td class="text-right">903,94</td><td class="text-right">28.053,98</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">2.643,41</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>8</td><td><strong>Cibungbulang</strong></td><td class="text-right">118</td><td class="text-right">10,22</td><td class="text-right"><strong>269.634,01</strong></td><td class="text-right">116.236,03</td><td class="text-right">-</td><td class="text-right">23.378,32</td><td class="text-right">38.969,46</td><td class="text-right">-</td><td class="text-right">48.903,01</td><td class="text-right">-</td><td class="text-right">41.548,83</td><td class="text-right">-</td><td class="text-right">598,37</td></tr>
                                    <tr><td>9</td><td><strong>Cigombong</strong></td><td class="text-right">23</td><td class="text-right">1,01</td><td class="text-right"><strong>30.316,61</strong></td><td class="text-right">2.266,44</td><td class="text-right">1.104,82</td><td class="text-right">4.675,66</td><td class="text-right">13.189,66</td><td class="text-right">-</td><td class="text-right">7.930,22</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">574,68</td><td class="text-right">575,13</td></tr>
                                    <tr><td>10</td><td><strong>Cigudeg</strong></td><td class="text-right">12</td><td class="text-right">0,27</td><td class="text-right"><strong>9.183,76</strong></td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">3.896,95</td><td class="text-right">-</td><td class="text-right">5.286,81</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>11</td><td><strong>Cijeruk</strong></td><td class="text-right">54</td><td class="text-right">1,21</td><td class="text-right"><strong>43.746,85</strong></td><td class="text-right">971,33</td><td class="text-right">602,63</td><td class="text-right">23.378,32</td><td class="text-right">6.295,07</td><td class="text-right">-</td><td class="text-right">11.895,33</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">168,47</td><td class="text-right">435,71</td></tr>
                                    <tr><td>12</td><td><strong>Cileungsi</strong></td><td class="text-right">15</td><td class="text-right">0,22</td><td class="text-right"><strong>660,85</strong></td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">660,85</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>13</td><td><strong>Ciomas</strong></td><td class="text-right">43</td><td class="text-right">0,45</td><td class="text-right"><strong>107.226,62</strong></td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">51.432,30</td><td class="text-right">20.384,02</td><td class="text-right">-</td><td class="text-right">34.364,28</td><td class="text-right">33,11</td><td class="text-right">-</td><td class="text-right">164,73</td><td class="text-right">848,17</td></tr>
                                    <tr><td>14</td><td><strong>Cisarua</strong></td><td class="text-right">47</td><td class="text-right">0,85</td><td class="text-right"><strong>35.873,17</strong></td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">23.378,32</td><td class="text-right">599,53</td><td class="text-right">-</td><td class="text-right">11.895,33</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>15</td><td><strong>Ciseeng</strong></td><td class="text-right">871</td><td class="text-right">981,90</td><td class="text-right"><strong>2.275.661,95</strong></td><td class="text-right">9.389,54</td><td class="text-right">19.585,42</td><td class="text-right">2.024.562,25</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">17.842,99</td><td class="text-right">-</td><td class="text-right">204.281,75</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>16</td><td><strong>Citeureup</strong></td><td class="text-right">15</td><td class="text-right">0,53</td><td class="text-right"><strong>5.336,51</strong></td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">4.675,66</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">660,85</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>17</td><td><strong>Dramaga</strong></td><td class="text-right">45</td><td class="text-right">1,42</td><td class="text-right"><strong>136.832,29</strong></td><td class="text-right">27.844,84</td><td class="text-right">13.659,58</td><td class="text-right">32.729,64</td><td class="text-right">7.494,13</td><td class="text-right">-</td><td class="text-right">52.868,12</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">748,77</td><td class="text-right">1.487,21</td></tr>
                                    <tr><td>18</td><td><strong>Gunung Putri</strong></td><td class="text-right">20</td><td class="text-right">0,83</td><td class="text-right"><strong>4.675,66</strong></td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">4.675,66</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>19</td><td><strong>Gunung Sindur</strong></td><td class="text-right">61</td><td class="text-right">2,58</td><td class="text-right"><strong>237.351,56</strong></td><td class="text-right">1.295,11</td><td class="text-right">4.519,71</td><td class="text-right">229.107,51</td><td class="text-right">-</td><td class="text-right">61,97</td><td class="text-right">1.982,55</td><td class="text-right">-</td><td class="text-right">384,71</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>20</td><td><strong>Jasinga</strong></td><td class="text-right">11</td><td class="text-right">0,22</td><td class="text-right"><strong>2.023,22</strong></td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">40,67</td><td class="text-right">1.982,55</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>21</td><td><strong>Jonggol</strong></td><td class="text-right">13</td><td class="text-right">0,91</td><td class="text-right"><strong>8.180,80</strong></td><td class="text-right">-</td><td class="text-right">200,88</td><td class="text-right">4.675,66</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">3.304,26</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>22</td><td><strong>Kemang</strong></td><td class="text-right">207</td><td class="text-right">3,04</td><td class="text-right"><strong>60.818,22</strong></td><td class="text-right">-</td><td class="text-right">7.030,67</td><td class="text-right">42.080,97</td><td class="text-right">599,53</td><td class="text-right">-</td><td class="text-right">2.643,41</td><td class="text-right">-</td><td class="text-right">8.463,65</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>23</td><td><strong>Klapanunggal</strong></td><td class="text-right">15</td><td class="text-right">1,16</td><td class="text-right"><strong>1.321,70</strong></td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">1.321,70</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>24</td><td><strong>Leuwiliang</strong></td><td class="text-right">56</td><td class="text-right">4,16</td><td class="text-right"><strong>144.054,53</strong></td><td class="text-right">-</td><td class="text-right">1.908,32</td><td class="text-right">130.918,58</td><td class="text-right">3.297,42</td><td class="text-right">-</td><td class="text-right">7.930,22</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>25</td><td><strong>Leuwisadeng</strong></td><td class="text-right">10</td><td class="text-right">0,30</td><td class="text-right"><strong>79.117,70</strong></td><td class="text-right">-</td><td class="text-right">1.205,26</td><td class="text-right">42.080,97</td><td class="text-right">4.496,48</td><td class="text-right">274,98</td><td class="text-right">31.060,02</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>26</td><td><strong>Megamendung</strong></td><td class="text-right">22</td><td class="text-right">0,91</td><td class="text-right"><strong>113.583,58</strong></td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">60.783,62</td><td class="text-right">3.896,95</td><td class="text-right">-</td><td class="text-right">48.903,01</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>27</td><td><strong>Nanggung</strong></td><td class="text-right">43</td><td class="text-right">1,35</td><td class="text-right"><strong>66.123,24</strong></td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">9.351,33</td><td class="text-right">599,53</td><td class="text-right">-</td><td class="text-right">56.172,38</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>28</td><td><strong>Pamijahan</strong></td><td class="text-right">123</td><td class="text-right">11,15</td><td class="text-right"><strong>303.493,52</strong></td><td class="text-right">56.661,02</td><td class="text-right">-</td><td class="text-right">51.432,30</td><td class="text-right">105.217,53</td><td class="text-right">-</td><td class="text-right">78.641,33</td><td class="text-right">-</td><td class="text-right">11.541,34</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>29</td><td><strong>Parung</strong></td><td class="text-right">291</td><td class="text-right">88,94</td><td class="text-right"><strong>1.164.569,77</strong></td><td class="text-right">-</td><td class="text-right">2.510,95</td><td class="text-right">1.145.537,53</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">16.521,29</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>30</td><td><strong>Parung Panjang</strong></td><td class="text-right">10</td><td class="text-right">0,33</td><td class="text-right"><strong>660,85</strong></td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">660,85</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>31</td><td><strong>Rancabungur</strong></td><td class="text-right">64</td><td class="text-right">3,67</td><td class="text-right"><strong>162.037,08</strong></td><td class="text-right">-</td><td class="text-right">25.712,15</td><td class="text-right">70.134,95</td><td class="text-right">12.590,13</td><td class="text-right">-</td><td class="text-right">34.364,28</td><td class="text-right">-</td><td class="text-right">19.235,57</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>32</td><td><strong>Rumpin</strong></td><td class="text-right">13</td><td class="text-right">1,00</td><td class="text-right"><strong>7.979,92</strong></td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">4.675,66</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">3.304,26</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>33</td><td><strong>Sukajaya</strong></td><td class="text-right">7</td><td class="text-right">0,38</td><td class="text-right"><strong>3.102,35</strong></td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">458,94</td><td class="text-right">2.643,41</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>34</td><td><strong>Sukamakmur</strong></td><td class="text-right">34</td><td class="text-right">2,53</td><td class="text-right"><strong>25.255,14</strong></td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">4.675,66</td><td class="text-right">12.889,90</td><td class="text-right">420,21</td><td class="text-right">7.269,37</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>35</td><td><strong>Sukaraja</strong></td><td class="text-right">23</td><td class="text-right">2,30</td><td class="text-right"><strong>47.978,93</strong></td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">37.405,31</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">10.573,62</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>36</td><td><strong>Tajurhalang</strong></td><td class="text-right">57</td><td class="text-right">6,89</td><td class="text-right"><strong>67.183,65</strong></td><td class="text-right">-</td><td class="text-right">16.572,28</td><td class="text-right">32.729,64</td><td class="text-right">-</td><td class="text-right">38,73</td><td class="text-right">17.842,99</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>37</td><td><strong>Tamansari</strong></td><td class="text-right">21</td><td class="text-right">0,36</td><td class="text-right"><strong>159.662,07</strong></td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">102.864,59</td><td class="text-right">2.697,89</td><td class="text-right">-</td><td class="text-right">52.868,12</td><td class="text-right">28,60</td><td class="text-right">-</td><td class="text-right">215,27</td><td class="text-right">987,60</td></tr>
                                    <tr><td>38</td><td><strong>Tanjungsari</strong></td><td class="text-right">36</td><td class="text-right">2,03</td><td class="text-right"><strong>14.284,80</strong></td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">9.351,33</td><td class="text-right">2.098,36</td><td class="text-right">191,71</td><td class="text-right">2.643,41</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>39</td><td><strong>Tenjo</strong></td><td class="text-right">12</td><td class="text-right">0,27</td><td class="text-right"><strong>1.321,70</strong></td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">1.321,70</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">-</td></tr>
                                    <tr><td>40</td><td><strong>Tenjolaya</strong></td><td class="text-right">68</td><td class="text-right">3,43</td><td class="text-right"><strong>122.017,93</strong></td><td class="text-right">33.349,05</td><td class="text-right">-</td><td class="text-right">28.053,98</td><td class="text-right">34.173,22</td><td class="text-right">449,26</td><td class="text-right">25.112,36</td><td class="text-right">2,84</td><td class="text-right">-</td><td class="text-right">-</td><td class="text-right">877,22</td></tr>
                                    <tr style="background:#f1f5f9; font-weight:bold;">
                                        <td>-</td><td><strong>JUMLAH KABUPATEN BOGOR</strong></td><td class="text-right"><strong>2.734</strong></td><td class="text-right"><strong>1.153,37</strong></td><td class="text-right"><strong>6.454.889,00</strong></td><td class="text-right">323.777,23</td><td class="text-right">100.438,07</td><td class="text-right">4.675.663,40</td><td class="text-right">299.765,05</td><td class="text-right">1.936,47</td><td class="text-right">660.851,54</td><td class="text-right">64,55</td><td class="text-right">384.711,38</td><td class="text-right">1.871,92</td><td class="text-right">5.809,40</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- TAB 2: LAHAN & METODE -->
                    <div id="tab-lahan-budidaya" class="tab-pane">
                        <div class="table-toolbar">
                            <div>
                                <h3 style="margin: 0 0 4px; font-size: 1.1rem; color: #1e293b;">Data Luas Lahan &amp; Metode Budidaya Perikanan</h3>
                                <p style="margin: 0; font-size: 0.82rem; color: #64748b;">Rincian luasan lahan efektif dan hasil produksi berdasarkan tipologi budidaya.</p>
                            </div>
                            <input type="text" class="table-search-input" id="search-lahan" placeholder="🔍 Cari metode..." onkeyup="filterTable('table-lahan', this.value)">
                        </div>
                        <div class="modern-table-responsive">
                            <table class="modern-data-table" id="table-lahan">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tipologi / Metode Budidaya</th>
                                        <th class="text-right">Luas Lahan (Ha)</th>
                                        <th class="text-right">Estimasi Produksi (Ton)</th>
                                        <th>Jumlah RTP</th>
                                        <th>Komoditas Utama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>1</td><td><strong>Kolam Air Tenang (KAT)</strong></td><td class="text-right"><strong>6.069,32</strong></td><td class="text-right">128.560,00</td><td>9.370 RTP</td><td>Lele, Nila, Gurame, Patin, Bawal</td></tr>
                                    <tr><td>2</td><td><strong>Pembenihan Ikan (Hatchery)</strong></td><td class="text-right"><strong>1.153,37</strong></td><td class="text-right">11,2 Miliar Ekor</td><td>2.734 RTP</td><td>Larva &amp; Benih Lele, Nila, Gurame, Patin</td></tr>
                                    <tr><td>3</td><td><strong>Mina Padi (Sawah)</strong></td><td class="text-right"><strong>440,00</strong></td><td class="text-right">3.330,00</td><td>650 RTP</td><td>Ikan Mas, Nila, Tawes</td></tr>
                                    <tr><td>4</td><td><strong>Budidaya Ikan Hias</strong></td><td class="text-right"><strong>39,78</strong></td><td class="text-right">335 Juta Ekor</td><td>980 RTP</td><td>Neon Tetra, Cupang, Guppy, Black Ghost</td></tr>
                                    <tr><td>5</td><td><strong>Kolam Air Deras (KAD)</strong></td><td class="text-right"><strong>33,52</strong></td><td class="text-right">2.840,00</td><td>185 RTP</td><td>Ikan Mas &amp; Nila Hitam (Caringin, Ciawi)</td></tr>
                                    <tr><td>6</td><td><strong>Keramba Jaring Apung (KJA)</strong></td><td class="text-right"><strong>13,28</strong></td><td class="text-right">1.480,00</td><td>145 RTP</td><td>Nila &amp; Ikan Mas di Situ/Waduk</td></tr>
                                    <tr style="background:#f1f5f9; font-weight:bold;">
                                        <td>-</td><td><strong>TOTAL KESELURUHAN</strong></td><td class="text-right"><strong>7.749,27</strong></td><td class="text-right"><strong>136.210,00</strong></td><td><strong>14.064 RTP</strong></td><td>Semua Sektor Perikanan</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- TAB 3: IKAN HIAS & BENIH -->
                    <div id="tab-ikan-hias" class="tab-pane">
                        <div class="table-toolbar">
                            <div>
                                <h3 style="margin: 0 0 4px; font-size: 1.1rem; color: #1e293b;">Produksi Ikan Hias &amp; Benih Unggulan Ekspor</h3>
                                <p style="margin: 0; font-size: 0.82rem; color: #64748b;">Kabupaten Bogor sebagai penyuplai utama ikan hias air tawar pasar nasional &amp; internasional.</p>
                            </div>
                            <input type="text" class="table-search-input" id="search-hias" placeholder="🔍 Cari jenis ikan hias..." onkeyup="filterTable('table-hias', this.value)">
                        </div>
                        <div class="modern-table-responsive">
                            <table class="modern-data-table" id="table-hias">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Ikan Hias</th>
                                        <th>Nama Ilmiah</th>
                                        <th class="text-right">Produksi (Ribu Ekor)</th>
                                        <th>Kategori Pasar</th>
                                        <th>Sentra Budidaya</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>1</td><td><strong>Neon Tetra &amp; Cardinal</strong></td><td><em>Paracheirodon innesi</em></td><td class="text-right"><strong>125.400</strong></td><td><span class="badge-tag badge-green">Ekspor Utama (AS, Eropa, Jepang)</span></td><td>Ciseeng, Parung, Gunung Sindur</td></tr>
                                    <tr><td>2</td><td><strong>Cupang Hias (Betta)</strong></td><td><em>Betta splendens</em></td><td class="text-right"><strong>68.200</strong></td><td><span class="badge-tag badge-blue">Ekspor &amp; Domestik</span></td><td>Parung, Bojonggede, Cibinong</td></tr>
                                    <tr><td>3</td><td><strong>Guppy Hias</strong></td><td><em>Poecilia reticulata</em></td><td class="text-right"><strong>42.150</strong></td><td><span class="badge-tag badge-blue">Ekspor &amp; Domestik</span></td><td>Ciseeng, Kemang, Parung</td></tr>
                                    <tr><td>4</td><td><strong>Black Ghost</strong></td><td><em>Apteronotus albifrons</em></td><td class="text-right"><strong>28.900</strong></td><td><span class="badge-tag badge-green">Ekspor Unggulan</span></td><td>Ciseeng, Parung</td></tr>
                                    <tr><td>5</td><td><strong>Manfish (Angelfish)</strong></td><td><em>Pterophyllum scalare</em></td><td class="text-right"><strong>22.350</strong></td><td><span class="badge-tag badge-blue">Ekspor &amp; Domestik</span></td><td>Gunung Sindur, Kemang</td></tr>
                                    <tr><td>6</td><td><strong>Ikan Koi</strong></td><td><em>Cyprinus rubrofuscus</em></td><td class="text-right"><strong>18.400</strong></td><td><span class="badge-tag badge-orange">Domestik &amp; Kontes</span></td><td>Ciawi, Megamendung, Caringin</td></tr>
                                    <tr><td>7</td><td><strong>Ikan Mas Koki</strong></td><td><em>Carassius auratus</em></td><td class="text-right"><strong>14.200</strong></td><td><span class="badge-tag badge-orange">Domestik</span></td><td>Cibinong, Sukaraja, Parung</td></tr>
                                    <tr><td>8</td><td><strong>Corydoras Bronze</strong></td><td><em>Corydoras aeneus</em></td><td class="text-right"><strong>8.650</strong></td><td><span class="badge-tag badge-green">Ekspor Aquascape</span></td><td>Ciseeng, Gunung Sindur</td></tr>
                                    <tr><td>9</td><td><strong>Discus &amp; Louhan</strong></td><td><em>Symphysodon sp.</em></td><td class="text-right"><strong>6.755</strong></td><td><span class="badge-tag badge-purple">Kolektor / Hobi Mahal</span></td><td>Cibinong, Gunung Putri, Bojonggede</td></tr>
                                    <tr style="background:#f1f5f9; font-weight:bold;">
                                        <td>-</td><td><strong>TOTAL PRODUKSI IKAN HIAS</strong></td><td>-</td><td class="text-right"><strong>335.005</strong></td><td><strong>Ribu Ekor (335 Juta Ekor)</strong></td><td>Kabupaten Bogor</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- TAB 4: SITU & TANGKAP -->
                    <div id="tab-situ-tangkap" class="tab-pane">
                        <div class="table-toolbar">
                            <div>
                                <h3 style="margin: 0 0 4px; font-size: 1.1rem; color: #1e293b;">Inventaris Situ &amp; Perikanan Tangkap Daratan</h3>
                                <p style="margin: 0; font-size: 0.82rem; color: #64748b;">Pendataan situ/danau alami dan perairan umum daratan dengan pengawasan POKMASWAS.</p>
                            </div>
                            <input type="text" class="table-search-input" id="search-situ" placeholder="🔍 Cari nama situ / kecamatan..." onkeyup="filterTable('table-situ', this.value)">
                        </div>
                        <div class="modern-table-responsive">
                            <table class="modern-data-table" id="table-situ">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Situ / Danau</th>
                                        <th>Lokasi Desa</th>
                                        <th>Kecamatan</th>
                                        <th class="text-right">Luas (Ha)</th>
                                        <th>Kondisi Perairan</th>
                                        <th>Pemanfaatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>1</td><td><strong>Situ Karadenan / Sela</strong></td><td>Kel. Karadenan</td><td>Cibinong</td><td class="text-right">1,50</td><td><span class="badge-tag badge-green">Baik</span></td><td>Konservasi &amp; Pancing Berjoran</td></tr>
                                    <tr><td>2</td><td><strong>Situ Rawa Jejed</strong></td><td>Desa Kembang Kuning</td><td>Klapanunggal</td><td class="text-right">2,00</td><td><span class="badge-tag badge-green">Baik</span></td><td>Budidaya KJA &amp; Wisata</td></tr>
                                    <tr><td>3</td><td><strong>Situ Telaga Warna</strong></td><td>Desa Tugu Utara</td><td>Cisarua</td><td class="text-right">1,50</td><td><span class="badge-tag badge-green">Baik</span></td><td>Konservasi Alami &amp; Wisata</td></tr>
                                    <tr><td>4</td><td><strong>Situ Ciburial</strong></td><td>Desa Tugu Utara</td><td>Cisarua</td><td class="text-right">0,75</td><td><span class="badge-tag badge-green">Baik</span></td><td>Mata Air &amp; Konservasi</td></tr>
                                    <tr><td>5</td><td><strong>Situ Bantar Kambing</strong></td><td>Desa Bantarjaya</td><td>Rancabungur</td><td class="text-right">2,50</td><td><span class="badge-tag badge-green">Baik</span></td><td>Perikanan Tangkap &amp; Air Baku</td></tr>
                                    <tr><td>6</td><td><strong>Situ Ciminggir</strong></td><td>Desa Pasir Gaok</td><td>Rancabungur</td><td class="text-right">2,50</td><td><span class="badge-tag badge-green">Baik</span></td><td>Perikanan Tangkap Tradisional</td></tr>
                                    <tr><td>7</td><td><strong>Situ Cicau Cigadung</strong></td><td>Desa Kembang Kuning</td><td>Klapanunggal</td><td class="text-right">1,00</td><td><span class="badge-tag badge-orange">Sedang</span></td><td>Perikanan Tangkap &amp; Resapan</td></tr>
                                    <tr><td>8</td><td><strong>Situ Tamansari</strong></td><td>Desa Tamansari</td><td>Tamansari</td><td class="text-right">1,75</td><td><span class="badge-tag badge-green">Baik</span></td><td>Wisata &amp; Budidaya Ikan</td></tr>
                                    <tr><td>9</td><td><strong>Situ Pangadegan</strong></td><td>Desa Neglasari</td><td>Jasinga</td><td class="text-right">2,00</td><td><span class="badge-tag badge-gray">Perlu Revitalisasi</span></td><td>Pengendalian Banjir &amp; Tangkap</td></tr>
                                    <tr style="background:#f1f5f9; font-weight:bold;">
                                        <td>-</td><td><strong>TOTAL SITU TERDATA</strong></td><td>Tersebar di 40 Kecamatan</td><td>Kab. Bogor</td><td class="text-right"><strong>80+ Situ</strong></td><td><strong>980 Nelayan Tangkap</strong></td><td><strong>Produksi: 115,2 Ton/Thn</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- TAB 5: PENGOLAHAN & BBI 
                    <div id="tab-pengolahan-bbi" class="tab-pane">
                        <div class="table-toolbar">
                            <div>
                                <h3 style="margin: 0 0 4px; font-size: 1.1rem; color: #1e293b;">Data Unit Pengolahan Hasil Perikanan (UPI)</h3>
                                <p style="margin: 0; font-size: 0.82rem; color: #64748b;">Rincian 35 unit pengolahan ikan konsumsi &amp; non-konsumsi di Kabupaten Bogor (Sumber: Buku Data Perikanan 2025 Halaman 19).</p>
                            </div>
                            <input type="text" class="table-search-input" id="search-upi" placeholder="🔍 Cari jenis olahan / lokasi / pasar..." onkeyup="filterTable('table-upi', this.value)">
                        </div>
                        <div class="modern-table-responsive">
                            <table class="modern-data-table" id="table-upi">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Bidang / Jenis Produk Olahan</th>
                                        <th>Lokasi Sentra / Fasilitas</th>
                                        <th class="text-right">Produksi / Thn</th>
                                        <th>Tujuan Pemasaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>1</td><td><strong>Pasteurisasi Daging Rajungan, Kepiting Beku, Cephalopoda Beku, Tuna Beku, Ikan Demersal Beku, Daging Rajungan Kering, Udang Beku, Rajungan Beku</strong></td><td>Kawasan Industri Kembang Kuning, Desa Klapanunggal, Kec. Klapanunggal</td><td class="text-right"><strong>3.501,00 Ton</strong></td><td><span class="badge-tag badge-green">USA, Asia, Eropa</span></td></tr>
                                    <tr><td>2</td><td><strong>Daging Rajungan Pasteurisasi, Kepiting Beku</strong></td><td>Kawasan Industri Kembang Kuning, Desa Klapanunggal, Kec. Klapanunggal</td><td class="text-right"><strong>132,00 Ton</strong></td><td><span class="badge-tag badge-green">USA</span></td></tr>
                                    <tr><td>3</td><td><strong>Carrageenan Powder (Tepung Karagenan)</strong></td><td>Harapan Baru Regency, Kab. Bogor</td><td class="text-right"><strong>40,00 Ton</strong></td><td><span class="badge-tag badge-green">USA</span></td></tr>
                                    <tr><td>4</td><td><strong>Cephalopoda Beku, Ikan Pelagis Beku</strong></td><td>Kav. E5 Desa Sentul, Kec. Babakan Madang</td><td class="text-right"><strong>60,00 Ton</strong></td><td><span class="badge-tag badge-green">China</span></td></tr>
                                    <tr><td>5</td><td><strong>Aneka Flavour &amp; Fragrance dari Ikan</strong></td><td>Jl. Alternatif Cibubur-Cileungsi KM 9, Kec. Cileungsi</td><td class="text-right"><strong>400,00 Ton</strong></td><td><span class="badge-tag badge-blue">Lokal &amp; Ekspor</span></td></tr>
                                    <tr><td>6</td><td><strong>Tepung Semi Karagenan</strong></td><td>Desa Tarikolot, Kec. Citeureup</td><td class="text-right"><strong>439,54 Ton</strong></td><td><span class="badge-tag badge-blue">Lokal &amp; Ekspor</span></td></tr>
                                    <tr><td>7</td><td><strong>Tepung Agar-agar</strong></td><td>Kelurahan Karang Asem Timur, Kec. Citeureup</td><td class="text-right"><strong>450,00 Ton</strong></td><td><span class="badge-tag badge-green">Rusia, Eropa, Lokal</span></td></tr>
                                    <tr><td>8</td><td><strong>Gudang Penyimpanan Ikan (Cold Storage)</strong></td><td>Kp. Cibitung Desa Mekarsari, Kec. Cileungsi</td><td class="text-right"><strong>240,00 Ton</strong></td><td><span class="badge-tag badge-orange">Lokal</span></td></tr>
                                    <tr><td>9</td><td><strong>Permen Jelly Gelatin Ikan</strong></td><td>Desa Cicadas, Kec. Gunung Putri</td><td class="text-right"><strong>871,25 Ton</strong></td><td><span class="badge-tag badge-blue">80% Lokal, Ekspor</span></td></tr>
                                    <tr><td>10</td><td><strong>Gudang Penyimpanan Ikan (Cold Storage)</strong></td><td>Kp. Babakan Rawa Haur Sentul, Kec. Babakan Madang</td><td class="text-right"><strong>—</strong></td><td><span class="badge-tag badge-orange">Lokal</span></td></tr>
                                    <tr><td>11</td><td><strong>Olahan Ikan Sidat (Unagi Kabayaki, Unagi Shirayaki)</strong></td><td>Kp. Cipicung satu Desa Cibening, Kec. Pamijahan</td><td class="text-right"><strong>18,00 Ton</strong></td><td><span class="badge-tag badge-orange">Lokal</span></td></tr>
                                    <tr><td>12</td><td><strong>Salmon Beku, Cumi-cumi Beku</strong></td><td>Sentul, Kec. Babakan Madang</td><td class="text-right"><strong>70,00 Ton</strong></td><td><span class="badge-tag badge-blue">Jabodetabek</span></td></tr>
                                    <tr><td>13</td><td><strong>Stik Kepiting Analog Beku (Crabstick)</strong></td><td>Kawasan Propindo Sentul, Kec. Babakan Madang</td><td class="text-right"><strong>2.580,00 Ton</strong></td><td><span class="badge-tag badge-green">Ekspor US, Meksiko, China, HK</span></td></tr>
                                    <tr><td>14</td><td><strong>Kerupuk Udang (Original, Spicy, Seaweed)</strong></td><td>Jl. Raya Sentul KM 2,7 Sentul, Kec. Babakan Madang</td><td class="text-right"><strong>372,00 Ton</strong></td><td><span class="badge-tag badge-green">Ekspor China, Taiwan, HK &amp; Lokal</span></td></tr>
                                    <tr><td>15</td><td><strong>Sotong Beku</strong></td><td>Jl. Gang Telkom, Kec. Caringin</td><td class="text-right"><strong>200,00 Ton</strong></td><td><span class="badge-tag badge-green">Jepang</span></td></tr>
                                    <tr><td>16</td><td><strong>Ikan Pelagis &amp; Demersal Beku, Sea Squirt, Oyster Beku, Nori</strong></td><td>Desa Puspasari, Kec. Citeureup</td><td class="text-right"><strong>148,60 Ton</strong></td><td><span class="badge-tag badge-green">Jepang, Korea, Thailand</span></td></tr>
                                    <tr><td>17</td><td><strong>Surimi Beku</strong></td><td>Kembang Kuning, Kec. Klapanunggal</td><td class="text-right"><strong>20,00 Ton</strong></td><td><span class="badge-tag badge-green">Jepang, Korea, Thailand</span></td></tr>
                                    <tr><td>18</td><td><strong>Ikan Pelagis Bernilai Tambah Beku</strong></td><td>Desa Waru, Kec. Parung</td><td class="text-right"><strong>20,00 Ton</strong></td><td><span class="badge-tag badge-orange">Dalam Negeri</span></td></tr>
                                    <tr><td>19</td><td><strong>Ikan Pelagis Bernilai Tambah Beku</strong></td><td>Kalisuren, Kec. Tajurhalang</td><td class="text-right"><strong>40,00 Ton</strong></td><td><span class="badge-tag badge-blue">Jabodetabek</span></td></tr>
                                    <tr><td>20</td><td><strong>Ikan Marinasi Frozen (Gurame, Lele, Nila)</strong></td><td>Desa Ciomas, Kec. Ciomas</td><td class="text-right"><strong>4,80 Ton</strong></td><td><span class="badge-tag badge-blue">Jabodetabek</span></td></tr>
                                    <tr><td>21</td><td><strong>Fillet Salmon</strong></td><td>Kp. Legok Banteng, Kec. Babakan Madang</td><td class="text-right"><strong>144,00 Ton</strong></td><td><span class="badge-tag badge-blue">Jabodetabek</span></td></tr>
                                    <tr><td>22</td><td><strong>Mangut Lele &amp; Olahan Lele</strong></td><td>Desa Cibanteng / Ciampea, Kab. Bogor</td><td class="text-right"><strong>24,00 Ton</strong></td><td><span class="badge-tag badge-blue">Jabodetabek</span></td></tr>
                                    <tr><td>23</td><td><strong>Ikan Lele Beku, Bandeng Presto, Pempek Ikan, Ikan Asin, Lobster Beku</strong></td><td>Desa Cibinong, Kec. Gunung Sindur</td><td class="text-right"><strong>3.200,00 Ton</strong></td><td><span class="badge-tag badge-blue">Jabodetabek</span></td></tr>
                                    <tr><td>24</td><td><strong>Otak-otak Ikan</strong></td><td>Kel. Bitungsari, Kec. Ciawi</td><td class="text-right"><strong>1.800,00 Ton</strong></td><td><span class="badge-tag badge-blue">Jabodetabek</span></td></tr>
                                    <tr><td>25</td><td><strong>Daging Rajungan Pasteurisasi</strong></td><td>Kembang Kuning, Kec. Klapanunggal</td><td class="text-right"><strong>800,00 Ton</strong></td><td><span class="badge-tag badge-blue">Jabodetabek</span></td></tr>
                                    <tr><td>26</td><td><strong>Cumi-cumi Beku</strong></td><td>Citaringgul, Kec. Babakan Madang</td><td class="text-right"><strong>60,00 Ton</strong></td><td><span class="badge-tag badge-blue">Jabodetabek</span></td></tr>
                                    <tr><td>27</td><td><strong>Pindang Ikan, Bandeng Presto, Ikan Asap</strong></td><td>Kalisuren, Kec. Tajurhalang</td><td class="text-right"><strong>108,00 Ton</strong></td><td><span class="badge-tag badge-blue">Jabodetabek</span></td></tr>
                                    <tr><td>28</td><td><strong>Produk Perikanan Bernilai Tambah Beku</strong></td><td>Kel. Pasirlaja, Kec. Sukaraja</td><td class="text-right"><strong>30,00 Ton</strong></td><td><span class="badge-tag badge-blue">Jabodetabek</span></td></tr>
                                    <tr><td>29</td><td><strong>Cephalopoda Beku, Salmon Beku</strong></td><td>Mekarsari, Kec. Cileungsi</td><td class="text-right"><strong>100,00 Ton</strong></td><td><span class="badge-tag badge-blue">Jabodetabek</span></td></tr>
                                    <tr><td>30</td><td><strong>Minyak Ikan</strong></td><td>Jl. Alternatif Cibubur - Cileungsi KM 9, Kec. Cileungsi</td><td class="text-right"><strong>20,00 Ton</strong></td><td><span class="badge-tag badge-blue">Jabodetabek</span></td></tr>
                                    <tr><td>31</td><td><strong>Keripik Kulit Ikan</strong></td><td>Desa Sukawening, Kec. Dramaga</td><td class="text-right"><strong>60,00 Ton</strong></td><td><span class="badge-tag badge-blue">Jabodetabek</span></td></tr>
                                    <tr><td>32</td><td><strong>Minyak Ikan</strong></td><td>Jl. Agatis, Kec. Dramaga</td><td class="text-right"><strong>1,00 Ton</strong></td><td><span class="badge-tag badge-blue">Jabodetabek</span></td></tr>
                                    <tr><td>33</td><td><strong>Tepung Karagenan</strong></td><td>Tlajung Udik, Kec. Gunung Putri</td><td class="text-right"><strong>100,00 Ton</strong></td><td><span class="badge-tag badge-blue">Jabodetabek</span></td></tr>
                                    <tr><td>34</td><td><strong>Fillet Ikan Nila</strong></td><td>Desa Cogreg, Kec. Parung</td><td class="text-right"><strong>24,00 Ton</strong></td><td><span class="badge-tag badge-blue">Jabodetabek</span></td></tr>
                                    <tr><td>35</td><td><strong>Kosmetik Rumput Laut (Non-Konsumsi)</strong></td><td>Kel. Teluk Pinang, Kec. Ciawi</td><td class="text-right"><strong>55,00 Ton</strong></td><td><span class="badge-tag badge-purple">Lokal (Non-Konsumsi)</span></td></tr>
                                    <tr style="background:#f1f5f9; font-weight:bold;">
                                        <td>-</td><td><strong>TOTAL 35 UNIT PENGOLAHAN (UPI)</strong></td><td>Olahan Konsumsi &amp; Non-Konsumsi</td><td class="text-right"><strong>16.098,19 Ton</strong></td><td><span class="badge-tag badge-green">3.115 Tenaga Kerja</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div style="margin-top: 20px; text-align: center;">
                            <a href="{{ route('front.bukudata.perikanan') }}" target="_blank" class="btn btn-blue" style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                                <span>📖</span> Buka Flipbook 3D Buku Data Perikanan 2025 Lengkap
                            </a>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>
        <!-- END SECTION BUKU DATA PERIKANAN 2025 
        <section class="section section-soft-blue" id="layanan-perikanan">
            <div class="container">
                <div class="section-title-row">
                    <h2 class="section-title"><span class="leaf-mark">❧</span>Ruang Informasi Perikanan</h2>
                </div>
                <div class="category-grid">
                    <article class="category-card service-category-card production">
                        <div aria-hidden="true" class="service-visual"><span class="service-visual-main">≋</span><span
                                class="service-visual-badge">🐟</span></div>
                        <div class="category-heading"><span class="big-icon">◔</span>
                            <div>
                                <h2>Budidaya Perikanan</h2>
                                <p>Informasi budidaya, pakan ikan, kolam, teknologi, dan manajemen.</p>
                            </div>
                        </div>
                        <div class="category-items">
                            <div class="category-item"><span>≋</span>Budidaya</div>
                            <div class="category-item"><span>◔</span>Pakan Ikan</div>
                            <div class="category-item"><span>▣</span>Kolam</div>
                        </div>
                        <a class="btn btn-blue category-button" href="#statistik-perikanan">Buka Statistik Perikanan</a>
                    </article>
                    <article class="category-card service-category-card population">
                        <div aria-hidden="true" class="service-visual"><span class="service-visual-main">⚓</span><span
                                class="service-visual-badge">♜</span></div>
                        <div class="category-heading"><span class="big-icon">⚓</span>
                            <div>
                                <h2>Perikanan Tangkap</h2>
                                <p>Informasi tangkap, alat tangkap, pasar ikan, teknologi, dan manajemen.</p>
                            </div>
                        </div>
                        <div class="category-items">
                            <div class="category-item"><span>⚓</span>Tangkap</div>
                            <div class="category-item"><span>♜</span>Alat Tangkap</div>
                            <div class="category-item"><span>♙</span>Pasar Ikan</div>
                        </div>
                        <a class="btn btn-green category-button" href="{{ route('front.umkm-info') }}">Lihat Produk →</a>
                    </article>
                </div>
            </div>
        </section> -->
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
    <script src="https://unpkg.com/esri-leaflet@3.0.12/dist/esri-leaflet.js"></script>
    <script src="{{ asset('assets-front-new/js/sector-data.js') }}"></script>

    <script>
        // Tab switching logic
        function switchPerikananTab(tabId, btn) {
            document.querySelectorAll('#data-perikanan-2025 .tab-pane').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('#data-perikanan-2025 .data-tab-button').forEach(el => el.classList.remove('active'));
            
            const target = document.getElementById(tabId);
            if (target) target.classList.add('active');

            const targetBtn = document.querySelector(`.data-tabs-nav button[onclick*="${tabId}"]`);
            if (targetBtn) {
                targetBtn.classList.add('active');
            } else if (btn) {
                btn.classList.add('active');
            }
        }

        // Table search/filter logic
        function filterTable(tableId, query) {
            const table = document.getElementById(tableId);
            if (!table) return;
            const q = (query || '').toLowerCase().trim();
            const rows = table.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(q) ? '' : 'none';
            });
        }

        // Multi-filter for Tabel Produksi Ikan Konsumsi
        function filterIkanKonsumsi() {
            const searchVal = (document.getElementById('search-ikan-konsumsi')?.value || '').toLowerCase().trim();
            const komoditasVal = (document.getElementById('filter-komoditas-ikan')?.value || '').toLowerCase().trim();
            const kecamatanVal = (document.getElementById('filter-kecamatan-ikan')?.value || '').toLowerCase().trim();
            
            const table = document.getElementById('table-ikan-konsumsi');
            if (!table) return;
            const rows = table.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                if (row.cells[0]?.textContent.trim() === '-') return;
                if (row.cells.length < 7) return;
                
                const komoditasText = row.cells[1]?.textContent.toLowerCase() || '';
                const ilmiahText = row.cells[2]?.textContent.toLowerCase() || '';
                const metodeText = row.cells[5]?.textContent.toLowerCase() || '';
                const sentraText = row.cells[6]?.textContent.toLowerCase() || '';
                const allRowText = row.textContent.toLowerCase();
                
                const matchSearch = !searchVal || allRowText.includes(searchVal);
                const matchKomoditas = !komoditasVal || komoditasText.includes(komoditasVal) || ilmiahText.includes(komoditasVal);
                const matchKecamatan = !kecamatanVal || sentraText.includes(kecamatanVal) || sentraText.includes('tersebar') || sentraText.includes('kabupaten bogor');
                
                if (matchSearch && matchKomoditas && matchKecamatan) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Initialize Highcharts for Buku Data Perikanan 2025
        document.addEventListener('DOMContentLoaded', function() {
            // Check hash in URL to activate specific tab automatically
            const hash = window.location.hash;
            if (hash) {
                const targetPane = document.querySelector(hash);
                if (targetPane && targetPane.classList.contains('tab-pane')) {
                    const tabId = hash.replace('#', '');
                    switchPerikananTab(tabId);
                    setTimeout(() => {
                        document.getElementById('data-perikanan-2025')?.scrollIntoView({ behavior: 'smooth' });
                    }, 150);
                }
            }

            if (typeof Highcharts !== 'undefined') {
                // Chart Tren Produksi Ikan Konsumsi 2021-2025
                Highcharts.chart('perikanan-chart-tren', {
                    chart: { type: 'areaspline', backgroundColor: 'transparent' },
                    title: { text: null },
                    credits: { enabled: false },
                    xAxis: {
                        categories: ['2021', '2022', '2023', '2024', '2025'],
                        crosshair: true
                    },
                    yAxis: {
                        min: 120000,
                        title: { text: 'Produksi Ikan Konsumsi (Ton)' }
                    },
                    tooltip: {
                        shared: true,
                        valueSuffix: ' Ton'
                    },
                    plotOptions: {
                        areaspline: {
                            fillOpacity: 0.2,
                            borderWidth: 3
                        }
                    },
                    series: [{
                        name: 'Target Produksi',
                        data: [127710, 129625, 131570, 133543, 135546],
                        color: '#94a3b8',
                        dashStyle: 'ShortDash'
                    }, {
                        name: 'Realisasi Produksi',
                        data: [127710, 129625, 131570, 133543, 136210],
                        color: '#0878bd'
                    }]
                });

                // Chart Komposisi Komoditas Ikan Konsumsi
                Highcharts.chart('perikanan-chart-komoditas', {
                    chart: { type: 'pie', backgroundColor: 'transparent' },
                    title: { text: null },
                    credits: { enabled: false },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b> ({point.y:,.0f} Ton)'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                            }
                        }
                    },
                    series: [{
                        name: 'Volume Produksi',
                        colorByPoint: true,
                        data: [{
                            name: 'Ikan Lele',
                            y: 87350,
                            sliced: true,
                            selected: true,
                            color: '#0284c7'
                        }, {
                            name: 'Ikan Nila',
                            y: 22180,
                            color: '#0ea5e9'
                        }, {
                            name: 'Ikan Gurame',
                            y: 11450,
                            color: '#059669'
                        }, {
                            name: 'Ikan Mas',
                            y: 8320,
                            color: '#f59e0b'
                        }, {
                            name: 'Ikan Patin',
                            y: 4120,
                            color: '#8b5cf6'
                        }, {
                            name: 'Ikan Bawal & Lainnya',
                            y: 2790,
                            color: '#64748b'
                        }]
                    }]
                });
            }
        });
    </script>
</body>

</html>