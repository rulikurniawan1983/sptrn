<!-- Navbar: Start -->
<nav class="layout-navbar shadow-none py-0 navbar-active" id="main-navbar">
    <div class="container">
        <div class="navbar navbar-expand-lg landing-navbar px-3 px-md-4">
            <!-- Menu logo wrapper: Start -->
            <div class="navbar-brand app-brand demo d-flex py-0 py-lg-2 me-4">
                <!-- Mobile menu toggle: Start-->
                <button class="navbar-toggler border-0 px-0 me-2" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="ti ti-menu-2 ti-sm align-middle"></i>
                </button>
                <!-- Mobile menu toggle: End-->
                <a href="{{ url('/') }}" class="app-brand-link">
                    <span class="d-none d-sm-block">
                        <img src="{{ asset('assets/img/17350108258803.png') }}" alt="" width="100">
                    </span>
                </a>
            </div>
            <!-- Menu logo wrapper: End -->
            <!-- Menu wrapper: Start -->
            <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
                <button class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl"
                    type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="ti ti-x ti-sm"></i>
                </button>
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="#section-hero">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="#section-maps">Peta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="#section-harga-pasar">Harga Pasar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="#section-rekomendasi">Rekomendasi NKV & Data UMKM</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="#section-produksi-populasi">Produksi & Populasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="#section-dokter-upt">Dokter Hewan & UPT Puskeswan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="#section-chart">Statistik & Grafik</a>
                    </li>
                </ul>
            </div>
            <div class="landing-menu-overlay d-lg-none"></div>
            <!-- Menu wrapper: End -->
            <!-- Toolbar: Start -->
            <ul class="navbar-nav flex-row align-items-center ms-auto">

                <!-- / Style Switcher-->

                <!-- navbar button: Start -->
                <li>
                    <a href="{{ route('dashboard.index') }}" class="btn btn-dark">
                        <span class="tf-icons ti ti-login scaleX-n1-rtl me-md-1"></span><span
                            class="">Masuk</span></a>
                </li>
                <!-- navbar button: End -->
            </ul>
            <!-- Toolbar: End -->
        </div>
    </div>
</nav>
<!-- Navbar: End -->
