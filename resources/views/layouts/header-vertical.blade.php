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

    <div class="navbar-nav-right d-flex align-items-center w-100" id="navbar-collapse">

        <div class="navbar-nav align-items-center grow">
            <div class="nav-item navbar-search-wrapper mb-0">
            </div>
        </div>

        <ul class="navbar-nav flex-row align-items-center gap-2">

            <li class="nav-item">
                <a href="{{ url('/') }}" class="btn btn-sm btn-outline-primary rounded-pill px-4 d-flex align-items-center gap-2">
                    <i class="ti ti-home ti-sm"></i>
                    <span class="d-none d-md-inline">Beranda</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('faq.index') }}" class="btn btn-sm btn-outline-info rounded-pill px-4 d-flex align-items-center gap-2">
                    <i class="ti ti-help ti-sm"></i>
                    <span class="d-none d-md-inline">FAQ</span>
                </a>
            </li>

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
                <a class="nav-link p-2 rounded-circle dropdown-toggle hide-arrow position-relative" href="javascript:void(0);" 
                   data-bs-toggle="dropdown" data-bs-auto-close="outside"
                   aria-expanded="false"
                   style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                    <i class="ti ti-bell ti-sm"></i>
                    @if($isUmkm)
                        @if($pendingProductTotal > 0)
                            <span class="badge bg-warning rounded-pill badge-notifications position-absolute" style="top: 2px; right: 2px; font-size: 10px; padding: 2px 5px;">
                                {{ $pendingProductTotal }}
                            </span>
                        @elseif($activeProductTotal > 0)
                            <span class="badge bg-success rounded-pill badge-notifications position-absolute" style="top: 2px; right: 2px; font-size: 10px; padding: 2px 5px;">
                                {{ $activeProductTotal }}
                            </span>
                        @endif
                    @else
                        @if($pendingUmkmTotal > 0)
                            <span class="badge bg-danger rounded-pill badge-notifications position-absolute" style="top: 2px; right: 2px; font-size: 10px; padding: 2px 5px;">
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

            <li class="nav-item dropdown-style-switcher dropdown">
                <a class="nav-link p-2 rounded-circle dropdown-toggle hide-arrow" href="javascript:void(0);" 
                   data-bs-toggle="dropdown"
                   style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                    <i class="ti ti-palette ti-sm"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-styles shadow-lg border-0" style="min-width: 180px;">
                    <li class="dropdown-header text-uppercase small fw-semibold text-muted px-3 py-2">
                        Tema Tampilan
                    </li>
                    <li>
                        <a class="dropdown-item rounded mx-2 my-1 d-flex align-items-center gap-2" href="javascript:void(0);" data-theme="light">
                            <i class="ti ti-sun"></i>
                            <span>Light Mode</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item rounded mx-2 my-1 d-flex align-items-center gap-2" href="javascript:void(0);" data-theme="dark">
                            <i class="ti ti-moon"></i>
                            <span>Dark Mode</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item rounded mx-2 my-1 d-flex align-items-center gap-2" href="javascript:void(0);" data-theme="system">
                            <i class="ti ti-device-desktop"></i>
                            <span>System</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="d-flex align-items-center gap-2 px-2 py-1 rounded-pill" 
                         style="background: rgba(var(--bs-primary-rgb), 0.1); border: 1px solid rgba(var(--bs-primary-rgb), 0.2);">
                        <div class="avatar avatar-online avatar-sm">
                            {!! @$auth_user->file_url_image !!}
                        </div>
                        <div class="d-none d-md-block">
                            <span class="fw-semibold small text-body">{{ @$auth_user->name }}</span>
                        </div>
                        <i class="ti ti-chevron-down ti-xs d-none d-md-inline"></i>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0" style="min-width: 280px;">
                    <li class="px-3 py-3 bg-light">
                        <div class="d-flex align-items-start gap-3">
                            <div class="avatar avatar-online">
                                {!! @$auth_user->file_url_image !!}
                            </div>
                            <div class="grow">
                                <h6 class="mb-0 fw-semibold">{{ @$auth_user->name }}</h6>
                                <small class="text-muted">{{ @$auth_user->role->name }}</small>
                                <div class="mt-1">
                                    <span class="badge bg-label-primary rounded-pill small">Active</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    <li>
                        <div class="dropdown-divider my-2"></div>
                    </li>
                    
                    @can('Profile Show')
                        <li>
                            <a class="dropdown-item rounded mx-2 my-1 d-flex align-items-center gap-3" 
                               href="{{ route('profile.index') }}">
                                <div class="d-flex align-items-center justify-content-center" 
                                     style="width: 32px; height: 32px; background: rgba(var(--bs-primary-rgb), 0.1); border-radius: 8px;">
                                    <i class="ti ti-user-check ti-sm text-primary"></i>
                                </div>
                                <div>
                                    <div class="fw-medium">My Profile</div>
                                    <small class="text-muted">Kelola profil Anda</small>
                                </div>
                            </a>
                        </li>
                    @endcan
                    
                    <li>
                        <a class="dropdown-item rounded mx-2 my-1 d-flex align-items-center gap-3" 
                           href="javascript:void(0);">
                            <div class="d-flex align-items-center justify-content-center" 
                                 style="width: 32px; height: 32px; background: rgba(var(--bs-info-rgb), 0.1); border-radius: 8px;">
                                <i class="ti ti-settings ti-sm text-info"></i>
                            </div>
                            <div>
                                <div class="fw-medium">Pengaturan</div>
                                <small class="text-muted">Preferensi akun</small>
                            </div>
                        </a>
                    </li>
                    
                    <li>
                        <div class="dropdown-divider my-2"></div>
                    </li>
                    
                    <li>
                        <a class="dropdown-item rounded mx-2 my-1 d-flex align-items-center gap-3 text-danger" 
                           href="javascript:;"
                           onclick="event.preventDefault(); document.getElementById('form-logout').submit();">
                            <div class="d-flex align-items-center justify-content-center" 
                                 style="width: 32px; height: 32px; background: rgba(var(--bs-danger-rgb), 0.1); border-radius: 8px;">
                                <i class="ti ti-logout ti-sm"></i>
                            </div>
                            <div>
                                <div class="fw-medium">Log Out</div>
                                <small class="opacity-75">Keluar dari akun</small>
                            </div>
                            {!! html()->form()->method('POST')->route('auth.logout')->id('form-logout') !!}
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<style>
    #layout-navbar {
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .nav-link, .dropdown-item {
        transition: all 0.2s ease-in-out;
    }

    .nav-link:hover {
        background: rgba(var(--bs-primary-rgb), 0.08);
        transform: translateY(-1px);
    }

    .dropdown-item:hover {
        background: rgba(var(--bs-primary-rgb), 0.08);
        transform: translateX(4px);
    }

    .avatar {
        border: 2px solid rgba(var(--bs-primary-rgb), 0.2);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .dropdown-menu {
        border-radius: 12px;
        padding: 0.5rem;
        margin-top: 0.5rem;
        animation: slideDown 0.2s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .btn-outline-primary.rounded-pill {
        transition: all 0.3s ease;
        border-width: 1.5px;
    }

    .btn-outline-primary.rounded-pill:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(var(--bs-primary-rgb), 0.3);
    }

    .badge.rounded-pill {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
    }
</style>