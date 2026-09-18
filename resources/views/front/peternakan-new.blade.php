<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Informasi peternakan, produksi, populasi, dan layanan kesehatan hewan." name="description" />
    <title>SPARTAN — Peternakan</title>
    <link href="{{ asset('assets/vendor/libs/leaflet/leaflet.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendor/libs/select2/select2.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/leaflet/leaflet.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/highcharts/highcharts.js') }}"></script>
    <link href="{{ asset('assets-front-new/css/styles.css?v=14') }}" rel="stylesheet" />
</head>

<body class="page-livestock" data-page="livestock" data-sector="peternakan">
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
        <section class="page-hero livestock">
            <video class="hero-video" autoplay loop muted playsinline>
                <source src="{{ asset('assets-front-new/images/') }}/peternakan.webm" type="video/webm">
            </video>
            <div class="container page-hero-inner">
                <div class="breadcrumbs"><a href="{{ route('front.home.index') }}">Beranda</a><span>›</span><span>Peternakan</span></div>
                <span class="page-kicker">Sektor SPARTAN</span>
                <h1>Peternakan</h1>
                <p>Halaman khusus informasi produksi, populasi, layanan kesehatan hewan, produk, dan edukasi peternakan
                    Kabupaten Bogor.</p>
                <div class="page-hero-actions">
                    <a class="btn btn-green" href="#produksi-populasi-section">Lihat layanan</a>
                    <a class="btn btn-ghost" href="#statistik-peternakan">Buka statistik peternakan</a>
                </div>
            </div>

        </section>
        <!----
        <section class="section sector-intro">
            <div class="container category-grid single-category-grid">
                <article class="category-card farm" id="ringkasan-peternakan">
                    <div class="category-heading">
                        <div>
                            <h2>Data Sektoral SPARTAN</h2>
                           
                        </div>
                    </div>
                    <div class="category-items">
                        <div class="category-item"><span>🐄</span>Sapi</div>
                        <div class="category-item"><span>🐐</span>Kambing</div>
                        <div class="category-item"><span>🐔</span>Ayam</div>
                        <div class="category-item"><span>🦆</span>Itik</div>
                        <div class="category-item"><span>🧺</span>Pakan</div>
                        <div class="category-item"><span>✚</span>Kesehatan</div>
                        <div class="category-item"><span>⌂</span>Kandang</div>
                        <div class="category-item"><span>⚙</span>Manajemen</div>
                    </div>
                    <a class="btn btn-green category-button" href="#statistik-peternakan">Lihat Data &amp; Statistik
                        →</a>
                </article>
            </div>
        </section> -->
        <section aria-labelledby="judul-statistik-peternakan" class="sector-statistics" id="statistik-peternakan">
            <div class="sector-data-banner">
                <div class="container category-grid single-category-grid">
                    <article class="category-card farm" id="ringkasan-peternakan">
                        <div class="category-heading">
                            <div>
                                <h2>Data Sektoral SPARTAN</h2>
                               
                            </div>
                        </div>
                        <style>
                            #ringkasan-peternakan.category-card {
                                padding: 24px;
                            }
                            #ringkasan-peternakan .farm-category-grid {
                                grid-template-columns: 1fr;
                                max-width: 240px;
                                gap: 8px;
                                margin: 14px 0;
                            }
                            #ringkasan-peternakan .farm-category-grid .portal-card {
                                min-height: auto;
                                padding: 8px 12px;
                                display: flex;
                                flex-direction: row;
                                align-items: center;
                                gap: 10px;
                                border-radius: 10px;
                            }
                            #ringkasan-peternakan .farm-category-grid .portal-card h2 {
                                color: #1e293b !important;
                                font-size: 0.9rem;
                                margin: 0;
                                font-weight: 700;
                            }
                            #ringkasan-peternakan .farm-category-grid .portal-icon {
                                width: 28px;
                                height: 28px;
                                font-size: 16px;
                                margin-bottom: 0;
                                flex-shrink: 0;
                            }
                            @media (max-width: 640px) {
                                #ringkasan-peternakan.category-card {
                                    min-height: auto !important;
                                    padding: 150px 16px 16px 16px !important;
                                }
                                #ringkasan-peternakan.category-card::before {
                                    display: block !important;
                                    inset: 0 0 auto 0 !important;
                                    width: 100% !important;
                                    height: 140px !important;
                                    background-size: cover !important;
                                    background-position: center 40% !important;
                                }
                                #ringkasan-peternakan.category-card::after {
                                    display: block !important;
                                    inset: 0 0 auto 0 !important;
                                    width: 100% !important;
                                    height: 140px !important;
                                    background: linear-gradient(180deg, rgba(0,0,0,0) 45%, rgba(242, 251, 244, 0.9) 95%, #f2fbf4 100%) !important;
                                }
                                #ringkasan-peternakan .farm-category-grid {
                                    max-width: 100%;
                                    grid-template-columns: repeat(2, 1fr);
                                    gap: 8px;
                                    margin: 12px 0;
                                }
                                #ringkasan-peternakan .category-button {
                                    position: static;
                                    width: 100%;
                                    margin-top: 10px;
                                }
                            }
                            @media (max-width: 480px) {
                                #ringkasan-peternakan .farm-category-grid .portal-card {
                                    padding: 6px 8px !important;
                                    gap: 6px !important;
                                }
                                #ringkasan-peternakan .farm-category-grid .portal-card h2 {
                                    font-size: 0.8rem !important;
                                }
                                #ringkasan-peternakan .farm-category-grid .portal-icon {
                                    width: 24px !important;
                                    height: 24px !important;
                                    font-size: 14px !important;
                                }
                            }
                        </style>
                        <div class="portal-grid umkm-category-grid farm-category-grid">
                            <a class="portal-card green" href="#data-peternakan-2025" onclick="switchPeternakanTab('tab-populasi')">
                                <span class="portal-icon">🐄</span>
                                <h2>Populasi Ternak</h2>
                            </a>
                            <a class="portal-card orange" href="#data-peternakan-2025" onclick="switchPeternakanTab('tab-produksi')">
                                <span class="portal-icon">🥛</span>
                                <h2>Produksi Ternak</h2>
                            </a>
                            <a class="portal-card purple" href="#data-peternakan-2025" onclick="switchPeternakanTab('tab-sarana')">
                                <span class="portal-icon">🏬</span>
                                <h2>RPH &amp; RPHU</h2>
                            </a>
                            <a class="portal-card blue" href="#data-peternakan-2025" onclick="switchPeternakanTab('tab-nkv')">
                                <span class="portal-icon">🛡️</span>
                                <h2>Sertifikasi NKV</h2>
                            </a>
                        </div>
                        <a class="btn btn-green category-button" href="#data-peternakan-2025">Lihat Data &amp; Statistik
                            →</a>
                    </article>
                </div>

            </div>
            <div class="mini-data-strip sector-mini-data-strip">
                <div class="stats-strip" style="display: flex; justify-content: center; align-items: center;">
                    <a href="{{ route('front.bukudata.peternakan') }}" target="_blank" class="stat-item" style="text-decoration: none; cursor: pointer; transition: transform 0.2s; border: none; flex-direction: column; gap: 8px; width: 100%;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">

                        <div style="text-align: center;">
                            <b style="color: white; font-size: 1.25rem;">Buku Data Peternakan 2025</b>
                            <small style="color: rgba(255, 255, 255, 0.9); font-size: 0.85rem; margin-top: 4px;">Klik untuk melihat Laporan SPARTAN</small>
                        </div>
                    </a>
                </div>
            </div>
            <section class="section categories category-data-section sector-map-section" id="peta-peternakan">
                <div class="container category-grid single-category-grid">
                    <article class="category-card data-category-card map-category-card">
                        <div aria-hidden="true" class="data-card-illustration">🗺️</div>
                        <div class="category-heading"><span class="big-icon">⌖</span>
                            <div>
                                <h2>Peta Sebaran Peternakan</h2>
                                <p>Peta interaktif data peternakan per kecamatan hingga desa atau kelurahan di Kabupaten
                                    Bogor.</p>
                            </div>
                        </div>

                        <div class="category-control-row">
                            <div class="category-select-control"><label for="kecamatan-select">Pilih
                                    Kecamatan</label><select class="select2-kecamatan" id="kecamatan-select">
                                    <option value="">Semua Kecamatan</option>
                                </select></div>
                            <div aria-label="Keterangan peta" class="category-map-legend"><span><i
                                        class="legend-dot livestock"></i>Peternakan</span></div>
                        </div>
                        <div style="position: relative;">
                            <div aria-label="Peta sebaran peternakan Kabupaten Bogor" class="category-map-panel"
                                id="spartan-map"></div>

                        </div>
                        <span class="btn btn-green category-button data-category-button">Data Peternakan Aktif</span>
                    </article>
                </div>
            </section>
            <section class="section categories category-data-section price-category-section" id="harga-peternakan">
                <div class="container">
                    <!--
                    <div class="category-grid single-category-grid">
                        <article class="category-card data-category-card stats-category-card">
                            <div aria-hidden="true" class="data-card-illustration">📊</div>
                            <div class="category-heading"><span class="big-icon">📊</span>
                                <div>
                                    <h2>Statistik Harga Komoditas Peternakan</h2>
                                    <p>Ringkasan harga terendah, tertinggi, rata-rata, dan perubahan harga khusus
                                        komoditas peternakan.</p>
                                </div>
                            </div>
                            <div class="category-items data-category-items stats-category-items">
                                <div class="category-item"><span>▾</span>Terendah</div>
                                <div class="category-item"><span>▴</span>Tertinggi</div>
                                <div class="category-item"><span>≈</span>Rata-Rata</div>
                                <div class="category-item"><span>↗</span>Perbandingan</div>
                            </div>
                            <span class="btn btn-green category-button data-category-button">Data Harga
                                Peternakan</span>
                        </article>
                    </div>
                    
                    <div class="price-category-grid" id="price-cards-container">
                        <article class="category-card price-category-card price-lowest-card">
                            <div aria-hidden="true" class="data-card-illustration">↓</div>
                            <div class="category-heading"><span class="big-icon">▾</span>
                                <div>
                                    <h2>Harga Terendah</h2>
                                    <p>Harga akhir terendah komoditas peternakan</p>
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
                                    <p>Harga akhir tertinggi komoditas peternakan</p>
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
                                    <p>Rata-rata harga komoditas peternakan</p>
                                </div>
                            </div>
                            <div class="price-category-value"><span>Harga terkini</span>
                                <h3 id="card-avg-val">Rp —</h3>
                            </div>
                            <div class="category-items price-category-items">
                                <div class="category-item"><span>🐄</span><strong id="card-avg-name">Memuat
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
                                    <h2>Grafik Perbandingan Harga Peternakan</h2>
                                    <p>Perbandingan harga awal dan harga akhir komoditas peternakan.</p>
                                </div>
                            </div>
                            <div class="category-items data-category-items chart-category-items">
                                <div class="category-item"><span>◔</span>Harga Awal</div>
                                <div class="category-item"><span>●</span>Harga Akhir</div>
                                <div class="category-item"><span>10</span>Komoditas</div>
                                <div class="category-item"><span>↻</span>Data API</div>
                            </div>
                            <div class="category-chart-panel" id="price-chart-container"></div><span
                                class="btn btn-green category-button data-category-button">Perbandingan Harga</span>
                        </article>
                    </div>
                    <!--
                    <div class="category-grid single-category-grid category-data-gap">
                        <article class="category-card data-category-card table-category-card">
                            <div aria-hidden="true" class="data-card-illustration">▦</div>
                            <div class="category-heading"><span class="big-icon">▦</span>
                                <div>
                                    <h2>Daftar Perkembangan Harga Peternakan</h2>
                                    <p>Daftar harga difokuskan hanya pada komoditas sektor peternakan.</p>
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
                                            <td class="table-empty-state" colspan="6">Memuat data harga peternakan...
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div><span class="btn btn-green category-button data-category-button"
                                id="commodity-sector-status">Komoditas Peternakan</span>
                        </article>
                    </div>
                    -->
                </div>
            </section>
            <section class="section categories district-distribution-section single-sector-distribution"
                id="distribusi-peternakan">
                <div class="container category-grid single-category-grid">
                    <article class="category-card data-category-card distribution-category-card">
                        <div aria-hidden="true" class="data-card-illustration">📍</div>
                        <div class="category-heading"><span class="big-icon">⌖</span>
                            <div>
                                <h2>Distribusi Peternakan Per Kecamatan</h2>
                                <p>Visualisasi jumlah data peternakan berdasarkan wilayah kecamatan di Kabupaten Bogor.
                                </p>
                            </div>
                        </div>
                        <div class="distribution-summary-grid single-sector-summary-grid">
                            <article class="distribution-summary-card livestock"><span
                                    class="distribution-summary-icon">🐄</span>
                                <div><small>Total Peternakan</small><strong id="distribution-total-sector">—</strong>
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
                            <article class="district-chart-card livestock-chart-card">
                                <header class="district-chart-header">
                                    <div class="district-chart-title-wrap"><span aria-hidden="true"
                                            class="district-chart-icon">🐄</span>
                                        <div>
                                            <h3>Total Peternakan Per Kecamatan</h3>
                                            <p>Distribusi data peternakan</p>
                                        </div>
                                    </div><span class="distribution-live-badge"><i></i> Data API</span>
                                </header>
                                <div class="district-chart-body">
                                    <div aria-label="Diagram donat total peternakan per kecamatan"
                                        id="district-sector-chart" role="img"></div>
                                </div>
                            </article>
                        </div>
                        <span class="btn btn-green category-button data-category-button"
                            id="distribution-data-status">Memuat Distribusi</span>
                    </article>
                </div>
            </section>
        </section>

        <!-- SECTION BUKU DATA PETERNAKAN 2025 ANALYTICS & TABEL -->
        <section class="section bukudata-analytics-section" id="data-peternakan-2025">
            <div class="container">
                <div class="bukudata-header-card">
                    <span class="bukudata-badge">📚 Sumber Resmi: Buku Data Peternakan 2025</span>
                    <h2 style="margin: 0 0 8px; font-size: 1.45rem; font-weight: 800; color: #1e293b;">
                        Data Sektoral &amp; Indikator Kinerja Peternakan Kabupaten Bogor
                    </h2>
                    <p style="margin: 0; font-size: 0.9rem; color: #64748b; max-width: 900px;">
                        Penyajian komprehensif data populasi ternak, produksi daging, telur, susu, zona kawasan pengembangan, serta sarana dan prasarana peternakan berdasarkan publikasi resmi Dinas Perikanan dan Peternakan Kabupaten Bogor Tahun 2025.
                    </p>

                </div>

                <!-- 4 ZONA PENGEMBANGAN PETERNAKAN -->
                <div class="section-title-row" style="margin-top: 10px;">
                    <h2 class="section-title"><span class="leaf-mark">🗺️</span>Zona Wilayah Pengembangan Peternakan</h2>
                </div>
                <div class="zone-grid">
                    <div class="zone-card">
                        <h4><span>⛰️</span> Zona 1 — Bogor Barat</h4>
                        <p>Wilayah berbukit dan dataran dengan potensi hijauan pakan alami yang melimpah.</p>
                        <p style="font-size: 0.8rem; color: #059669; font-weight: 700; margin-bottom: 6px;">Kecamatan:</p>
                        <div class="zone-tags" style="margin-bottom: 10px;">
                            <span class="zone-tag">Rumpin</span><span class="zone-tag">Cigudeg</span><span class="zone-tag">Parungpanjang</span>
                            <span class="zone-tag">Jasinga</span><span class="zone-tag">Tenjo</span><span class="zone-tag">Sukajaya</span>
                        </div>
                        <p style="font-size: 0.8rem; color: #475569;"><strong>Komoditas Unggulan:</strong> Kerbau, Domba, Kambing, Ayam Buras, Sapi Potong.</p>
                    </div>
                    <div class="zone-card">
                        <h4><span>🌾</span> Zona 2 — Bogor Tengah &amp; Timur</h4>
                        <p>Sentra peternakan rakyat dan skala industri terintegrasi dengan Pasar Hewan Jonggol.</p>
                        <p style="font-size: 0.8rem; color: #059669; font-weight: 700; margin-bottom: 6px;">Kecamatan:</p>
                        <div class="zone-tags" style="margin-bottom: 10px;">
                            <span class="zone-tag">Jonggol</span><span class="zone-tag">Cariu</span><span class="zone-tag">Tanjungsari</span>
                            <span class="zone-tag">Sukamakmur</span><span class="zone-tag">Cileungsi</span><span class="zone-tag">Klapanunggal</span>
                        </div>
                        <p style="font-size: 0.8rem; color: #475569;"><strong>Komoditas Unggulan:</strong> Sapi Potong, Domba, Kambing, Ayam Ras Pedaging &amp; Petelur.</p>
                    </div>
                    <div class="zone-card">
                        <h4><span>🌲</span> Zona 3 — Bogor Selatan (Puncak)</h4>
                        <p>Kawasan dataran tinggi berhawa sejuk sangat ideal untuk produksi susu dan ternak perah.</p>
                        <p style="font-size: 0.8rem; color: #059669; font-weight: 700; margin-bottom: 6px;">Kecamatan:</p>
                        <div class="zone-tags" style="margin-bottom: 10px;">
                            <span class="zone-tag">Cisarua</span><span class="zone-tag">Megamendung</span><span class="zone-tag">Ciawi</span>
                            <span class="zone-tag">Caringin</span><span class="zone-tag">Cigombong</span>
                        </div>
                        <p style="font-size: 0.8rem; color: #475569;"><strong>Komoditas Unggulan:</strong> Sapi Perah, Kambing Perah, Kelinci, Ternak Hias.</p>
                    </div>
                    <div class="zone-card">
                        <h4><span>🏙️</span> Zona 4 — Bogor Utara &amp; Urban</h4>
                        <p>Kawasan aglomerasi perkotaan sebagai sentra aneka ternak dan hilirisasi pengolahan.</p>
                        <p style="font-size: 0.8rem; color: #059669; font-weight: 700; margin-bottom: 6px;">Kecamatan:</p>
                        <div class="zone-tags" style="margin-bottom: 10px;">
                            <span class="zone-tag">Cibinong</span><span class="zone-tag">Bojonggede</span><span class="zone-tag">Sukaraja</span>
                            <span class="zone-tag">Babakan Madang</span><span class="zone-tag">Kemang</span><span class="zone-tag">Parung</span>
                        </div>
                        <p style="font-size: 0.8rem; color: #475569;"><strong>Komoditas Unggulan:</strong> Aneka Ternak, Unggas, RPH, &amp; Industri Pengolahan Daging/Susu.</p>
                    </div>
                </div>

                <!-- CHARTS ROW -->
                <div class="bukudata-charts-grid">
                    <div class="bukudata-chart-card">
                        <h3>📈 Perkembangan Populasi Ternak</h3>
                        <p>Perbandingan populasi ternak besar, kecil, unggas, dan aneka ternak.</p>
                        <div id="peternakan-chart-populasi" class="bukudata-chart-panel"></div>
                    </div>
                    <div class="bukudata-chart-card">
                        <h3>🥩 Komposisi Produksi Hasil Ternak</h3>
                        <p>Total realisasi produksi komoditas daging, telur konsumsi, dan susu sapi.</p>
                        <div id="peternakan-chart-produksi" class="bukudata-chart-panel"></div>
                    </div>
                </div>

                <!-- DATA TABS CONTAINER -->
                <div class="data-tabs-container">
                    <div class="data-tabs-nav">
                        <button type="button" class="data-tab-button active" onclick="switchPeternakanTab('tab-populasi', this)">
                            <span class="stat-icon">🐄</span>
                            <span class="stat-label">Populasi Ternak Lengkap</span>
                            <span class="stat-val">30.052 <small style="font-size: 0.9rem; font-weight: normal;">ekor</small></span>
                            <span class="stat-sub">Sapi Potong (21.168), Sapi Perah (6.099), Kerbau (2.320), Kuda (465)</span>
                        </button>
                        <button type="button" class="data-tab-button" onclick="switchPeternakanTab('tab-produksi', this)">
                            <span class="stat-icon">🥛</span>
                            <span class="stat-label">Produksi Daging, Telur &amp; Susu</span>
                            <span class="stat-val">223.111 <small style="font-size: 0.9rem; font-weight: normal;">Ton</small></span>
                            <span class="stat-sub">Daging: 223.111 Ton | Telur: 112.630 Ton | Susu: 14,77 Jt Liter</span>
                        </button>
                        <button type="button" class="data-tab-button" onclick="switchPeternakanTab('tab-sarana', this)">
                            <span class="stat-icon">🏬</span>
                            <span class="stat-label">Sarana, RPH &amp; Pasar Hewan</span>
                            <span class="stat-val">11 <small style="font-size: 0.9rem; font-weight: normal;">Unit RPH</small></span>
                            <span class="stat-sub">RPH-R, RPH-U, Pasar Hewan Jonggol &amp; 8 Poskeswan UPT</span>
                        </button>
                        <button type="button" class="data-tab-button" onclick="switchPeternakanTab('tab-nkv', this)">
                            <span class="stat-icon">🛡️</span>
                            <span class="stat-label">Unit Bersertifikat NKV</span>
                            <span class="stat-val">44 <small style="font-size: 0.9rem; font-weight: normal;">Unit Usaha</small></span>
                            <span class="stat-sub">Jaminan Keamanan &amp; Higiene Sanitasi Produk Hewan Terverifikasi</span>
                        </button>
                        <button type="button" class="data-tab-button" onclick="switchPeternakanTab('tab-faq', this)">
                            <span class="stat-icon">❓</span>
                            <span class="stat-label">FAQ &amp; Panduan</span>
                            <span class="stat-val">—</span>
                            <span class="stat-sub">Tata Cara Mengetahui Fitur Aplikasi</span>
                        </button>
                    </div>

                    <!-- TAB 1: POPULASI -->
                    <div id="tab-populasi" class="tab-pane active">
                        <div class="table-toolbar">
                            <div>
                                <h3 style="margin: 0 0 4px; font-size: 1.1rem; color: #1e293b;">Data Perkembangan Populasi Ternak Kabupaten Bogor</h3>
                                <p style="margin: 0; font-size: 0.82rem; color: #64748b;">Rincian 21 jenis ternak besar, kecil, unggas, dan aneka ternak.</p>
                            </div>
                            <div class="table-filter-group">
                                <input type="text" class="table-search-input" id="search-populasi" placeholder="🔍 Cari jenis ternak..." onkeyup="filterPopulasi()">
                                <select class="table-select-filter" id="filter-kategori-populasi" onchange="filterPopulasi()">
                                    <option value="">Semua Jenis / Kategori</option>
                                    <option value="Ternak Besar">Ternak Besar (Sapi, Kerbau, Kuda)</option>
                                    <option value="Ternak Kecil">Ternak Kecil (Domba, Kambing, Babi)</option>
                                    <option value="Unggas">Unggas (Ayam, Itik, Puyuh)</option>
                                    <option value="Aneka Ternak">Aneka Ternak (Kelinci, Merpati, dll)</option>
                                    <option value="Sapi">Sapi (Potong &amp; Perah)</option>
                                    <option value="Kambing">Kambing &amp; Domba</option>
                                    <option value="Ayam">Ayam (Broiler, Layer, Buras)</option>
                                    <option value="Itik">Itik &amp; Entok</option>
                                </select>
                                <select class="table-select-filter" id="filter-kecamatan-populasi" onchange="filterPopulasi()">
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
                                    <option value="Gunungsindur">Gunungsindur</option>
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
                            <table class="modern-data-table" id="table-populasi">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori</th>
                                        <th>Jenis Ternak</th>
                                        <th class="text-right">Populasi (Ekor)</th>
                                        <th class="text-right">Populasi 2022</th>
                                        <th>Perubahan Tren</th>
                                        <th>Status Sentra</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>1</td><td><span class="badge-tag badge-green">Ternak Besar</span></td><td><strong>Sapi Potong</strong></td><td class="text-right"><strong>21.168</strong></td><td class="text-right">20.618</td><td><span style="color:#16a34a; font-weight:700;">+2,67% ↗</span></td><td>Jonggol, Cariu, Rumpin</td></tr>
                                    <tr><td>2</td><td><span class="badge-tag badge-green">Ternak Besar</span></td><td><strong>Sapi Perah</strong></td><td class="text-right"><strong>6.099</strong></td><td class="text-right">5.792</td><td><span style="color:#16a34a; font-weight:700;">+5,30% ↗</span></td><td>Cisarua, Megamendung, Ciawi</td></tr>
                                    <tr><td>3</td><td><span class="badge-tag badge-green">Ternak Besar</span></td><td><strong>Kerbau</strong></td><td class="text-right"><strong>2.320</strong></td><td class="text-right">2.190</td><td><span style="color:#16a34a; font-weight:700;">+5,94% ↗</span></td><td>Rumpin, Cigudeg, Jasinga</td></tr>
                                    <tr><td>4</td><td><span class="badge-tag badge-green">Ternak Besar</span></td><td><strong>Kuda</strong></td><td class="text-right"><strong>465</strong></td><td class="text-right">455</td><td><span style="color:#16a34a; font-weight:700;">+2,20% ↗</span></td><td>Cisarua, Megamendung, Babakan Madang</td></tr>
                                    <tr><td>5</td><td><span class="badge-tag badge-blue">Ternak Kecil</span></td><td><strong>Domba</strong></td><td class="text-right"><strong>286.781</strong></td><td class="text-right">278.781</td><td><span style="color:#16a34a; font-weight:700;">+2,87% ↗</span></td><td>Jonggol, Cariu, Tanjungsari, Cijeruk</td></tr>
                                    <tr><td>6</td><td><span class="badge-tag badge-blue">Ternak Kecil</span></td><td><strong>Kambing</strong></td><td class="text-right"><strong>90.298</strong></td><td class="text-right">88.129</td><td><span style="color:#16a34a; font-weight:700;">+2,46% ↗</span></td><td>Cariu, Jonggol, Sukamakmur</td></tr>
                                    <tr><td>7</td><td><span class="badge-tag badge-blue">Ternak Kecil</span></td><td><strong>Kambing Perah</strong></td><td class="text-right"><strong>5.899</strong></td><td class="text-right">5.742</td><td><span style="color:#16a34a; font-weight:700;">+2,73% ↗</span></td><td>Caringin, Cisarua, Cijeruk</td></tr>
                                    <tr><td>8</td><td><span class="badge-tag badge-blue">Ternak Kecil</span></td><td><strong>Babi</strong></td><td class="text-right"><strong>333</strong></td><td class="text-right">835</td><td><span style="color:#dc2626; font-weight:700;">-60,1% ↘</span></td><td>Terbatas / Non-Muslim</td></tr>
                                    <tr><td>9</td><td><span class="badge-tag badge-orange">Unggas</span></td><td><strong>Ayam Ras Pedaging (Broiler)</strong></td><td class="text-right"><strong>28.192.586</strong></td><td class="text-right">27.163.199</td><td><span style="color:#16a34a; font-weight:700;">+3,79% ↗</span></td><td>Rumpin, Cigudeg, Parungpanjang, Cariu</td></tr>
                                    <tr><td>10</td><td><span class="badge-tag badge-orange">Unggas</span></td><td><strong>Ayam Ras Petelur (Layer)</strong></td><td class="text-right"><strong>9.350.115</strong></td><td class="text-right">9.200.787</td><td><span style="color:#16a34a; font-weight:700;">+1,62% ↗</span></td><td>Cariu, Tanjungsari, Cileungsi</td></tr>
                                    <tr><td>11</td><td><span class="badge-tag badge-orange">Unggas</span></td><td><strong>Ayam Buras (Kampung)</strong></td><td class="text-right"><strong>1.819.986</strong></td><td class="text-right">2.044.254</td><td><span style="color:#dc2626; font-weight:700;">-10,9% ↘</span></td><td>Tersebar di 40 Kecamatan</td></tr>
                                    <tr><td>12</td><td><span class="badge-tag badge-orange">Unggas</span></td><td><strong>Itik Manila (Entok)</strong></td><td class="text-right"><strong>168.805</strong></td><td class="text-right">167.913</td><td><span style="color:#16a34a; font-weight:700;">+0,53% ↗</span></td><td>Parung, Gunungsindur, Kemang</td></tr>
                                    <tr><td>13</td><td><span class="badge-tag badge-orange">Unggas</span></td><td><strong>Itik</strong></td><td class="text-right"><strong>117.703</strong></td><td class="text-right">131.612</td><td><span style="color:#dc2626; font-weight:700;">-10,5% ↘</span></td><td>Kemang, Ciseeng, Parung</td></tr>
                                    <tr><td>14</td><td><span class="badge-tag badge-orange">Unggas</span></td><td><strong>Burung Puyuh</strong></td><td class="text-right"><strong>78.291</strong></td><td class="text-right">76.918</td><td><span style="color:#16a34a; font-weight:700;">+1,79% ↗</span></td><td>Ciampea, Cibungbulang, Dramaga</td></tr>
                                    <tr><td>15</td><td><span class="badge-tag badge-purple">Aneka Ternak</span></td><td><strong>Kucing</strong></td><td class="text-right"><strong>36.203</strong></td><td class="text-right">35.184</td><td><span style="color:#16a34a; font-weight:700;">+2,90% ↗</span></td><td>Hewan Kesayangan Urban</td></tr>
                                    <tr><td>16</td><td><span class="badge-tag badge-purple">Aneka Ternak</span></td><td><strong>Merpati</strong></td><td class="text-right"><strong>29.144</strong></td><td class="text-right">28.521</td><td><span style="color:#16a34a; font-weight:700;">+2,18% ↗</span></td><td>Bogor Barat &amp; Tengah</td></tr>
                                    <tr><td>17</td><td><span class="badge-tag badge-purple">Aneka Ternak</span></td><td><strong>Kelinci</strong></td><td class="text-right"><strong>14.908</strong></td><td class="text-right">14.535</td><td><span style="color:#16a34a; font-weight:700;">+2,57% ↗</span></td><td>Cisarua, Megamendung, Cijeruk</td></tr>
                                    <tr><td>18</td><td><span class="badge-tag badge-purple">Aneka Ternak</span></td><td><strong>Angsa</strong></td><td class="text-right"><strong>9.024</strong></td><td class="text-right">8.540</td><td><span style="color:#16a34a; font-weight:700;">+5,67% ↗</span></td><td>Cariu, Jonggol, Rumpin</td></tr>
                                    <tr><td>19</td><td><span class="badge-tag badge-purple">Aneka Ternak</span></td><td><strong>Anjing</strong></td><td class="text-right"><strong>7.628</strong></td><td class="text-right">7.554</td><td><span style="color:#16a34a; font-weight:700;">+0,98% ↗</span></td><td>Hewan Penjaga &amp; Hobi</td></tr>
                                    <tr><td>20</td><td><span class="badge-tag badge-purple">Aneka Ternak</span></td><td><strong>Kera</strong></td><td class="text-right"><strong>5.550</strong></td><td class="text-right">5.500</td><td><span style="color:#16a34a; font-weight:700;">+0,91% ↗</span></td><td>Penangkaran &amp; Konservasi</td></tr>
                                    <tr><td>21</td><td><span class="badge-tag badge-purple">Aneka Ternak</span></td><td><strong>Rusa</strong></td><td class="text-right"><strong>492</strong></td><td class="text-right">474</td><td><span style="color:#16a34a; font-weight:700;">+3,80% ↗</span></td><td>Tanjungsari, Babakan Madang</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- TAB 2: PRODUKSI -->
                    <div id="tab-produksi" class="tab-pane">
                        <div class="table-toolbar">
                            <div>
                                <h3 style="margin: 0 0 4px; font-size: 1.1rem; color: #1e293b;">Data Realisasi Produksi Daging, Telur &amp; Susu</h3>
                                <p style="margin: 0; font-size: 0.82rem; color: #64748b;">Volume produksi komoditas hasil ternak Kabupaten Bogor per tahun.</p>
                            </div>
                            <input type="text" class="table-search-input" id="search-produksi" placeholder="🔍 Cari komoditas..." onkeyup="filterTable('table-produksi', this.value)">
                        </div>
                        <div class="modern-table-responsive">
                            <table class="modern-data-table" id="table-produksi">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kelompok Hasil</th>
                                        <th>Komoditas</th>
                                        <th>Satuan</th>
                                        <th class="text-right">Realisasi Produksi</th>
                                        <th class="text-right">Tahun Sebelumnya</th>
                                        <th>Pertumbuhan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>1</td><td><span class="badge-tag badge-green">Daging Unggas</span></td><td><strong>Daging Ayam Ras Pedaging</strong></td><td>Kg</td><td class="text-right"><strong>202.648.308</strong></td><td class="text-right">195.249.074</td><td><span style="color:#16a34a; font-weight:700;">+3,79% ↗</span></td></tr>
                                    <tr><td>2</td><td><span class="badge-tag badge-green">Daging Unggas</span></td><td><strong>Daging Ayam Ras Petelur (Afkir)</strong></td><td>Kg</td><td class="text-right"><strong>8.707.388</strong></td><td class="text-right">8.568.324</td><td><span style="color:#16a34a; font-weight:700;">+1,62% ↗</span></td></tr>
                                    <tr><td>3</td><td><span class="badge-tag badge-blue">Daging Ruminansia</span></td><td><strong>Daging Sapi Impor (RPH Swasta)</strong></td><td>Kg</td><td class="text-right"><strong>7.223.413</strong></td><td class="text-right">5.894.922</td><td><span style="color:#16a34a; font-weight:700;">+22,54% ↗</span></td></tr>
                                    <tr><td>4</td><td><span class="badge-tag badge-green">Daging Unggas</span></td><td><strong>Daging Ayam Buras</strong></td><td>Kg</td><td class="text-right"><strong>1.868.869</strong></td><td class="text-right">2.099.160</td><td><span style="color:#dc2626; font-weight:700;">-10,97% ↘</span></td></tr>
                                    <tr><td>5</td><td><span class="badge-tag badge-blue">Daging Ruminansia</span></td><td><strong>Daging Sapi Lokal</strong></td><td>Kg</td><td class="text-right"><strong>1.559.949</strong></td><td class="text-right">1.462.287</td><td><span style="color:#16a34a; font-weight:700;">+6,68% ↗</span></td></tr>
                                    <tr><td>6</td><td><span class="badge-tag badge-blue">Daging Ruminansia</span></td><td><strong>Daging Domba</strong></td><td>Kg</td><td class="text-right"><strong>469.254</strong></td><td class="text-right">524.758</td><td><span style="color:#dc2626; font-weight:700;">-10,58% ↘</span></td></tr>
                                    <tr><td>7</td><td><span class="badge-tag badge-blue">Daging Ruminansia</span></td><td><strong>Daging Kambing</strong></td><td>Kg</td><td class="text-right"><strong>339.864</strong></td><td class="text-right">252.617</td><td><span style="color:#16a34a; font-weight:700;">+34,54% ↗</span></td></tr>
                                    <tr><td>8</td><td><span class="badge-tag badge-green">Daging Unggas</span></td><td><strong>Daging Itik Manila</strong></td><td>Kg</td><td class="text-right"><strong>101.384</strong></td><td class="text-right">100.849</td><td><span style="color:#16a34a; font-weight:700;">+0,53% ↗</span></td></tr>
                                    <tr><td>9</td><td><span class="badge-tag badge-green">Daging Unggas</span></td><td><strong>Daging Itik</strong></td><td>Kg</td><td class="text-right"><strong>91.900</strong></td><td class="text-right">102.760</td><td><span style="color:#dc2626; font-weight:700;">-10,57% ↘</span></td></tr>
                                    <tr><td>10</td><td><span class="badge-tag badge-blue">Daging Ruminansia</span></td><td><strong>Daging Kerbau</strong></td><td>Kg</td><td class="text-right"><strong>62.686</strong></td><td class="text-right">88.137</td><td><span style="color:#dc2626; font-weight:700;">-28,88% ↘</span></td></tr>
                                    <tr><td>11</td><td><span class="badge-tag badge-green">Daging Unggas</span></td><td><strong>Daging Burung Puyuh</strong></td><td>Kg</td><td class="text-right"><strong>14.406</strong></td><td class="text-right">14.153</td><td><span style="color:#16a34a; font-weight:700;">+1,79% ↗</span></td></tr>
                                    <tr style="background:#f1f5f9; font-weight:bold;"><td>-</td><td><strong>TOTAL DAGING</strong></td><td><strong>Seluruh Daging</strong></td><td><strong>Kg</strong></td><td class="text-right"><strong>223.110.825</strong></td><td class="text-right"><strong>214.379.445</strong></td><td><span style="color:#16a34a;">+4,07% ↗</span></td></tr>
                                    <tr><td>12</td><td><span class="badge-tag badge-orange">Telur Konsumsi</span></td><td><strong>Telur Ayam Ras Petelur</strong></td><td>Kg</td><td class="text-right"><strong>106.924.109</strong></td><td class="text-right">105.216.454</td><td><span style="color:#16a34a; font-weight:700;">+1,62% ↗</span></td></tr>
                                    <tr><td>13</td><td><span class="badge-tag badge-orange">Telur Konsumsi</span></td><td><strong>Telur Ayam Buras</strong></td><td>Kg</td><td class="text-right"><strong>3.903.491</strong></td><td class="text-right">4.384.499</td><td><span style="color:#dc2626; font-weight:700;">-10,97% ↘</span></td></tr>
                                    <tr><td>14</td><td><span class="badge-tag badge-orange">Telur Konsumsi</span></td><td><strong>Telur Itik Manila</strong></td><td>Kg</td><td class="text-right"><strong>929.677</strong></td><td class="text-right">924.764</td><td><span style="color:#16a34a; font-weight:700;">+0,53% ↗</span></td></tr>
                                    <tr><td>15</td><td><span class="badge-tag badge-orange">Telur Konsumsi</span></td><td><strong>Telur Itik</strong></td><td>Kg</td><td class="text-right"><strong>739.970</strong></td><td class="text-right">827.413</td><td><span style="color:#dc2626; font-weight:700;">-10,57% ↘</span></td></tr>
                                    <tr><td>16</td><td><span class="badge-tag badge-orange">Telur Konsumsi</span></td><td><strong>Telur Burung Puyuh</strong></td><td>Kg</td><td class="text-right"><strong>132.515</strong></td><td class="text-right">130.195</td><td><span style="color:#16a34a; font-weight:700;">+1,78% ↗</span></td></tr>
                                    <tr style="background:#f1f5f9; font-weight:bold;"><td>-</td><td><strong>TOTAL TELUR</strong></td><td><strong>Seluruh Telur</strong></td><td><strong>Kg</strong></td><td class="text-right"><strong>112.629.762</strong></td><td class="text-right"><strong>111.483.325</strong></td><td><span style="color:#16a34a;">+1,03% ↗</span></td></tr>
                                    <tr><td>17</td><td><span class="badge-tag badge-purple">Susu Segar</span></td><td><strong>Susu Sapi Segar</strong></td><td>Liter</td><td class="text-right"><strong>14.770.977</strong></td><td class="text-right">14.027.463</td><td><span style="color:#16a34a; font-weight:700;">+5,30% ↗</span></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- TAB 3: SARANA & PRASARANA -->
                    <div id="tab-sarana" class="tab-pane">
                        <div class="table-toolbar">
                            <div>
                                <h3 style="margin: 0 0 4px; font-size: 1.1rem; color: #1e293b;">Infrastruktur, RPH, Pasar Hewan &amp; Cold Storage</h3>
                                <p style="margin: 0; font-size: 0.82rem; color: #64748b;">Fasilitas pemotongan, pasar ternak, instalasi karantina, dan rantai dingin di Kabupaten Bogor.</p>
                            </div>
                            <input type="text" class="table-search-input" id="search-sarana" placeholder="🔍 Cari fasilitas..." onkeyup="filterTable('table-sarana', this.value)">
                        </div>
                        <div class="modern-table-responsive">
                            <table class="modern-data-table" id="table-sarana">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Fasilitas / Perusahaan</th>
                                        <th>Jenis Sarana</th>
                                        <th>Lokasi / Kecamatan</th>
                                        <th>Kapasitas / Keterangan</th>
                                        <th>Status Izin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>1</td><td><strong>Pasar Hewan Jonggol</strong></td><td><span class="badge-tag badge-green">Pasar Hewan</span></td><td>Kecamatan Jonggol</td><td>Pasar Hewan Terbesar di Jabar (Daya Tampung 2.500 Ekor)</td><td><span class="badge-tag badge-green">Aktif (Pemda)</span></td></tr>
                                    <tr><td>2</td><td><strong>Pasar Hewan Cibinong</strong></td><td><span class="badge-tag badge-green">Pasar Hewan</span></td><td>Kecamatan Cibinong</td><td>Pusat Perdagangan Ternak Ruminansia Kecil &amp; Unggas</td><td><span class="badge-tag badge-green">Aktif (Pemda)</span></td></tr>
                                    <tr><td>3</td><td><strong>RPH Pemerintah Cibinong</strong></td><td><span class="badge-tag badge-blue">RPH Ruminansia</span></td><td>Jl. Ciriung, Cibinong</td><td>Pemotongan Sapi &amp; Kerbau Higienis Berstandar Veteriner</td><td><span class="badge-tag badge-green">NKV Level 1</span></td></tr>
                                    <tr><td>4</td><td><strong>PT. Elders Indonesia</strong></td><td><span class="badge-tag badge-blue">RPH Swasta Modern</span></td><td>Kecamatan Babakan Madang</td><td>Pemotongan Sapi Standar Ekspor &amp; Karantina Modern</td><td><span class="badge-tag badge-green">NKV Level 1</span></td></tr>
                                    <tr><td>5</td><td><strong>PT. Agrisatwa Jaya Kencana</strong></td><td><span class="badge-tag badge-blue">RPH Swasta Modern</span></td><td>Kecamatan Sukamakmur</td><td>Fasilitas Pemotongan Ternak Ruminansia Besar</td><td><span class="badge-tag badge-green">NKV Resmi</span></td></tr>
                                    <tr><td>6</td><td><strong>PT. Karunia Alam Sentosa Mandiri</strong></td><td><span class="badge-tag badge-blue">RPH Swasta Modern</span></td><td>Kecamatan Cariu</td><td>Pemotongan Sapi Potong &amp; Feedlot</td><td><span class="badge-tag badge-green">NKV Resmi</span></td></tr>
                                    <tr><td>7</td><td><strong>RPU Modern Cibinong &amp; Parung</strong></td><td><span class="badge-tag badge-orange">Rumah Potong Unggas</span></td><td>Cibinong, Parung, Gunungputri</td><td>Pemotongan Ayam Pedaging Otomatis Bersih &amp; Halal</td><td><span class="badge-tag badge-green">NKV &amp; Halal</span></td></tr>
                                    <tr><td>8</td><td><strong>PT. Indoguna Utama Cold Storage</strong></td><td><span class="badge-tag badge-purple">Cold Storage Daging</span></td><td>Kecamatan Gunung Putri</td><td>Penyimpanan Daging Beku &amp; Produk Olahan Ekspor-Impor</td><td><span class="badge-tag badge-green">IKPH / NKV</span></td></tr>
                                    <tr><td>9</td><td><strong>PT. Sukanda Djaya Cold Chain</strong></td><td><span class="badge-tag badge-purple">Cold Storage Daging</span></td><td>Kecamatan Cileungsi</td><td>Rantai Dingin Daging, Susu, dan Produk Olahan Pangan</td><td><span class="badge-tag badge-green">NKV Resmi</span></td></tr>
                                    <tr><td>10</td><td><strong>PT. Charoen Pokphand Indonesia</strong></td><td><span class="badge-tag badge-gray">Pabrik Pakan Ternak</span></td><td>Kecamatan Cileungsi</td><td>Pabrik Pakan Ternak Unggas Skala Nasional</td><td><span class="badge-tag badge-green">Izin Usaha</span></td></tr>
                                    <tr><td>11</td><td><strong>PT. Japfa Comfeed Indonesia</strong></td><td><span class="badge-tag badge-gray">Pabrik Pakan Ternak</span></td><td>Kecamatan Gunung Putri</td><td>Produksi Pakan Ternak dan Pembibitan DOC Unggas</td><td><span class="badge-tag badge-green">Izin Usaha</span></td></tr>
                                    <tr><td>12</td><td><strong>PT. Medion Farma Jaya</strong></td><td><span class="badge-tag badge-blue">Obat &amp; Vaksin Hewan</span></td><td>Kecamatan Babakan Madang</td><td>Pusat Farmasi, Vaksin, dan Suplemen Peternakan</td><td><span class="badge-tag badge-green">Izin Resmi</span></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- TAB 4: NKV -->
                    <div id="tab-nkv" class="tab-pane">
                        <div class="table-toolbar">
                            <div>
                                <h3 style="margin: 0 0 4px; font-size: 1.1rem; color: #1e293b;">Unit Usaha Produk Hewan Bersertifikat NKV</h3>
                                <p style="margin: 0; font-size: 0.82rem; color: #64748b;">Nomor Kontrol Veteriner sebagai bukti jaminan higiene &amp; sanitasi produk asal hewan.</p>
                            </div>
                            <a href="{{ route('front.nkv.index') }}" class="btn btn-green" style="font-size: 0.85rem; padding: 6px 14px; text-decoration: none;">Ajukan NKV Baru →</a>
                        </div>
                        <div class="modern-table-responsive">
                            <table class="modern-data-table" id="table-nkv">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori Unit Usaha</th>
                                        <th>Kriteria Higiene &amp; Sanitasi</th>
                                        <th>Komoditas Terverifikasi</th>
                                        <th>Jumlah Unit di Kab. Bogor</th>
                                        <th>Masa Berlaku</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>1</td><td><strong>RPH Ruminansia</strong></td><td>Penyembelihan Halal, Ruang Dingin, Pengolahan Limbah IPAL</td><td>Daging Sapi, Kerbau, Domba, Kambing</td><td><strong>12 Unit</strong> (Pemda &amp; Swasta)</td><td>5 Tahun (Audit Berkala)</td></tr>
                                    <tr><td>2</td><td><strong>RPU (Rumah Potong Unggas)</strong></td><td>Scalder suhu terkontrol, Eviscerasi Higienis, Air Chilling</td><td>Karkas Ayam Broiler, Bebek, Puyuh</td><td><strong>18 Unit</strong> Terdaftar</td><td>5 Tahun (Audit Berkala)</td></tr>
                                    <tr><td>3</td><td><strong>Cold Storage &amp; Gudang Daging</strong></td><td>Suhu beku stabil (-18°C), Layout Terpisah, Rantai Dingin Terjaga</td><td>Daging Beku Impor &amp; Lokal</td><td><strong>24 Unit</strong> Gudang Berizin</td><td>5 Tahun (Audit Berkala)</td></tr>
                                    <tr><td>4</td><td><strong>Unit Pengolahan Daging &amp; Susu</strong></td><td>HACCP, Pasteurisasi Suhu Tinggi, Ruang Produksi Steril</td><td>Sosis, Nugget, Bakso, Susu Pasteurisasi, Yogurt</td><td><strong>35 Unit</strong> UMKM &amp; Industri</td><td>5 Tahun (Audit Berkala)</td></tr>
                                    <tr><td>5</td><td><strong>Kios Daging &amp; Ritel Modern</strong></td><td>Showcase berpendingin, Pemisahan Pisau &amp; Talenan, Sanitasi</td><td>Daging Segar &amp; Olahan di Pasar/Supermarket</td><td><strong>45+ Kios</strong> Terverifikasi</td><td>5 Tahun (Audit Berkala)</td></tr>
                                    <tr><td>6</td><td><strong>Gudang Telur Konsumsi</strong></td><td>Pembersihan Telur, Candling Kualitas, Suhu &amp; Kelembaban Terukur</td><td>Telur Ayam Ras, Ayam Buras, Bebek</td><td><strong>15 Unit</strong> Tersebar</td><td>5 Tahun (Audit Berkala)</td></tr>
                                </tbody>
                            </table>
                        </div>
                        <div style="margin-top: 20px; text-align: center;">
                            <a href="{{ route('front.bukudata.peternakan') }}" target="_blank" class="btn btn-green" style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                                <span>📖</span> Buka Flipbook 3D Buku Data Peternakan 2025 Lengkap
                            </a>
                        </div>
                    </div>

                    <!-- TAB 5: FAQ & PANDUAN -->
                    <div id="tab-faq" class="tab-pane">
                        <div class="table-toolbar">
                            <div>
                                <h3 style="margin: 0 0 4px; font-size: 1.1rem; color: #1e293b;">FAQ &amp; Panduan Penggunaan Aplikasi</h3>
                                <p style="margin: 0; font-size: 0.82rem; color: #64748b;">Tata cara masyarakat mengetahui dan menggunakan fitur-fitur pada aplikasi SPARTAN.</p>
                            </div>
                        </div>

                        <div class="row g-3 mt-1">
                            <div class="col-lg-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-header bg-primary bg-opacity-10 border-bottom">
                                        <h5 class="mb-0 fw-bold"><i class="ti ti-fish text-primary me-1"></i> Peternakan</h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="accordion accordion-flush" id="faqPeternakanTab">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="faq-peternakan-1">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-peternakan-collapse-1">
                                                        Bagaimana cara melihat data populasi ternak?
                                                    </button>
                                                </h2>
                                                <div id="faq-peternakan-collapse-1" class="accordion-collapse collapse show" data-bs-parent="#faqPeternakanTab">
                                                    <div class="accordion-body">
                                                        <p>Gunakan tab <strong>Populasi Ternak Lengkap</strong> pada halaman Peternakan. Data menampilkan populasi per jenis ternak berdasarkan kecamatan dengan informasi tren perubahan.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="faq-peternakan-2">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-peternakan-collapse-2">
                                                        Bagaimana cara melihat data produksi ternak?
                                                    </button>
                                                </h2>
                                                <div id="faq-peternakan-collapse-2" class="accordion-collapse collapse" data-bs-parent="#faqPeternakanTab">
                                                    <div class="accordion-body">
                                                        <p>Gunakan tab <strong>Produksi Daging, Telur &amp; Susu</strong> untuk melihat data produksi komoditas peternakan berdasarkan tahun dan wilayah.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="faq-peternakan-3">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-peternakan-collapse-3">
                                                        Bagaimana cara melihat data sarana prasarana?
                                                    </button>
                                                </h2>
                                                <div id="faq-peternakan-collapse-3" class="accordion-collapse collapse" data-bs-parent="#faqPeternakanTab">
                                                    <div class="accordion-body">
                                                        <p>Gunakan tab <strong>Sarana, RPH &amp; Pasar Hewan</strong> untuk melihat informasi RPH-R, RPH-U, Pasar Hewan, dan Poskeswan UPT di Kabupaten Bogor.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="faq-peternakan-4">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-peternakan-collapse-4">
                                                        Bagaimana cara melihat daftar unit NKV?
                                                    </button>
                                                </h2>
                                                <div id="faq-peternakan-collapse-4" class="accordion-collapse collapse" data-bs-parent="#faqPeternakanTab">
                                                    <div class="accordion-body">
                                                        <p>Gunakan tab <strong>Unit Bersertifikat NKV</strong> untuk melihat daftar unit usaha produk hewan yang telah bersertifikat NKV dan terverifikasi. Anda juga dapat mengajukan NKV baru melalui menu NKV.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="faq-peternakan-5">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-peternakan-collapse-5">
                                                        Bagaimana cara mendaftarkan produk peternakan?
                                                    </button>
                                                </h2>
                                                <div id="faq-peternakan-collapse-5" class="accordion-collapse collapse" data-bs-parent="#faqPeternakanTab">
                                                    <div class="accordion-body">
                                                        <ol>
                                                            <li>Masuk ke dashboard sebagai user UMKM Peternakan.</li>
                                                            <li>Klik menu <strong>Produk UMKM</strong>.</li>
                                                            <li>Klik tombol <strong>Tambah Produk Baru</strong>.</li>
                                                            <li>Isi formulir: nama produk, harga, satuan, deskripsi.</li>
                                                            <li>Unggah foto produk yang jelas.</li>
                                                            <li>Klik <strong>Simpan</strong> untuk mengirim ke verifikasi admin.</li>
                                                        </ol>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="faq-peternakan-6">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-peternakan-collapse-6">
                                                        Bagaimana cara melihat status verifikasi produk?
                                                    </button>
                                                </h2>
                                                <div id="faq-peternakan-collapse-6" class="accordion-collapse collapse" data-bs-parent="#faqPeternakanTab">
                                                    <div class="accordion-body">
                                                        <p>Status verifikasi dapat dilihat di halaman <strong>Daftar Produk Saya</strong>. Badge <span class="badge bg-label-warning">Menunggu Verifikasi</span> menunjukkan produk belum diverifikasi admin.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-header bg-success bg-opacity-10 border-bottom">
                                        <h5 class="mb-0 fw-bold"><i class="ti ti-building-store text-success me-1"></i> Umum &amp; Akses</h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="accordion accordion-flush" id="faqUmumTab">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="faq-umum-1">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-umum-collapse-1">
                                                        Bagaimana cara login ke aplikasi SPARTAN?
                                                    </button>
                                                </h2>
                                                <div id="faq-umum-collapse-1" class="accordion-collapse collapse show" data-bs-parent="#faqUmumTab">
                                                    <div class="accordion-body">
                                                        <p>Masukkan email dan password yang telah didaftarkan pada halaman login. User UMKM didaftarkan oleh admin melalui menu <strong>User UMKM</strong>.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="faq-umum-2">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-umum-collapse-2">
                                                        Fitur apa saja yang tersedia di dashboard?
                                                    </button>
                                                </h2>
                                                <div id="faq-umum-collapse-2" class="accordion-collapse collapse" data-bs-parent="#faqUmumTab">
                                                    <div class="accordion-body">
                                                        <p>Dashboard menampilkan fitur utama sesuai role:</p>
                                                        <ul>
                                                            <li><strong>UMKM:</strong> Produk UMKM, Dokumen Legalitas, Statistik</li>
                                                            <li><strong>Peternakan:</strong> Populasi, Produksi, Sarana, NKV</li>
                                                            <li><strong>Perikanan:</strong> Produksi Ikan, Komoditas, Harga</li>
                                                            <li><strong>Admin:</strong> Verifikasi, User Management, Laporan</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="faq-umum-3">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-umum-collapse-3">
                                                        Bagaimana cara melihat informasi perikanan?
                                                    </button>
                                                </h2>
                                                <div id="faq-umum-collapse-3" class="accordion-collapse collapse" data-bs-parent="#faqUmumTab">
                                                    <div class="accordion-body">
                                                        <p>Gunakan menu <strong>Perikanan</strong> pada navigasi utama. Halaman Perikanan menampilkan data produksi, komoditas ikan, harga pasar, dan informasi budidaya.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="faq-umum-4">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-umum-collapse-4">
                                                        Apa itu NKV dan bagaimana cara mengajukannya?
                                                    </button>
                                                </h2>
                                                <div id="faq-umum-collapse-4" class="accordion-collapse collapse" data-bs-parent="#faqUmumTab">
                                                    <div class="accordion-body">
                                                        <p><strong>NKV (Nomor Kontrol Veteriner)</strong> adalah nomor sertifikasi jaminan higiene &amp; sanitasi produk hewan. Untuk mengajukan NKV baru, klik tombol <strong>Ajukan NKV Baru</strong> pada tab NKV atau menu NKV.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="faq-umum-5">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-umum-collapse-5">
                                                        Bagaimana cara menghubungi admin?
                                                    </button>
                                                </h2>
                                                <div id="faq-umum-collapse-5" class="accordion-collapse collapse" data-bs-parent="#faqUmumTab">
                                                    <div class="accordion-body">
                                                        <p>Anda dapat menghubungi admin melalui halaman <strong>Informasi</strong> atau melalui notifikasi yang muncul di dashboard. Kontak Dinas Perikanan dan Peternakan Kabupaten Bogor juga tersedia di footer halaman.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="faq-umum-6">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-umum-collapse-6">
                                                        Bagaimana cara melihat data statistik &amp; grafik?
                                                    </button>
                                                </h2>
                                                <div id="faq-umum-collapse-6" class="accordion-collapse collapse" data-bs-parent="#faqUmumTab">
                                                    <div class="accordion-body">
                                                        <p>Data statistik dan grafik ditampilkan secara otomatis di setiap halaman sektor (Peternakan &amp; Perikanan). Scroll ke bawah untuk melihat grafik distribusi data per kecamatan.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 16px; text-align: center;">
                            <a href="{{ route('faq.index') }}" class="btn btn-green" style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                                <span>📖</span> Lihat FAQ Lengkap
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END SECTION BUKU DATA PETERNAKAN 2025 -->
        <section class="section-soft-blue section" id="produksi-populasi-section">
            <div class="container">
                <div class="section-title-row">
                    <h2 class="section-title"><span class="leaf-mark">❧</span>Produksi &amp; Populasi Ternak</h2>
                </div>
                <div class="category-grid">
                    <article class="category-card service-category-card production">
                        <div aria-hidden="true" class="service-visual">
                            <span class="service-visual-main">🥛</span>
                            <span class="service-visual-badge">↗</span>
                        </div>
                        <div class="category-heading">
                            <span class="big-icon">▦</span>
                            <div>
                                <h2>Produksi Ternak</h2>
                                <p>Data produksi komoditas peternakan Kabupaten Bogor</p>
                            </div>
                        </div>
                        <div class="category-items">
                            <div class="category-item"><span>◷</span>Data Tahunan</div>
                            <div class="category-item"><span>⌖</span>Per Kecamatan</div>
                            <div class="category-item"><span>▥</span>Jenis Ternak</div>
                        </div>
                        <a class="btn btn-blue category-button"
                            href="{{ route("front.produksi-populasi.index") }}#data-produksi-section">Lihat Selengkapnya →</a>
                    </article>
                    <article class="category-card service-category-card population">
                        <div aria-hidden="true" class="service-visual">
                            <span class="service-visual-main">🐄</span>
                            <span class="service-visual-badge">▥</span>
                        </div>
                        <div class="category-heading">
                            <span class="big-icon">♣</span>
                            <div>
                                <h2>Populasi Ternak</h2>
                                <p>Sebaran dan perkembangan populasi ternak daerah</p>
                            </div>
                        </div>
                        <div class="category-items">
                            <div class="category-item"><span>◷</span>Histori Data</div>
                            <div class="category-item"><span>⌖</span>Peta Sebaran</div>
                            <div class="category-item"><span>↗</span>Tren Populasi</div>
                        </div>
                        <a class="btn btn-green category-button"
                            href="{{ route("front.produksi-populasi.index") }}#data-populasi-section">Lihat Selengkapnya →</a>
                    </article>
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
    <script src="https://unpkg.com/esri-leaflet@3.0.12/dist/esri-leaflet.js"></script>
    <script src="{{ asset('assets-front-new/js/sector-data.js') }}"></script>

    <script>
        // Tab switching logic
        function switchPeternakanTab(tabId, btn) {
            document.querySelectorAll('.data-tabs-container .tab-pane').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.data-tabs-container .data-tab-button').forEach(el => el.classList.remove('active'));
            
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

        // Multi-filter for Tabel Populasi Ternak
        function filterPopulasi() {
            const searchVal = (document.getElementById('search-populasi')?.value || '').toLowerCase().trim();
            const kategoriVal = (document.getElementById('filter-kategori-populasi')?.value || '').toLowerCase().trim();
            const kecamatanVal = (document.getElementById('filter-kecamatan-populasi')?.value || '').toLowerCase().trim();
            
            const table = document.getElementById('table-populasi');
            if (!table) return;
            const rows = table.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                if (row.cells.length < 7) return;
                
                const kategoriText = row.cells[1]?.textContent.toLowerCase() || '';
                const jenisText = row.cells[2]?.textContent.toLowerCase() || '';
                const sentraText = row.cells[6]?.textContent.toLowerCase() || '';
                const allRowText = row.textContent.toLowerCase();
                
                const matchSearch = !searchVal || allRowText.includes(searchVal);
                const matchKategori = !kategoriVal || kategoriText.includes(kategoriVal) || jenisText.includes(kategoriVal);
                const matchKecamatan = !kecamatanVal || sentraText.includes(kecamatanVal) || sentraText.includes('tersebar');
                
                if (matchSearch && matchKategori && matchKecamatan) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Initialize Highcharts for Buku Data Peternakan 2025
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof Highcharts !== 'undefined') {
                // Chart Populasi
                Highcharts.chart('peternakan-chart-populasi', {
                    chart: { type: 'column', backgroundColor: 'transparent' },
                    title: { text: null },
                    credits: { enabled: false },
                    xAxis: {
                        categories: ['Sapi Potong', 'Sapi Perah', 'Kerbau', 'Domba', 'Kambing', 'Ayam Broiler (Juta)', 'Ayam Layer (Juta)', 'Ayam Buras (Juta)', 'Itik & Manila (Rb)'],
                        crosshair: true
                    },
                    yAxis: {
                        min: 0,
                        title: { text: 'Jumlah Populasi' }
                    },
                    tooltip: {
                        shared: true,
                        valueSuffix: ' ekor'
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.15,
                            borderWidth: 0,
                            borderRadius: 4
                        }
                    },
                    series: [{
                        name: 'Populasi 2022',
                        data: [20618, 5792, 2190, 278781, 88129, 27.16, 9.20, 2.04, 299.5],
                        color: '#94a3b8'
                    }, {
                        name: 'Populasi 2023 / 2025',
                        data: [21168, 6099, 2320, 286781, 90298, 28.19, 9.35, 1.82, 286.5],
                        color: '#15803d'
                    }]
                });

                // Chart Produksi
                Highcharts.chart('peternakan-chart-produksi', {
                    chart: { type: 'pie', backgroundColor: 'transparent' },
                    title: { text: null },
                    credits: { enabled: false },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b> ({point.y:,.0f} Kg/Liter)'
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
                            name: 'Ayam Broiler (Daging)',
                            y: 202648308,
                            sliced: true,
                            selected: true,
                            color: '#16a34a'
                        }, {
                            name: 'Telur Ayam Ras',
                            y: 106924109,
                            color: '#f59e0b'
                        }, {
                            name: 'Susu Sapi Segar (Lt)',
                            y: 14770977,
                            color: '#8b5cf6'
                        }, {
                            name: 'Ayam Layer (Daging Afkir)',
                            y: 8707388,
                            color: '#059669'
                        }, {
                            name: 'Sapi Impor (Daging)',
                            y: 7223413,
                            color: '#0284c7'
                        }, {
                            name: 'Telur Buras & Lainnya',
                            y: 5705653,
                            color: '#fbbf24'
                        }, {
                            name: 'Sapi Lokal & Ruminansia Lain',
                            y: 2431753,
                            color: '#d97706'
                        }]
                    }]
                });
            }
        });
    </script>
</body>

</html>