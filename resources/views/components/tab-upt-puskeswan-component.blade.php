<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-sm-row mb-4 gap-2">
            <li class="nav-item">
                <a class="nav-link {{ @$activeTab == 'form' ? 'active' : 'bg-light border' }}"
                    href="{{ @$item->id ? route($route . '.edit', @$item->id ?? null) : route($route . '.create') }}">
                    Umum</a>
            </li>
            <li class="nav-item">
                <a class="nav-link 
                    {{ @$isLock == true ? 'disabled' : '' }} 
                    {{ @$activeTab == 'form-wilayah' ? 'active' : ($isLock == false ? 'bg-light border' : '') }}"
                    href="{{ @$item->id ? route($route . '.edit', $item->id) . '?section=wilayah' : '#' }}">
                    Wilayah
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link 
                    {{ @$isLock == true ? 'disabled' : '' }} 
                    {{ @$activeTab == 'form-kontak-alamat' ? 'active' : ($isLock == false ? 'bg-light border' : '') }}"
                    href="{{ @$item->id ? route($route . '.edit', $item->id) . '?section=kontak-alamat' : '#' }}">
                    Kontak & Alamat
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link 
                    {{ @$isLock == true ? 'disabled' : '' }} 
                    {{ @$activeTab == 'form-fasilitas-layanan' ? 'active' : ($isLock == false ? 'bg-light border' : '') }}"
                    href="{{ @$item->id ? route($route . '.edit', $item->id) . '?section=fasilitas-layanan' : '#' }}">
                    Fasilitas & Layanan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'form-tenaga-kerja' ? 'active' : ($isLock == false ? 'bg-light border' : '') }}"
                    href="{{ @$item->id ? route($route . '.edit', $item->id) . '?section=tenaga-kerja' : null }}">
                    Tenaga Kerja</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'UPT Puskeswan Berkas' ? 'active' : ($isLock == false ? 'bg-light border' : '') }}"
                    href="{{ @$item->id ? route($route . '-berkas.index', ['id_upt_puskeswan' => $item->id]) : null }}">
                    Berkas</a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'Upt Puskeswan Galeri' ? 'active' : ($isLock == false ? 'bg-light border' : '') }}"
                    href="{{ @$item->id ? route($route . '-galeri.index', ['id_upt_puskeswan' => $item->id]) : null }}">
                    Galeri</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'form-verifikasi' ? 'active' : ($isLock == false ? 'bg-light border' : '') }}"
                    href="{{ @$item->id ? route($route . '.edit', $item->id) . '?section=verifikasi' : null }}"> Verifikasi</a>
            </li>
        </ul>
    </div>
</div>
