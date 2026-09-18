<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-wide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('/') }}assets/" data-template="front-pages">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title') &mdash; | Spartan</title>

    <meta name="description" content="@yield('meta_description')" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/17350108258803.png') }}" />

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/17350108258803.png') }}">

    <!-- Android Chrome Icons -->
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/img/17350108258803.png') }}">
    <link rel="icon" type="image/png" sizes="256x256" href="{{ asset('assets/img/17350108258803.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('assets/img/17350108258803.png') }}">

    <!-- Windows Tile Image -->
    <meta name="msapplication-TileImage" content="{{ asset('assets/img/17350108258803.png') }}">
    <meta name="msapplication-TileColor" content="#ffffff">

    <!-- Safari Pinned Tab -->
    <link rel="mask-icon" href="{{ asset('assets/img/17350108258803.png') }}" color="#5bbad5">

    <!-- OG Image (For Social Media Sharing) -->
    <meta property="og:image" content="{{ asset('assets/img/17350108258803.png') }}">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('meta_description')">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="{{ asset('assets/img/17350108258803.png') }}">
    <meta name="twitter:title" content="@yield('title')">
    <meta name="twitter:description" content="@yield('meta_description')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/fonts/tabler-icons.css" />

    {{-- maps --}}

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/css/rtl/core.css"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/css/rtl/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/demo.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/css/pages/front-page.css" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/libs/node-waves/node-waves.css" />

    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/libs/nouislider/nouislider.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/libs/swiper/swiper.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/libs/select2/select2.css" />

    <!-- Page CSS -->

    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/css/pages/front-page-landing.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/custom-frontend.css" />

    @stack('styles')

    <!-- Helpers -->

    <script src="{{ asset('/') }}assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('/') }}assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('/') }}assets/js/front-config.js"></script>
</head>

<body class="front-page">
    <script src="{{ asset('/') }}assets/vendor/js/dropdown-hover.js"></script>
    <script src="{{ asset('/') }}assets/vendor/js/mega-dropdown.js"></script>

    @include('layouts.front.header')

    <div data-bs-spy="scroll" class="scrollspy-example">
        @yield('content')
    </div>

    @include('layouts.front.footer')


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('/') }}assets/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('/') }}assets/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('/') }}assets/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('/') }}assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="{{ asset('/') }}assets/vendor/libs/select2/select2.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('/') }}assets/vendor/libs/nouislider/nouislider.js"></script>
    <script src="{{ asset('/') }}assets/vendor/libs/swiper/swiper.js"></script>

    <!-- Main JS -->
    <script src="{{ asset('/') }}assets/js/front-main.js"></script>

    <!-- Page JS -->
    <script src="{{ asset('/') }}assets/js/front-page-landing.js"></script>
    @stack('script')
    <script>
        $(".select2").each(function() {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>');
            $this.select2({
                dropdownAutoWidth: true,
                width: '100%',
                dropdownParent: $this.parent()
            });
        });
    </script>
    <style>
        .landing-hero .hero-title {
            /* background: #55b9c8 ; */
        }

        .light-style .layout-navbar .navbar.landing-navbar {
            border-color: transparent;
            background: transparent;
        }

        .landing-hero {
            border-radius: 0;
        }

        .landing-reviews {
            border-radius: 0 !important;
        }

        .light-style .landing-hero {
            background: linear-gradient(138.18deg, #e8fdf6 0%, #e5effc 94.44%);
        }
    </style>
</body>

</html>
