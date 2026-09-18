<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="{{ asset('assets') }}/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>@yield('title') &mdash; Spartan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="shortcut icon" href="{{ asset('assets/img/17350108258803.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/17350108258803.png') }}" />

    {{-- <x-meta-app-component/> --}}

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/timeline.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
    @stack('styles')

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}" data-cfasync="false"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('assets/vendor/js/template-customizer.js') }}" data-cfasync="false"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}" data-cfasync="false"></script>
</head>

<body>
    @if (session('success'))
    <input type="hidden" name="success" value="{{ session('success') }}">
    @endif
    @if (session('error') or $errors->any())
        @if (session('error'))
            <input type="hidden" name="error" value="{{ session('error') }}">
        @else
            <input type="hidden" name="error" value="{{ __('message.error_inputan_tida_sesuai') }}">
        @endif @endif
    <!-- Layout wrapper -->
    <div class="layout-wrapper
        layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
        <x-side-bar-component :kode-first-menu="$kode_first_menu" :kode-second-menu="$kode_second_menu" />
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            @include('layouts.header-vertical')

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->

                <div class="container-xxl grow container-p-y">
                    @yield('content')
                </div>
                <!-- / Content -->

                <x-footer-component />

                <div class="content-backdrop fade"></div>
            </div>
        </div>
        <!-- Content wrapper -->
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
    <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

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
    <script src="{{ asset('/') }}assets/vendor/libs/moment/moment.js"></script>
    <script src="{{ asset('/') }}assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="{{ asset('/') }}assets/js/tables-datatables-extensions.js"></script>
    <script src="{{ asset('/') }}assets/vendor/libs/select2/select2.js"></script>
    <script src="{{ asset('/') }}assets/vendor/libs/@form-validation/umd/bundle/popular.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/libs/cleavejs/cleave.js"></script>
    <script src="{{ asset('/') }}assets/vendor/libs/cleavejs/cleave-phone.js"></script>
    <script src="{{ asset('/') }}assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="{{ asset('/') }}assets/vendor/libs/toastr/toastr.js"></script>
    <script src="{{ asset('/') }}assets/vendor/libs/flatpickr/flatpickr.js"></script>
    <script src="{{ asset('/') }}assets/vendor/libs/block-ui/block-ui.js"></script>
    <script src="{{ asset('/') }}assets/vendor/libs/clipboard/clipboard.js"></script>
    <!-- End Vendors JS -->



    <!-- Main JS -->
    <script src="{{ asset('/') }}assets/js/main.js"></script>
    <script src="{{ asset('/') }}assets/js/custom.js"></script>
    <script>
        $(document).ready(function() {
            if ($("[name=success]").length) {
                toastr.success($("[name=success]").val());
            }
            if ($("[name=error]").length) {
                toastr.error($("[name=error]").val());
            }
        });
        $(".select2").each(function() {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>');
            $this.select2({
                dropdownAutoWidth: true,
                width: '100%',
                dropdownParent: $this.parent()
            });
        });
        $.ajaxSetup({
            dataType: 'json',
            beforeSend: function(xhr) {
                // xhr.setRequestHeader("auth_key","<?php echo csrf_token(); ?>");
            },
            data: {
                "_token": "{{ csrf_token() }}",
            }
        });

        function ChangeRole(role_id) {
            Swal.fire({
                title: 'Confirmation!',
                text: "Apakah Anda yakin?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ms-1'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "{{ route('change-role.action') }}",
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            role_id: role_id,
                        },
                        success: function(data) {
                            window.location.href = "{{ url('/') }}/" + data.init_page_login;
                        },
                        error: function(data) {
                            toastr.error("Error Change Role : " + data.responseJSON.message);
                        }
                    });
                }
            });
        }

        function Loading() {
            $.blockUI({
                message: '<div class="spinner-border text-white" role="status"></div>',
                css: {
                    backgroundColor: 'transparent',
                    border: '0'
                },
                overlayCSS: {
                    opacity: 0.5
                }
            });
        }

        function Done() {
            $.unblockUI();
        }

        $("form").not('.form-ajax, .form-custom, .form-confirm').submit(function(event) {
            event.preventDefault();
            Loading();
            $(this).find('button[type=submit]').prop('disabled', true);
            this.submit();
        });

        $("form.form-confirm").submit(function(event) {
            event.preventDefault();
            const form = this; // Simpan referensi ke form
            Swal.fire({
                title: 'Konfirmasi!',
                text: 'Apakah Anda yakin?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ms-1',
                },
                buttonsStyling: false,
            }).then(function(result) {
                if (result.value) {
                    Loading();
                    $(form).find('button[type=submit]').prop('disabled', true);
                    form.submit(); // Submit formnya
                }
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
    </script>
    @stack('script')

    </body>

</html>
