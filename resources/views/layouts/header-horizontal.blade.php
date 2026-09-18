@php
    $auth_user = Auth::user();
@endphp
<nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="container-xxl">
        <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">

            <a href="{{ url('/') }}" class="app-brand-link">
                <img src="{{ asset('assets/img/17350108258803.png') }}" alt="Logo " width="100" loading="lazy">
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
                <i class="ti ti-x ti-sm align-middle"></i>
            </a>
        </div>

        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="ti ti-menu-2 ti-sm"></i>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <ul class="navbar-nav flex-row align-items-center ms-auto">

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

        <div class="navbar-search-wrapper search-input-wrapper container-xxl d-none">
            <input type="text" class="form-control search-input border-0" placeholder="Search..."
                aria-label="Search..." />
            <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
        </div>
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
