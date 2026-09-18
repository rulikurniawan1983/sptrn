<!DOCTYPE html>

<html lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="Produk UMKM, berita, dan edukasi peternakan serta perikanan." name="description"/>
<title>SPARTAN — Informasi</title>
<link href="{{ asset('assets-front-new/css/styles.css?v=14') }}" rel="stylesheet"/>
</head>
<body class="page-info" data-page="info">
<header class="site-header">
<div class="container header-inner">
<a aria-label="SPARTAN beranda" class="brand" href="{{ route('front.home.index') }}">
<img alt="Logo Bogor" class="brand-logo" style="width: auto;" src="{{ asset('assets/img/logo.webp') }}" />
        <img alt="Logo SPARTAN" class="brand-logo" style="width: auto;" src="{{ asset('assets/img/17350108258803.png') }}" />
</a>
<nav aria-label="Navigasi utama" class="desktop-nav"><a data-nav="home" href="{{ route('front.home.index') }}">Beranda</a><a data-nav="livestock" href="{{ route('front.peternakan-info') }}">Peternakan</a><a data-nav="fishery" href="{{ route('front.perikanan-info') }}">Perikanan</a><a data-nav="umkm" href="{{ route('front.umkm-info') }}">UMKM</a><a data-nav="certification" href="{{ route('front.nkv.index') }}">NKV</a></nav>
<div class="header-actions">
<form class="search-box" onsubmit="handleSearch(event)">
<input aria-label="Cari informasi" placeholder="Cari informasi..." type="search"/>
<button aria-label="Cari" type="submit">⌕</button>
</form>
<a class="login-btn" href="{{ route('login') }}" style="text-decoration:none;" >♙ <span>Login</span></a>
<button aria-expanded="false" aria-label="Buka menu" class="menu-toggle" id="menuToggle" type="button">☰</button>
</div>
</div>
</header>
<div class="mobile-panel" id="mobilePanel">
<nav aria-label="Navigasi seluler" class="mobile-nav"><a data-nav="home" href="{{ route('front.home.index') }}">Beranda</a><a data-nav="livestock" href="{{ route('front.peternakan-info') }}">Peternakan</a><a data-nav="fishery" href="{{ route('front.perikanan-info') }}">Perikanan</a><a data-nav="umkm" href="{{ route('front.umkm-info') }}">UMKM</a><a data-nav="certification" href="{{ route('front.nkv.index') }}">NKV</a></nav>
<form class="search-box mobile-search" onsubmit="handleSearch(event)">
<input aria-label="Cari informasi" placeholder="Cari informasi..." type="search"/>
<button aria-label="Cari" type="submit">⌕</button>
</form>
<a class="login-btn mobile-login" href="{{ route('login') }}" style="text-decoration:none;" >♙ Login</a>
</div>
<main>
<section class="page-hero info">
<div class="container page-hero-inner">
<div class="breadcrumbs"><a href="{{ route('front.home.index') }}">Beranda</a><span>›</span><span>Produk, Berita &amp; Edukasi</span></div>
<span class="page-kicker">Informasi SPARTAN</span>
<h1>Produk, Berita &amp; Edukasi</h1>
<p>Kumpulan produk UMKM, artikel peternakan dan perikanan, informasi cuaca, serta akses komunitas dalam satu halaman.</p>
<div class="page-hero-actions"><a class="btn btn-green" href="{{ route('front.umkm-info') }}">Buka UMKM</a><a class="btn btn-ghost" href="#berita">Baca berita</a></div>
</div>
<div aria-hidden="true" class="page-hero-symbol">▧</div>
</section>
<section class="section" id="produk">
<div class="container">
<div class="section-title-row">
<h2 class="section-title"><span class="leaf-mark">❧</span>Produk UMKM Pilihan</h2>
<a class="section-link" href="{{ route('front.umkm-info') }}">Buka Etalase UMKM →</a>
</div>
<div class="products-grid">
@forelse($products ?? [] as $product)
<article class="product-card">
    <a href="{{ route('front.umkm-product-detail', $product->id) }}" style="text-decoration: none; color: inherit; display: block;">
        <img alt="{{ $product->nama_produk }}" src="{{ $product->foto_produk_url }}" />
        <div class="product-info">
            <h3>{{ $product->nama_produk }}</h3><small>{{ $product->satuan }}</small>
            <div class="price">Rp{{ number_format($product->harga, 0, ',', '.') }}</div>
        </div>
    </a>
    <div style="padding: 0 1rem 1rem;">
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
</div>
</section>
<section class="section" id="berita">
<div class="container">
<div class="section-title-row">
<h2 class="section-title"><span class="leaf-mark">▧</span>Berita &amp; Edukasi Terbaru</h2>
<a class="section-link" href="#berita">Lihat Semua Artikel →</a>
</div>
<div class="news-layout" id="edukasi">
<div class="news-grid">
<article class="news-card">
<div class="news-image"><img alt="Sapi perah" src="{{ asset('assets-front-new/images/') }}/content-05.jpg"/><span class="tag green">Peternakan</span></div>
<div class="news-body">
<h3>5 Tips Meningkatkan Produksi Susu Sapi Perah</h3>
<div class="news-meta"><span>24 Mei 2024</span><span>◉ 1.2K</span></div>
</div>
</article>
<article class="news-card">
<div class="news-image"><img alt="Budidaya lele" src="{{ asset('assets-front-new/images/') }}/content-06.jpg"/><span class="tag blue">Perikanan</span></div>
<div class="news-body">
<h3>Cara Budidaya Lele yang Baik dan Benar</h3>
<div class="news-meta"><span>22 Mei 2024</span><span>◉ 980</span></div>
</div>
</article>
<article class="news-card">
<div class="news-image"><img alt="Kandang ayam" src="{{ asset('assets-front-new/images/') }}/content-07.jpg"/><span class="tag green">Peternakan</span></div>
<div class="news-body">
<h3>Manajemen Kandang Ayam Modern</h3>
<div class="news-meta"><span>20 Mei 2024</span><span>◉ 1.1K</span></div>
</div>
</article>
<article class="news-card">
<div class="news-image"><img alt="Kolam budidaya ikan" src="{{ asset('assets-front-new/images/') }}/content-08.jpg"/><span class="tag blue">Perikanan</span></div>
<div class="news-body">
<h3>Teknologi Terbaru dalam Budidaya Ikan</h3>
<div class="news-meta"><span>18 Mei 2024</span><span>◉ 870</span></div>
</div>
</article>
</div>
<aside aria-label="Informasi cuaca" class="weather-card">
<h3>Cuaca &amp; Info</h3>
<div class="weather-city">Kabupaten Bogor, Jawa Barat</div><span class="weather-date" id="weatherDate">Sabtu, 25 Mei
                            2024</span>
<div class="temperature-row"><span class="cloud">☁</span><span class="temperature">29°C</span><span class="sun">☀</span></div>
<div class="condition">Cerah Berawan</div>
<div class="humidity">Humidity: 68%</div>
<div class="weather-range"><span>Min —</span><span>Max —</span></div>
</aside>
</div>
</div>
</section>
<section class="container cta"><p>Bergabung dengan komunitas kami dan dapatkan informasi terbaru seputar peternakan dan perikanan.</p><button onclick="showToast('Formulir pendaftaran komunitas dapat dihubungkan ke backend.')" type="button">♟   Daftar Sekarang</button></section>
</main>
<footer class="site-footer" id="kontak">
<div class="footer-wave">
<svg height="100%" preserveaspectratio="none" version="1.1" viewbox="0 0 1600 900" width="100%" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<defs>
<lineargradient id="bg" x1="0%" x2="100%" y1="0%" y2="0%"><stop offset="0%" style="stop-color:#0878bd;stop-opacity:.4"></stop><stop offset="50%" style="stop-color:#15963a;stop-opacity:.5"></stop><stop offset="100%" style="stop-color:#10772e;stop-opacity:.8"></stop></lineargradient>
<path d="M-363.852,502.589c0,0,236.988-41.997,505.475,0s371.981,38.998,575.971,0s293.985-39.278,505.474,5.859s493.475,48.368,716.963-4.995v560.106H-363.852V502.589z" fill="url(#bg)" id="wave"></path>
</defs>
<g><use opacity=".3" xlink:href="#wave"><animatetransform attributename="transform" attributetype="XML" dur="10s" repeatcount="indefinite" type="translate" values="270 230;-334 180;270 230"></animatetransform></use><use opacity=".6" xlink:href="#wave"><animatetransform attributename="transform" attributetype="XML" dur="8s" repeatcount="indefinite" type="translate" values="-270 230;243 220;-270 230"></animatetransform></use><use opacity=".9" xlink:href="#wave"><animatetransform attributename="transform" attributetype="XML" dur="6s" repeatcount="indefinite" type="translate" values="0 230;-140 200;0 230"></animatetransform></use></g>
</svg>
</div>
<div class="container">
<div class="footer-grid">
<div class="footer-brand"><a class="brand" href="{{ route('front.home.index') }}"><img alt="Logo Bogor" class="brand-logo" style="width: auto;" src="{{ asset('assets/img/logo.webp') }}" />
        <img alt="Logo SPARTAN" class="brand-logo" style="width: auto;" src="{{ asset('assets/img/17350108258803.png') }}" /></a><p>SISTEM PELAYANAN AGRIBISNIS<br>PERIKANAN DAN PETERNAKAN</p></div>
<div class="footer-col"><h4>Sektor</h4><ul><li><a href="{{ route('front.peternakan-info') }}">Peternakan</a></li><li><a href="{{ route('front.perikanan-info') }}">Perikanan</a></li></ul></div>
<div class="footer-col"><h4>Informasi</h4><ul><li><a href="{{ route('front.umkm-info') }}">Produk UMKM</a></li><li><a href="{{ route('front.nkv.index') }}">NKV</a></li><li><a href="{{ route('front.home.index') }}">Beranda</a></li></ul></div>
<div class="footer-col"><h4>Kontak</h4><ul class="contact-list"><li>⌖ <span>Kabupaten Bogor, Jawa Barat</span></li><li>☎ <span>Dinas Perikanan dan Peternakan</span></li><li>↗ <span>diskanak.bogorkab.go.id</span></li></ul></div>
<div class="footer-col"><h4>Ikuti Kami</h4><div class="socials"><a aria-label="Facebook" href="#">f</a><a aria-label="Instagram" href="#">◎</a><a aria-label="YouTube" href="#">▶</a><a aria-label="WhatsApp" href="#">✆</a></div></div>
</div>
<div class="copyright"><span>© 2026 SPARTAN. Hak cipta dilindungi.</span><span>Peternakan • Perikanan • UMKM • Informasi</span></div>
</div>
</footer>
<div aria-live="polite" class="toast" id="toast" role="status"></div>
<script src="{{ asset('assets-front-new/js/app.js') }}"></script>
</body>
</html>