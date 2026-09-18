<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-sm-row mb-4">
            <li class="nav-item">
                <a class="nav-link {{ @$activeTab == 'form' ? 'active' : null }}"
                    href="{{ @$item->id ? route($route . '.edit', @$item->id ?? null) : route($route . '.create') }}"> Identitas Koperasi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'form-kontak-alamat' ? 'active' : null }}"
                    href="{{ @$item->id ? route($route . '.edit', $item->id) . '?section=kontak-alamat' : null }}"> Kontak
                    & Alamat</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'form-lainnya' ? 'active' : null }}"
                    href="{{ @$item->id ? route($route . '.edit', $item->id) . '?section=lainnya' : null }}"> Lainnya</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'form-kesehatan' ? 'active' : null }}"
                    href="{{ @$item->id ? route($route . '.edit', $item->id) . '?section=kesehatan' : null }}"> Kesehatan</a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'Koperasi Kesehatan' ? 'active' : null }}"
                    href="{{ @$item->id ? route('koperasi-kesehatan.index', ['id_koperasi' => $item->id]) : null }}">
                    Kesehatan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'form-perizinan' ? 'active' : null }}"
                    href="{{ @$item->id ? route($route . '.edit', $item->id) . '?section=perizinan' : null }}"> Perizinan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'form-unit-simpan-pinjam' ? 'active' : null }}"
                    href="{{ @$item->id ? route($route . '.edit', $item->id) . '?section=unit-simpan-pinjam' : null }}"> Unit Simpan Pinjam</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'form-struktur-organisasi' ? 'active' : null }}"
                    href="{{ @$item->id ? route($route . '.edit', $item->id) . '?section=struktur-organisasi' : null }}">
                    Struktur Organisasi</a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'Koperasi Susunan Kepengurusan' ? 'active' : null }}"
                    href="{{ @$item->id ? route('koperasi-susunan-kepengurusan.index', ['id_koperasi' => $item->id]) : null }}">
                    Susunan Kepengurusan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'Koperasi Indikator Kelembagaan' ? 'active' : null }}"
                    href="{{ @$item->id ? route('koperasi-indikator-kelembagaan.index', ['id_koperasi' => $item->id]) : null }}">
                    Indikator Kelembagaan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'Koperasi Rat' ? 'active' : null }}"
                    href="{{ @$item->id ? route('koperasi-rat.index', ['id_koperasi' => $item->id]) : null }}">
                    Indikator Usaha
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'Koperasi Berkas' ? 'active' : null }}"
                    href="{{ @$item->id ? route('koperasi-berkas.index', ['id_koperasi' => $item->id]) : null }}">
                    Berkas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'Koperasi Laporan Keuangan' ? 'active' : null }}"
                    href="{{ @$item->id ? route('koperasi-laporan-keuangan.index', ['id_koperasi' => $item->id]) : null }}">
                    Laporan Keuangan</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'Koperasi Pemeran' ? 'active' : null }}"
                    href="{{ @$item->id ? route('koperasi-berkas.index', ['id_koperasi' => $item->id]) : null }}">
                    Pemeran</a>
            </li> --}}
        </ul>
    </div>
</div>
