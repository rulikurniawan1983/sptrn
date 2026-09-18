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
                    Wilayah Terdampak
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'Status Penyakit Hewan' ? 'active' : ($isLock == false ? 'bg-light border' : '') }}"
                    href="{{ @$item->id ? route($route . '-hewan.index', ['id_status_penyakit' => $item->id]) : null }}">
                    Hewan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ @$isLock == true ? 'disabled' : null }} {{ @$activeTab == 'Status Penyakit Kasus' ? 'active' : ($isLock == false ? 'bg-light border' : '') }}"
                    href="{{ @$item->id ? route($route . '-kasus.index', ['id_status_penyakit' => $item->id]) : null }}">
                    Kasus</a>
            </li>
        </ul>
    </div>
</div>
