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
                    {{ @$activeTab == 'form-kontak-alamat' ? 'active' : ($isLock == false ? 'bg-light border' : '') }}"
                    href="{{ @$item->id ? route($route . '.edit', $item->id) . '?section=kontak-alamat' : '#' }}">
                    Kontak & Alamat
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'form-lainnya' ? 'active' : ($isLock == false ? 'bg-light border' : '') }}"
                    href="{{ @$item->id ? route($route . '.edit', $item->id) . '?section=lainnya' : null }}">
                    Lainnya</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'form-legalitas' ? 'active' : ($isLock == false ? 'bg-light border' : '') }}"
                    href="{{ @$item->id ? route($route . '.edit', $item->id) . '?section=legalitas' : null }}">
                    Legalitas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'form-rinci' ? 'active' : ($isLock == false ? 'bg-light border' : '') }}"
                    href="{{ @$item->id ? route($route . '.edit', $item->id) . '?section=rinci' : null }}"> Rinci</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'form-tenaga-kerja' ? 'active' : ($isLock == false ? 'bg-light border' : '') }}"
                    href="{{ @$item->id ? route($route . '.edit', $item->id) . '?section=tenaga-kerja' : null }}">
                    Tenaga Kerja</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'Perikanan Produksi' ? 'active' : ($isLock == false ? 'bg-light border' : '') }}"
                    href="{{ @$item->id ? route($route . '-produksi.index', ['id_perikanan' => $item->id]) : null }}">
                    Produksi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'Perikanan Berkas' ? 'active' : ($isLock == false ? 'bg-light border' : '') }}"
                    href="{{ @$item->id ? route($route . '-berkas.index', ['id_perikanan' => $item->id]) : null }}">
                    Berkas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'Perikanan Galeri' ? 'active' : ($isLock == false ? 'bg-light border' : '') }}"
                    href="{{ @$item->id ? route($route . '-galeri.index', ['id_perikanan' => $item->id]) : null }}">
                    Galeri</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'form-verifikasi' ? 'active' : ($isLock == false ? 'bg-light border' : '') }}"
                    href="{{ @$item->id ? route($route . '.edit', $item->id) . '?section=verifikasi' : null }}"> Verifikasi</a>
            </li>
        </ul>
    </div>
</div>
