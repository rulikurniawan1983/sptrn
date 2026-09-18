<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-sm-row mb-4">
            <li class="nav-item">
                <a class="nav-link {{ @$activeTab == 'form' ? 'active' : null }}"
                    href="{{ @$item->id ? route($route . '.edit', @$item->id ?? null) : route($route . '.create') }}"><i
                        class="ti-xs ti ti-user-check me-1"></i> Data UMKM</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'form-pengusaha' ? 'active' : null }}"
                    href="{{ @$item->id ? route($route . '.edit', $item->id) . '?section=pengusaha' : null }}">
                    Pengusaha</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null}} {{ @$activeTab == 'form-perizinan' ? 'active' : null }}"
                    href="{{ (@$item->id) ? route($route.'.edit', $item->id).'?section=perizinan' : null }}"> Data Perizinan</a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'Umkm Perizinan' ? 'active' : null }}"
                    href="{{ @$item->id ? route('umkm-perizinan.index', ['id_umkm' => $item->id]) : null }}"> Umkm
                    Perizinan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'Umkm Lembaga Pembina' ? 'active' : null }}"
                    href="{{ @$item->id ? route('umkm-lembaga-pembina.index', ['id_umkm' => $item->id]) : null }}">
                    Lembaga Pembina</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'Umkm Pameran' ? 'active' : null }}"
                    href="{{ @$item->id ? route('umkm-pameran.index', ['id_umkm' => $item->id]) : null }}">
                    Pemeran</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'Umkm Produk' ? 'active' : null }}"
                    href="{{ @$item->id ? route('umkm-produk.index', ['id_umkm' => $item->id]) : null }}"> Produk</a>
            </li>
        </ul>
    </div>
</div>
