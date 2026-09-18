<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="@yield('meta_description', 'Portal informasi peternakan dan perikanan Kabupaten Bogor.')" name="description" />
  <title>@yield('title', 'SPARTAN')</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=2" />
  <link rel="preload" as="video" href="{{ asset('assets-front-new/images/bg.webm') }}" fetchpriority="high" />
  <link href="{{ asset('assets-front-new/css/styles.css?v=14') }}" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />
  @stack('styles')
</head>
<body class="@yield('body_class')" data-page="@yield('data_page')" data-sector="@yield('data_sector')">

  <header class="site-header">
    <div class="container header-inner">
      <a aria-label="SPARTAN beranda" class="brand" href="{{ route('front.home.index') }}">
        <img alt="Logo Bogor" class="brand-logo" style="width: auto;" src="{{ asset('assets/img/logo.webp') }}" />
        <img alt="Logo SPARTAN" class="brand-logo" style="width: auto;" src="{{ asset('assets/img/17350108258803.png') }}" />
      </a>
      <nav aria-label="Navigasi utama" class="desktop-nav">
        <a data-nav="home" href="{{ route('front.home.index') }}">Beranda</a>
        <a data-nav="livestock" href="{{ route('front.peternakan-info') }}">Peternakan</a>
        <a data-nav="fishery" href="{{ route('front.perikanan-info') }}">Perikanan</a>
        <a data-nav="umkm" href="{{ route('front.umkm-info') }}">UMKM</a>
        <a data-nav="certification" href="{{ route('front.nkv.index') }}">NKV</a>
      </nav>
      <div class="header-actions">
        <form class="search-box" onsubmit="handleSearch(event)">
          <input aria-label="Cari informasi" placeholder="Cari informasi..." type="search" />
          <button aria-label="Cari" type="submit">⌕</button>
        </form>
        <a class="login-btn" href="{{ route('login') }}" style="text-decoration:none;">♙ <span>Login</span></a>
        <button aria-expanded="false" aria-label="Buka menu" class="menu-toggle" id="menuToggle" type="button">☰</button>
      </div>
    </div>
  </header>

  <div class="mobile-panel" id="mobilePanel">
    <nav aria-label="Navigasi seluler" class="mobile-nav">
      <a data-nav="home" href="{{ route('front.home.index') }}">Beranda</a>
      <a data-nav="livestock" href="{{ route('front.peternakan-info') }}">Peternakan</a>
      <a data-nav="fishery" href="{{ route('front.perikanan-info') }}">Perikanan</a>
      <a data-nav="umkm" href="{{ route('front.umkm-info') }}">UMKM</a>
      <a data-nav="certification" href="{{ route('front.nkv.index') }}">NKV</a>
    </nav>
    <form class="search-box mobile-search" onsubmit="handleSearch(event)">
      <input aria-label="Cari informasi" placeholder="Cari informasi..." type="search" />
      <button aria-label="Cari" type="submit">⌕</button>
    </form>
    <a class="login-btn mobile-login" href="{{ route('login') }}" style="text-decoration:none;">♙ Login</a>
  </div>

  <main>
    @yield('content')
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
            <animatetransform attributename="transform" attributetype="XML" dur="10s" repeatcount="indefinite"
              type="translate" values="270 230;-334 180;270 230"></animatetransform>
          </use>
          <use opacity=".6" xlink:href="#wave">
            <animatetransform attributename="transform" attributetype="XML" dur="8s" repeatcount="indefinite"
              type="translate" values="-270 230;243 220;-270 230"></animatetransform>
          </use>
          <use opacity=".9" xlink:href="#wave">
            <animatetransform attributename="transform" attributetype="XML" dur="6s" repeatcount="indefinite"
              type="translate" values="0 230;-140 200;0 230"></animatetransform>
          </use>
        </g>
      </svg>
    </div>
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <a class="brand" href="{{ route('front.home.index') }}">
            <img alt="Logo Bogor" class="brand-logo" style="width: auto;" src="{{ asset('assets/img/logo.webp') }}" />
        <img alt="Logo SPARTAN" class="brand-logo" style="width: auto;" src="{{ asset('assets/img/17350108258803.png') }}" />
          </a>
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
          <div class="socials">
            <a aria-label="Facebook" href="#">f</a>
            <a aria-label="Instagram" href="#">◎</a>
            <a aria-label="YouTube" href="#">▶</a>
            <a aria-label="WhatsApp" href="#">✆</a>
          </div>
        </div>
      </div>
      <div class="copyright">
        <span>© 2026 SPARTAN. Hak cipta dilindungi.</span>
        <span>Peternakan • Perikanan • UMKM • Informasi</span>
      </div>
    </div>
  </footer>

  <div aria-live="polite" class="toast" id="toast" role="status"></div>
  <script src="{{ asset('assets-front-new/js/app.js') }}"></script>
  @stack('script')
</body>
</html>