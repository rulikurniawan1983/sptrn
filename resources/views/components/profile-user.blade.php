@php
    $auth_user = auth()->user();
@endphp
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm mb-4">
            <div class="user-profile-header-banner">
                <img src="{{ asset('/') }}assets/img/pages/profile-banner.png" alt="Banner image" class="rounded-top"
                    loading="lazy" />
            </div>
            <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                <div class="shrink-0 mt-n2 mx-sm-0 mx-auto">
                    <img src="{{ $auth_user->file_url }}" alt="user image"
                        class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" loading="lazy" />
                </div>
                <div class="grow mt-3 mt-sm-5">
                    <div
                        class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                        <div class="user-profile-info">
                            <h4>{{ $auth_user->name }}</h4>
                            <ul
                                class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                <li class="list-inline-item d-flex gap-1">
                                    <i class="ti ti-calendar"></i> Joined
                                    {{ set_date($auth_user->created_at, 'd F Y') }}
                                </li>
                            </ul>
                        </div>
                        {{-- <a href="javascript:void(0)" class="btn btn-primary">
                            <i class="ti ti-edit me-1"></i>Edit Profile
                        </a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Header -->

<!-- Navbar pills -->
<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-sm-row mb-4">
            <li class="nav-item">
                <a class="nav-link {{ @$activeTab == 'Profile' ? 'active' : null }}"
                    href="{{ route('profile.index') }}"><i class="ti-xs ti ti-user-check me-1"></i>
                    Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ @$activeTab == 'Edit Profile' ? 'active' : null }}"
                    href="{{ route('profile.edit') }}"><i class="ti-xs ti ti-lock me-1"></i> Edit Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ @$activeTab == 'Change Password' ? 'active' : null }}"
                    href="{{ route('profile.ganti-password') }}"><i class="ti-xs ti ti-lock me-1"></i> Change
                    Password</a>
            </li>
        </ul>
    </div>
</div>
<!--/ Navbar pills -->

<!-- User Profile Content -->
<div class="row">
    <div class="col-xl-4 col-lg-5 col-md-5">
        <!-- About User -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <small class="card-text text-uppercase">About</small>
                <ul class="list-unstyled mb-4 mt-3">
                    <li class="d-flex align-items-center mb-3 gap-2">
                        <span class="fw-medium text-heading">Nama:</span> <span>{{ $auth_user->name }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3 gap-2">
                        <span class="fw-medium text-heading">Status:</span>
                        <span>{!! $auth_user->is_active_badge !!}</span>
                    </li>
                    {{-- <li class="d-flex align-items-center mb-3 gap-2">
                            <span class="fw-medium text-heading">Pekerjaan:</span>
                            <span>{{$auth_user->pekerjaan}}</span>
                        </li> --}}
                </ul>
                <small class="card-text text-uppercase">Contacts</small>
                <ul class="list-unstyled mb-4 mt-3">
                    {{-- <li class="d-flex align-items-center mb-3 gap-2">
                            <span class="fw-medium text-heading">Country:</span>
                            <span>{{$auth_user->country->name}}</span>
                        </li> --}}
                    <li class="d-flex align-items-center mb-3 gap-2">
                        <span class="fw-medium text-heading">Contact:</span>
                        <span>{{ $auth_user->no_hp }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3 gap-2">
                        <span class="fw-medium text-heading">Email:</span>
                        <span>{{ $auth_user->email }}</span>
                    </li>
                    {{-- <li class="d-flex align-items-center mb-3 gap-2">
                            <span class="fw-medium text-heading">Alamat di Indonesia:</span>
                            <span>{{$auth_user->alamat_indonesia}}</span>
                        </li>
                        <li class="d-flex align-items-center mb-3 gap-2">
                            <span class="fw-medium text-heading">Alamat di Luar Negeri:</span>
                            <span>{{$auth_user->alamat_luar}}</span>
                        </li> --}}
                </ul>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <p class="card-text text-uppercase">Overview</p>
                <ul class="list-unstyled mb-0">
                    <li class="d-flex align-items-center mb-3 gap-2">
                        <span class="fw-medium">Role Active:</span>
                        <span>{{ $auth_user->role->name }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3 gap-2">
                        <span class="fw-medium">Roles:</span>
                        @foreach ($auth_user->users_role as $value)
                            <span class="badge bg-success">
                                {{ $value->role->name }}
                            </span>
                        @endforeach
                    </li>
                    <li class="d-flex align-items-center mb-3 gap-2">
                        <span class="fw-medium">Updated At:</span>
                        <span>{{ $auth_user->updated_at }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-xl-8 col-lg-7 col-md-7">

        {{ $slot }}
        <!-- Activity Timeline -->
    </div>
</div>
