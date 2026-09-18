<!DOCTYPE html>

<html lang="id">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="Portal informasi peternakan dan perikanan Kabupaten Bogor." name="description" />
  <title>SPARTAN — Beranda</title>
  <link rel="preload" as="video" href="{{ asset('assets-front-new/images/bg.webm') }}" />
  <link href="{{ asset('assets-front-new/css/styles.css?v=14') }}" rel="stylesheet" />
  <style>
    .category-card.nkv::before {
      background-image: url("{{ asset('assets-front-new/images/nkv.jpg') }}?v={{ filemtime(public_path('assets-front-new/images/nkv.jpg')) }}");
    }
  </style>
</head>

<body class="page-home" data-page="home">


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
    <a class="login-btn mobile-login" href="{{ route('login') }}" style="text-decoration:none;"
      >♙ Login</a>
  </div>
  <main>
    <section class="hero" id="beranda">
      <video class="hero-video"
        style="z-index: -4; filter: saturate(1.08) contrast(1.02); transform: scale(1.08); object-position: center 48%;"
        autoplay loop muted playsinline>
        <source src="{{ asset('assets-front-new/images/bg.webm') }}" type="video/webm">
      </video>
      <div class="container">
        <div class="hero-content">
          <h1>SPARTAN</h1>
          <H3 class="hero-copy">SISTEM PELAYANAN AGRIBISNIS <br> PERIKANAN DAN PETERNAKAN</H3>
          <!-- <div class="hero-actions">
            <a class="btn btn-green" href="#peternakan">♣ Jelajahi Peternakan</a>
            <a class="btn btn-blue" href="#perikanan">◆ Jelajahi Perikanan</a>
          </div> -->
        </div>
      </div>
      <div class="hero-lower">
        <div class="weather-strip" style="width: 100%; position: relative; z-index: 10;">
          <aside aria-label="Informasi cuaca" class="weather-card" style="width: min(980px, calc(100% - 40px)); margin: 0 auto; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 15px 15px 0 0; background: radial-gradient(circle at 86% 12%, rgba(62, 170, 255, .45), transparent 32%), linear-gradient(145deg, #0f3466, #0a4c90 55%, #082d5e); box-shadow: 0 -5px 22px rgba(8, 45, 94, .2); min-height: 82px; padding: 0 15px; color: #fff;">
            
            <!-- Lokasi & Tanggal -->
            <div style="text-align: left; flex: 1; min-width: 200px; display: flex; flex-direction: column; justify-content: center; padding-left: 10px;">
              <div class="weather-city" style="font-weight: bold; color: #fff; font-size: 0.95rem; line-height: 1.1;">Kabupaten Bogor, Jawa Barat</div>
              <div style="font-size: 0.8rem; color: rgba(255,255,255,0.8); margin-top: 2px;">
                <span id="realtime-day"></span>, <span id="realtime-date"></span>
              </div>
            </div>

            <!-- Waktu Realtime -->
            <div style="text-align: center; flex: 1; min-width: 150px; border-left: 1px solid rgba(255,255,255,0.15); border-right: 1px solid rgba(255,255,255,0.15); padding: 0 1rem; display: flex; align-items: center; justify-content: center; height: 50px;">
              <strong id="realtime-time" style="color: #ffb74d; font-size: 1.4rem; font-variant-numeric: tabular-nums; letter-spacing: 1px; line-height: 1; margin: 0; text-shadow: 0 2px 4px rgba(0,0,0,0.3);"></strong>
            </div>

            <!-- Cuaca -->
            <div style="text-align: right; flex: 1; min-width: 200px; display: flex; flex-direction: column; align-items: flex-end; justify-content: center; padding-right: 10px;">
              <div class="temperature-row" style="display: flex; align-items: center; gap: 8px; font-size: 1.3rem; color: #fff; line-height: 1;">
                <span id="weather-icon" style="font-size:1.4rem; color: #f39c12;">⛅</span><span id="weather-temp" class="temperature" style="font-weight: bold;">--°C</span>
              </div>
              <div style="display: flex; gap: 10px; font-size: 0.8rem; margin-top: 3px;">
                <span id="weather-desc" class="condition" style="font-weight: 500; color: #fff;">Memuat...</span>
                <span id="weather-hum" class="humidity" style="color: rgba(255,255,255,0.8);">Kelembapan: --%</span>
              </div>
            </div>

            <!-- Empty tag to satisfy JS id requirement without displaying it -->
            <span id="realtime-zone" style="display:none;"></span>
          </aside>
        </div>

        <script>
          document.addEventListener('DOMContentLoaded', function() {
              const CACHE_KEY = 'spartan_weather_data';
              const CACHE_TIME_KEY = 'spartan_weather_time';
              const CACHE_DURATION = 30 * 60 * 1000; // 30 menit

              function updateWeatherUI(data) {
                  if (!data || !data.current) return;
                  const temp = Math.round(data.current.temperature_2m);
                  const hum = data.current.relative_humidity_2m;
                  const code = data.current.weather_code;
                  
                  let desc = "Cerah"; let icon = "☀";
                  if (code === 0) { desc = "Cerah"; icon = "☀"; }
                  else if (code === 1 || code === 2) { desc = "Cerah Berawan"; icon = "⛅"; }
                  else if (code === 3) { desc = "Mendung"; icon = "☁"; }
                  else if (code === 45 || code === 48) { desc = "Berkabut"; icon = "🌫"; }
                  else if (code >= 51 && code <= 67) { desc = "Hujan Ringan"; icon = "🌦"; }
                  else if (code >= 80 && code <= 82) { desc = "Hujan Lebat"; icon = "🌧"; }
                  else if (code >= 95) { desc = "Badai Petir"; icon = "⛈"; }
                  
                  document.getElementById('weather-temp').innerText = temp + '°C';
                  document.getElementById('weather-hum').innerText = 'Kelembapan: ' + hum + '%';
                  document.getElementById('weather-desc').innerText = desc;
                  document.getElementById('weather-icon').innerText = icon;
              }

              const cachedData = localStorage.getItem(CACHE_KEY);
              const cachedTime = localStorage.getItem(CACHE_TIME_KEY);
              const now = new Date().getTime();

              if (cachedData && cachedTime && (now - cachedTime < CACHE_DURATION)) {
                  // Gunakan cache agar instan (tidak loading)
                  updateWeatherUI(JSON.parse(cachedData));
              } else {
                  // Koordinat Kabupaten Bogor
                  const url = `https://api.open-meteo.com/v1/forecast?latitude=-6.5944&longitude=106.7892&current=temperature_2m,relative_humidity_2m,weather_code&timezone=Asia%2FJakarta`;
                  
                  fetch(url)
                      .then(res => res.json())
                      .then(data => {
                          localStorage.setItem(CACHE_KEY, JSON.stringify(data));
                          localStorage.setItem(CACHE_TIME_KEY, now.toString());
                          updateWeatherUI(data);
                      })
                      .catch(err => console.error('Gagal mengambil cuaca:', err));
              }
          });
        </script>
        
        <div aria-label="Pilihan produk UMKM" class="umkm-strip" style="position: relative; z-index: 5; margin-top: -20px; padding-top: 10px;">
          <a class="umkm-strip-item fishery" href="{{ route('front.perikanan-info') }}"><span class="umkm-strip-icon">🐟</span>
            <div><strong>Perikanan</strong><small>Budidaya perikanan</small></div>
          </a>
          <a class="umkm-strip-item livestock" href="{{ route('front.peternakan-info') }}"><span class="umkm-strip-icon">🐄</span>
            <div><strong>Peternakan</strong><small>Budidaya peternakan</small></div>
          </a>
          <a class="umkm-strip-item processed" href="{{ route('front.nkv.index') }}"><span class="umkm-strip-icon">🛡</span>
            <div><strong>NKV</strong><small>Sertifikasi NKV</small></div>
          </a>
          <a class="umkm-strip-item market" href="{{ route('front.umkm-info') }}"><span class="umkm-strip-icon">🏪</span>
            <div><strong>UMKM</strong><small>Produk lokal </small></div>
          </a>
        </div> 
      </div>
    </section>
    <section class="section categories">
      <div class="container category-grid">
        <article class="category-card fishery" id="perikanan">
          <div class="category-heading">
            <div>
              <h2>Perikanan</h2>
             
            </div>
          </div>
          <style>
            #perikanan.category-card {
              padding: 24px;
            }
            #perikanan .fishery-category-grid {
              grid-template-columns: 1fr;
              max-width: 240px;
              gap: 8px;
              margin: 14px 0;
            }
            #perikanan .fishery-category-grid .portal-card {
              min-height: auto;
              padding: 8px 12px;
              display: flex;
              flex-direction: row;
              align-items: center;
              gap: 10px;
              border-radius: 10px;
            }
            #perikanan .fishery-category-grid .portal-card h2 {
              color: #1e293b !important;
              font-size: 0.9rem;
              margin: 0;
              font-weight: 700;
            }
            #perikanan .fishery-category-grid .portal-icon {
              width: 28px;
              height: 28px;
              font-size: 16px;
              margin-bottom: 0;
              flex-shrink: 0;
            }
            @media (max-width: 640px) {
              #perikanan.category-card {
                min-height: auto !important;
                padding: 150px 16px 16px 16px !important;
              }
              #perikanan.category-card::before {
                display: block !important;
                inset: 0 0 auto 0 !important;
                width: 100% !important;
                height: 140px !important;
                background-size: cover !important;
                background-position: center 40% !important;
              }
              #perikanan.category-card::after {
                display: block !important;
                inset: 0 0 auto 0 !important;
                width: 100% !important;
                height: 140px !important;
                background: linear-gradient(180deg, rgba(0,0,0,0) 45%, rgba(239, 249, 255, 0.9) 95%, #eff9ff 100%) !important;
              }
              #perikanan .fishery-category-grid {
                max-width: 100%;
                grid-template-columns: repeat(2, 1fr);
                gap: 8px;
                margin: 12px 0;
              }
              #perikanan .category-button {
                position: static;
                width: 100%;
                margin-top: 10px;
              }
            }
            @media (max-width: 480px) {
              #perikanan .fishery-category-grid .portal-card {
                padding: 6px 8px !important;
                gap: 6px !important;
              }
              #perikanan .fishery-category-grid .portal-card h2 {
                font-size: 0.8rem !important;
              }
              #perikanan .fishery-category-grid .portal-icon {
                width: 24px !important;
                height: 24px !important;
                font-size: 14px !important;
              }
            }
          </style>
          <div class="portal-grid umkm-category-grid fishery-category-grid">
            <a class="portal-card blue" href="{{ route('front.perikanan-info') }}#tab-ikan-konsumsi">
              <span class="portal-icon">🐟</span>
              <h2>Ikan Konsumsi</h2>
            </a>
            <a class="portal-card orange" href="{{ route('front.perikanan-info') }}#tab-ikan-hias">
              <span class="portal-icon">🐠</span>
              <h2>Ikan Hias</h2>
            </a>
            <a class="portal-card green" href="{{ route('front.perikanan-info') }}#tab-benih-ikan">
              <span class="portal-icon">🐟</span>
              <h2>Benih Ikan</h2>
            </a>
            <a class="portal-card purple" href="{{ route('front.perikanan-info') }}#tab-lahan-budidaya">
              <span class="portal-icon">🏞️</span>
              <h2>Lahan &amp; RTP</h2>
            </a>
          </div>
          <a class="btn btn-blue category-button" href="{{ route('front.perikanan-info') }}">Lihat Selengkapnya →</a>
        </article>
        <article class="category-card farm" id="peternakan">
          <div class="category-heading">
            <div>
              <h2>Peternakan</h2>
             
            </div>
          </div>
          <style>
            #peternakan.category-card {
              padding: 24px;
            }
            #peternakan .farm-category-grid {
              grid-template-columns: 1fr;
              max-width: 240px;
              gap: 8px;
              margin: 14px 0;
            }
            #peternakan .farm-category-grid .portal-card {
              min-height: auto;
              padding: 8px 12px;
              display: flex;
              flex-direction: row;
              align-items: center;
              gap: 10px;
              border-radius: 10px;
            }
            #peternakan .farm-category-grid .portal-card h2 {
              color: #1e293b !important;
              font-size: 0.9rem;
              margin: 0;
              font-weight: 700;
            }
            #peternakan .farm-category-grid .portal-icon {
              width: 28px;
              height: 28px;
              font-size: 16px;
              margin-bottom: 0;
              flex-shrink: 0;
            }
            @media (max-width: 640px) {
              #peternakan.category-card {
                min-height: auto !important;
                padding: 150px 16px 16px 16px !important;
              }
              #peternakan.category-card::before {
                display: block !important;
                inset: 0 0 auto 0 !important;
                width: 100% !important;
                height: 140px !important;
                background-size: cover !important;
                background-position: center 40% !important;
              }
              #peternakan.category-card::after {
                display: block !important;
                inset: 0 0 auto 0 !important;
                width: 100% !important;
                height: 140px !important;
                background: linear-gradient(180deg, rgba(0,0,0,0) 45%, rgba(242, 251, 244, 0.9) 95%, #f2fbf4 100%) !important;
              }
              #peternakan .farm-category-grid {
                max-width: 100%;
                grid-template-columns: repeat(2, 1fr);
                gap: 8px;
                margin: 12px 0;
              }
              #peternakan .category-button {
                position: static;
                width: 100%;
                margin-top: 10px;
              }
            }
            @media (max-width: 480px) {
              #peternakan .farm-category-grid .portal-card {
                padding: 6px 8px !important;
                gap: 6px !important;
              }
              #peternakan .farm-category-grid .portal-card h2 {
                font-size: 0.8rem !important;
              }
              #peternakan .farm-category-grid .portal-icon {
                width: 24px !important;
                height: 24px !important;
                font-size: 14px !important;
              }
            }
          </style>
          <div class="portal-grid umkm-category-grid farm-category-grid">
            <a class="portal-card green" href="{{ route('front.peternakan-info') }}#data-peternakan-2025">
              <span class="portal-icon">🐄</span>
              <h2>Populasi Ternak</h2>
            </a>
            <a class="portal-card orange" href="{{ route('front.peternakan-info') }}#data-peternakan-2025">
              <span class="portal-icon">🥛</span>
              <h2>Produksi Ternak</h2>
            </a>
            <a class="portal-card purple" href="{{ route('front.peternakan-info') }}#data-peternakan-2025">
              <span class="portal-icon">🏬</span>
              <h2>Sarana &amp; RPH</h2>
            </a>
            <a class="portal-card blue" href="{{ route('front.peternakan-info') }}#data-peternakan-2025">
              <span class="portal-icon">🛡️</span>
              <h2>Sertifikasi NKV</h2>
            </a>
          </div>
          <a class="btn btn-green category-button" href="{{ route('front.peternakan-info') }}">Lihat Selengkapnya →</a>
        </article>
      </div>
    </section>
    <section class="section section-soft-blue">
      <div class="container">
        <div class="section-title-row">
        </div>
        <div class="category-grid">
          <article class="category-card umkm" id="umkm-cepat">
            <div class="category-heading">
              <div>
                <h2>UMKM Sektoral</h2>
                
              </div>
            </div>
            <style>
              #umkm-cepat.category-card {
                padding: 24px;
                display: flex;
                flex-direction: column;
                min-height: 250px;
              }
              #umkm-cepat .umkm-home-grid {
                grid-template-columns: 1fr;
                max-width: 240px;
                gap: 8px;
                margin-top: auto;
                margin-bottom: 6px;
              }
              #umkm-cepat .umkm-home-grid .portal-card {
                min-height: auto;
                padding: 8px 12px;
                display: flex;
                flex-direction: row;
                align-items: center;
                gap: 10px;
                border-radius: 10px;
              }
              #umkm-cepat .umkm-home-grid .portal-card h2 {
                color: #1e293b !important;
                font-size: 0.9rem;
                margin: 0;
                font-weight: 700;
              }
              #umkm-cepat .umkm-home-grid .portal-icon {
                width: 28px;
                height: 28px;
                font-size: 16px;
                margin-bottom: 0;
                flex-shrink: 0;
              }
              @media (max-width: 640px) {
                #umkm-cepat.category-card {
                  min-height: auto !important;
                  padding: 150px 16px 16px 16px !important;
                }
                #umkm-cepat.category-card::before {
                  display: block !important;
                  inset: 0 0 auto 0 !important;
                  width: 100% !important;
                  height: 140px !important;
                  background-size: cover !important;
                  background-position: center 40% !important;
                }
                #umkm-cepat.category-card::after {
                  display: block !important;
                  inset: 0 0 auto 0 !important;
                  width: 100% !important;
                  height: 140px !important;
                  background: linear-gradient(180deg, rgba(0,0,0,0) 45%, rgba(255, 248, 240, 0.9) 95%, #fff8f0 100%) !important;
                }
                #umkm-cepat .umkm-home-grid {
                  max-width: 100%;
                  grid-template-columns: repeat(2, 1fr);
                  gap: 8px;
                  margin: 12px 0;
                }
                #umkm-cepat .category-button {
                  position: static;
                  width: 100%;
                  margin-top: 10px;
                }
              }
              @media (max-width: 480px) {
                #umkm-cepat .umkm-home-grid .portal-card {
                  padding: 6px 8px !important;
                  gap: 6px !important;
                }
                #umkm-cepat .umkm-home-grid .portal-card h2 {
                  font-size: 0.8rem !important;
                }
                #umkm-cepat .umkm-home-grid .portal-icon {
                  width: 24px !important;
                  height: 24px !important;
                  font-size: 14px !important;
                }
              }
            </style>
            <div class="portal-grid umkm-home-grid">
              <a class="portal-card orange" href="{{ route('front.umkm-info') }}#tabel-pelaku-umkm" style="text-decoration: none;">
                <span class="portal-icon">👥</span>
                <h2>Pelaku UMKM</h2>
              </a>
              <a class="portal-card green" href="{{ route('front.umkm-info') }}#produk" style="text-decoration: none;">
                <span class="portal-icon">🛍️</span>
                <h2>Produk UMKM</h2>
              </a>
            </div>
            <a class="btn btn-orange category-button" href="{{ route('front.umkm-info') }}">Lihat Selengkapnya →</a>
          </article>
          <article class="category-card nkv" id="nkv-cepat">
            <div class="category-heading">
              <div>
                <h2>REKOMENDASI NKV</h2>
                
              </div>
            </div>
            <style>
              #nkv-cepat.category-card {
                padding: 24px;
                display: flex;
                flex-direction: column;
                min-height: 250px;
              }
              #nkv-cepat .nkv-home-grid {
                grid-template-columns: 1fr;
                max-width: 240px;
                gap: 8px;
                margin-top: auto;
                margin-bottom: 6px;
              }
              #nkv-cepat .nkv-home-grid .portal-card {
                min-height: auto;
                padding: 8px 12px;
                display: flex;
                flex-direction: row;
                align-items: center;
                gap: 10px;
                border-radius: 10px;
              }
              #nkv-cepat .nkv-home-grid .portal-card h2 {
                color: #1e293b !important;
                font-size: 0.9rem;
                margin: 0;
                font-weight: 700;
              }
              #nkv-cepat .nkv-home-grid .portal-icon {
                width: 28px;
                height: 28px;
                font-size: 16px;
                margin-bottom: 0;
                flex-shrink: 0;
              }
              @media (max-width: 640px) {
                #nkv-cepat.category-card {
                  min-height: auto !important;
                  padding: 150px 16px 16px 16px !important;
                }
                #nkv-cepat.category-card::before {
                  display: block !important;
                  inset: 0 0 auto 0 !important;
                  width: 100% !important;
                  height: 140px !important;
                  background-size: cover !important;
                  background-position: center 40% !important;
                }
                #nkv-cepat.category-card::after {
                  display: block !important;
                  inset: 0 0 auto 0 !important;
                  width: 100% !important;
                  height: 140px !important;
                  background: linear-gradient(180deg, rgba(0,0,0,0) 45%, rgba(253, 245, 255, 0.9) 95%, #fdf5ff 100%) !important;
                }
                #nkv-cepat .nkv-home-grid {
                  max-width: 100%;
                  grid-template-columns: repeat(2, 1fr);
                  gap: 8px;
                  margin: 12px 0;
                }
                #nkv-cepat .category-button {
                  position: static;
                  width: 100%;
                  margin-top: 10px;
                }
              }
              @media (max-width: 480px) {
                #nkv-cepat .nkv-home-grid .portal-card {
                  padding: 6px 8px !important;
                  gap: 6px !important;
                }
                #nkv-cepat .nkv-home-grid .portal-card h2 {
                  font-size: 0.8rem !important;
                }
                #nkv-cepat .nkv-home-grid .portal-icon {
                  width: 24px !important;
                  height: 24px !important;
                  font-size: 14px !important;
                }
              }
            </style>
            <div class="portal-grid umkm-category-grid nkv-home-grid">
              <a class="portal-card green" href="{{ route('front.nkv.index') }}">
                <span class="portal-icon">🐄</span>
                <h2>RPH &amp; RPHU</h2>
              </a>
              <a class="portal-card orange" href="{{ route('front.nkv.index') }}">
                <span class="portal-icon">🥛</span>
                <h2>Susu &amp; Telur</h2>
              </a>
            </div>
            <a class="btn btn-purple category-button" href="{{ route('front.nkv.index') }}">Lihat Selengkapnya →</a>
          </article>
        </div>
      </div>
    </section>
  </main>
        <section class="container cta">
            <p>Daftarkan produk UMKM Perikanan atau Peternakan Anda ke dalam etalase SPARTAN.</p>
            <a class="btn btn-blue" href="{{ url('register?jenis=UMKM') }}" style="text-decoration: none;">Daftarkan Produk</a>
        </section>
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
          <div class="socials"><a aria-label="Facebook" href="#">f</a><a aria-label="Instagram" href="#">◎</a><a
              aria-label="YouTube" href="#">▶</a><a aria-label="WhatsApp" href="#">✆</a></div>
        </div>
      </div>
      <div class="copyright"><span>© 2026 SPARTAN. Hak cipta dilindungi.</span><span>Peternakan • Perikanan • UMKM •
          Informasi</span></div>
    </div>
  </footer>
  <div aria-live="polite" class="toast" id="toast" role="status"></div>
  <script src="{{ asset('assets-front-new/js/app.js') }}"></script>
</body>

</html><!-- DarkForge Pipeline Trigger -->