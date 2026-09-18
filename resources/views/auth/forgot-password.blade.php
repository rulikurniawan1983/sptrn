<!DOCTYPE html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('/') }}assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Lupa Password - UP4DSDA</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/17350108258803.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/css/rtl/core.css"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/css/rtl/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/libs/typeahead-js/typeahead.css" />
    <!-- Vendor -->
    <link rel="stylesheet"
        href="{{ asset('/') }}assets/vendor/libs/@form-validation/umd/styles/index.min.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="{{ asset('/') }}assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('/') }}assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('/') }}assets/js/config.js"></script>
</head>

<body>
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Forgot Password -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-1 pt-2">Lupa Password? 🔒</h4>
                        <p class="mb-4">Masukkan email Anda dan kami akan mengirimkan instruksi untuk mengatur ulang
                            kata sandi Anda</p>
                        @if (session('error'))
                            <div class="alert alert-danger">
                                <div>{{ session('error') }}</div>
                            </div>
                        @endif    
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li> @endforeach
                            </ul>
                        </div> 
                        @endif
                        @if (session('success'))
                            <div class="alert
        alert-success">
    <div>{{ session('success') }}</div>
    </div>
    @endif

    {{ html()->form('POST', route('password.email'))->class('mb-3')->attribute('enctype', 'multipart/form-data')->id('form')->open() }}
    <x-form-input name="email" label="Email" :horizontal="false" autofocus required placeholder="Masukkan Email"
        tabindex="1" />
    <button id="submitButton" type="submit" tabindex="2" class="btn btn-primary d-grid w-100">Kirim</button>
    {{ html()->form()->close() }}
    <div class="text-center">
        <a href="{{ route('login') }}" tabindex="3" class="d-flex align-items-center justify-content-center">
            <i class="ti ti-chevron-left scaleX-n1-rtl"></i>
            Kembali ke Login
        </a>
    </div>
    </div>
    </div>
    <!-- /Forgot Password -->
    </div>
    </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="{{ asset('/') }}assets/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('/') }}assets/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('/') }}assets/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('/') }}assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="{{ asset('/') }}assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{ asset('/') }}assets/vendor/libs/hammer/hammer.js"></script>
    <script src="{{ asset('/') }}assets/vendor/libs/i18n/i18n.js"></script>
    <script src="{{ asset('/') }}assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="{{ asset('/') }}assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('/') }}assets/vendor/libs/@form-validation/umd/bundle/popular.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js"></script>

    <!-- Main JS -->
    <script src="{{ asset('/') }}assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="{{ asset('/') }}assets/js/pages-auth.js"></script>
    <script src="{{ asset('/') }}assets/js/custom.js"></script>
    </body>

</html>
