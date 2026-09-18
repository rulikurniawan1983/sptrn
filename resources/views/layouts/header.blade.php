@php
    $auth_user = Auth::user();
@endphp
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="ti ti-menu-2 ti-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

        <div class="navbar-nav align-items-center">
            <div class="nav-item navbar-search-wrapper mb-0">
                {{-- <span style="font-size:15pt;">Spartan</span> --}}
                {{-- <a class="nav-item nav-link search-toggler d-flex align-items-center px-0"
                href="javascript:void(0);">
                <i class="ti ti-search ti-md me-2"></i>
                <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
            </a> --}}
            </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">

        <!-- Notification Dropdown -->
        @php
            $auth_user = Auth::user();
            $isUmkm = $auth_user && in_array($auth_user->current_role_id, [101, 102]);
            
            if ($isUmkm) {
                $productNotifications = \App\Models\UmkmProduct::where('user_id', $auth_user->id)
                    ->where('is_active', 0)
                    ->latest()
                    ->take(5)
                    ->get();
                $pendingProductTotal = \App\Models\UmkmProduct::where('user_id', $auth_user->id)
                    ->where('is_active', 0)
                    ->count();
                $activeProductTotal = \App\Models\UmkmProduct::where('user_id', $auth_user->id)
                    ->where('is_active', 1)
                    ->count();
            } else {
                $pendingUmkmList = \App\Models\User::where('is_active', 0)
                    ->whereHas('users_role', function($q) { $q->whereIn('role_id', [101, 102]); })
                    ->latest()
                    ->take(5)
                    ->get();
                $pendingUmkmTotal = \App\Models\User::where('is_active', 0)
                    ->whereHas('users_role', function($q) { $q->whereIn('role_id', [101, 102]); })
                    ->count();
            }
        @endphp
        <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-2">
            <a class="nav-link dropdown-toggle hide-arrow position-relative" href="javascript:void(0);" 
               data-bs-toggle="dropdown" data-bs-auto-close="outside"
               aria-expanded="false">
                <i class="ti ti-bell ti-md"></i>
                @if($isUmkm)
                    @if($pendingProductTotal > 0)
                        <span class="badge bg-warning rounded-pill badge-notifications position-absolute" style="top: -2px; right: -2px; font-size: 10px; padding: 2px 5px;">
                            {{ $pendingProductTotal }}
                        </span>
                    @elseif($activeProductTotal > 0)
                        <span class="badge bg-success rounded-pill badge-notifications position-absolute" style="top: -2px; right: -2px; font-size: 10px; padding: 2px 5px;">
                            {{ $activeProductTotal }}
                        </span>
                    @endif
                @else
                    @if($pendingUmkmTotal > 0)
                        <span class="badge bg-danger rounded-pill badge-notifications position-absolute" style="top: -2px; right: -2px; font-size: 10px; padding: 2px 5px;">
                            {{ $pendingUmkmTotal }}
                        </span>
                    @endif
                @endif
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 py-0" style="min-width: 320px; max-width: 380px;">
                @if($isUmkm)
                    <li class="dropdown-menu-header border-bottom">
                        <div class="dropdown-header d-flex align-items-center py-3">
                            <h6 class="text-body mb-0 me-auto fw-bold"><i class="ti ti-bell me-1 text-primary"></i> Notifikasi Produk</h6>
                            @if($pendingProductTotal > 0)
                                <span class="badge bg-label-warning rounded-pill">{{ $pendingProductTotal }} Menunggu</span>
                            @elseif($activeProductTotal > 0)
                                <span class="badge bg-label-success rounded-pill">{{ $activeProductTotal }} Tayang</span>
                            @endif
                        </div>
                    </li>
                    <li class="dropdown-notifications-list scrollable-container" style="max-height: 350px; overflow-y: auto;">
                        <ul class="list-group list-group-flush">
                            @forelse($productNotifications as $product)
                                <li class="list-group-item list-group-item-action dropdown-notifications-item p-3 border-bottom">
                                    <a href="{{ route('umkm-product.show', $product->id) }}" class="d-flex gap-3 text-decoration-none text-body">
                                        <div class="shrink-0">
                                            <div class="avatar">
                                                <span class="avatar-initial rounded-circle bg-label-warning">
                                                    <i class="ti ti-clock-hour-4"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="grow">
                                            <h6 class="mb-1 small fw-semibold text-primary">{{ $product->nama_produk }}</h6>
                                            <small class="text-muted d-block mb-1">
                                                <i class="ti ti-price-tag me-1"></i>Rp {{ number_format($product->harga, 0, ',', '.') }} / {{ $product->satuan }}
                                            </small>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="badge bg-label-warning" style="font-size: 10px;">Menunggu Verifikasi</span>
                                                <small class="text-muted" style="font-size: 10px;">{{ $product->created_at ? \Carbon\Carbon::parse($product->created_at)->diffForHumans() : '-' }}</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li class="list-group-item text-center py-4 text-muted">
                                    <i class="ti ti-check ti-md d-block mb-1 text-success"></i>
                                    <small>Tidak ada produk yang menunggu verifikasi</small>
                                </li>
                            @endforelse
                        </ul>
                    </li>
                    @if($pendingProductTotal > 0 || $activeProductTotal > 0)
                    <li class="dropdown-menu-footer border-top p-2 text-center">
                        <a href="{{ route('umkm-product.index') }}" class="btn btn-primary btn-sm w-100 d-flex justify-content-center align-items-center gap-1">
                            <i class="ti ti-list ti-xs"></i> <span>Lihat Semua Produk</span>
                        </a>
                    </li>
                    @endif
                @else
                    <li class="dropdown-menu-header border-bottom">
                        <div class="dropdown-header d-flex align-items-center py-3">
                            <h6 class="text-body mb-0 me-auto fw-bold"><i class="ti ti-bell me-1 text-primary"></i> Notifikasi Pendaftaran</h6>
                            @if($pendingUmkmTotal > 0)
                                <span class="badge bg-label-danger rounded-pill">{{ $pendingUmkmTotal }} Baru</span>
                            @endif
                        </div>
                    </li>
                    <li class="dropdown-notifications-list scrollable-container" style="max-height: 350px; overflow-y: auto;">
                        <ul class="list-group list-group-flush">
                            @forelse($pendingUmkmList as $itemUmkm)
                                <li class="list-group-item list-group-item-action dropdown-notifications-item p-3 border-bottom">
                                    <a href="{{ route('user-umkm.show', $itemUmkm->id) }}" class="d-flex gap-3 text-decoration-none text-body">
                                        <div class="shrink-0">
                                            <div class="avatar">
                                                <span class="avatar-initial rounded-circle bg-label-warning">
                                                    <i class="ti ti-building-store"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="grow">
                                            <h6 class="mb-1 small fw-semibold text-primary">{{ $itemUmkm->name }}</h6>
                                            <small class="text-muted d-block mb-1">
                                                <i class="ti ti-id me-1"></i>NIB: {{ $itemUmkm->email }}
                                            </small>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="badge bg-label-danger" style="font-size: 10px;">Menunggu Verifikasi</span>
                                                <small class="text-muted" style="font-size: 10px;">{{ $itemUmkm->created_at ? \Carbon\Carbon::parse($itemUmkm->created_at)->diffForHumans() : '-' }}</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li class="list-group-item text-center py-4 text-muted">
                                    <i class="ti ti-bell-off ti-md d-block mb-1 text-secondary"></i>
                                    <small>Tidak ada pendaftar UMKM baru yang menunggu verifikasi</small>
                                </li>
                            @endforelse
                        </ul>
                    </li>
                    <li class="dropdown-menu-footer border-top p-2 text-center">
                        <a href="{{ route('user-umkm.index') }}" class="btn btn-primary btn-sm w-100 d-flex justify-content-center align-items-center gap-1">
                            <i class="ti ti-users-group ti-xs"></i> <span>Buka Monitoring User UMKM</span>
                        </a>
                    </li>
                @endif
            </ul>
        </li>

            <!-- Style Switcher -->
            <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <i class="ti ti-md"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                            <span class="align-middle"><i class="ti ti-sun me-2"></i>Light</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                            <span class="align-middle"><i class="ti ti-moon me-2"></i>Dark</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                            <span class="align-middle"><i class="ti ti-device-desktop me-2"></i>System</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- / Style Switcher-->

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        {!! @$auth_user->file_url_image !!}

                        {{-- <img src="{{ asset('/') }}assets/img/avatars/1.png" alt class="h-auto rounded-circle" /> --}}
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="">
                            <div class="d-flex">
                                <div class="shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        {!! @$auth_user->file_url_image !!}
                                        {{-- <img src="{{ asset('/') }}assets/img/avatars/1.png" alt
                                            class="h-auto rounded-circle" /> --}}
                                    </div>
                                </div>
                                <div class="grow">
                                    <span class="fw-medium d-block">{{ @$auth_user->name }}</span>
                                    <small class="text-muted">{{ @$auth_user->role->name }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    @can('Profile Show')
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.index') }}">
                                <i class="ti ti-user-check me-2 ti-sm"></i>
                                <span class="align-middle">My Profile</span>
                            </a>
                        </li>
                    @endcan
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:;"
                            onclick="event.preventDefault(); document.getElementById('form-logout').submit();">
                            <i class="ti ti-logout me-2 ti-sm"></i>
                            <span class="align-middle">Log Out</span>
                            {!! html()->form()->method('POST')->route('auth.logout')->id('form-logout') !!}
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>
