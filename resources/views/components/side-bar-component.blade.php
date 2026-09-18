<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{url('/')}}" class="app-brand-link">
            <img src="{{asset('assets/img/17350108258803.png')}}" alt="Logo " width="100"  loading="lazy">
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @can("Profile Change Role")
            @if (count($auth->users_role) > 1)
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">My Role </span>
                </li>
                <li class="menu-item px-3">
                    <div class="btn-group w-100">
                        <button
                        type="button"
                        class="btn btn-primary dropdown-toggle"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{$auth->role->name}}
                        </button>
                        <ul class="dropdown-menu">
                            @foreach ($auth->users_role as $item)
                                @if ($auth->current_role_id != $item->role_id)
                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="ChangeRole({{$item->role_id}})">{{$item->role->name}}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endif
        @endcan
        <!-- Apps & Pages -->
        @php
            $umkmRoles = [101, 102];
        @endphp
        @foreach ($get_UsersMenu->sortBy(["urutan", "asc"]) as $sidebar)
            @can($sidebar->permission->name)
                @if($sidebar->kode == 'KELOLA-PERIZINAN-SIDEBAR')
                    @if(in_array($auth->current_role_id, $umkmRoles))
                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text">{{$sidebar->nama}}</span>
                        </li>
                        @foreach ($sidebar->children->sortBy(["urutan", "asc"]) as $item)
                            @if ($item->url != "#")
                                @if (@$item->permission->name != "")
                                    @can($item->permission->name)
                                        <li class="menu-item {{(@$kodeFirstMenu == $item->kode) ? 'active' : null}}">
                                            <a href="{{url($item->url)}}" class="menu-link">
                                                {!! str_replace('<i class="', '<i class="menu-icon tf-icons ', $item->icon) !!}
                                                <div data-i18n="{{$item->nama}}">{{$item->nama}}</div>
                                                @if($item->url == 'rekomendasi-nkv')
                                                    @php $newNkvCount = \App\Models\RekomendasiNkv::where('is_read', 0)->count(); @endphp
                                                    @if($newNkvCount > 0)
                                                        <div class="badge bg-danger rounded-pill ms-auto">{{ $newNkvCount }}</div>
                                                    @endif
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                @endif
                            @endif
                        @endforeach
                    @endif
                @else
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">{{$sidebar->nama}}</span>
                    </li>
                    @foreach ($sidebar->children->sortBy(["urutan", "asc"]) as $item)
                        @if ($item->url != "#")
                            @if (@$item->permission->name != "")
                                @can($item->permission->name)
                                    <li class="menu-item {{(@$kodeFirstMenu == $item->kode) ? 'active' : null}}">
                                        <a href="{{url($item->url)}}" class="menu-link">
                                            {!! str_replace('<i class="', '<i class="menu-icon tf-icons ', $item->icon) !!}
                                            <div data-i18n="{{$item->nama}}">{{$item->nama}}</div>
                                            @if($item->url == 'rekomendasi-nkv')
                                                @php $newNkvCount = \App\Models\RekomendasiNkv::where('is_read', 0)->count(); @endphp
                                                @if($newNkvCount > 0)
                                                    <div class="badge bg-danger rounded-pill ms-auto">{{ $newNkvCount }}</div>
                                                @endif
                                            @endif
                                            @if($item->url == 'user-umkm')
                                                @php
                                                    $pendingUmkmCount = \App\Models\User::where('is_active', 0)->whereHas('users_role', function($q) { $q->whereIn('role_id', [101, 102]); })->count();
                                                @endphp
                                                @if($pendingUmkmCount > 0)
                                                    <div class="badge bg-danger rounded-pill ms-auto">{{ $pendingUmkmCount }}</div>
                                                @endif
                                            @endif
                                        </a>
                                    </li>
                                @endcan
                            @endif
                        @endif
                    @endforeach
                @endif
            @endcan
        @endforeach

    </ul>
</aside>
