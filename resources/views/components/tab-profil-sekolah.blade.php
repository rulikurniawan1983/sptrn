<ul class="nav nav-pills flex-column flex-sm-row mb-4">
    <li class="nav-item">
        <a class="nav-link {{ @$name == '' ? 'active' : null }}" href="{{ route('profil-sekolah.edit', $item->id) }}">
            <i class="ti ti-xs ti-article me-1"></i> Umum</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ @$name == 'Profil Sekolah Photo' ? 'active' : null }}"
            href="{{ route('profil-sekolah-photo.index', ['profil_sekolah_id' => $item->id]) }}"><i
                class="ti ti-xs ti-photo me-1"></i> Galeri</a>
    </li>
</ul>
