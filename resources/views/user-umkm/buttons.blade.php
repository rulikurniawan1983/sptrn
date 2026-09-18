<div class="d-flex align-items-center gap-1 justify-content-center">
    @if ($permission_verify)
        @if ($d->is_active == 0)
            <button type="button" class="btn btn-xs btn-success d-flex align-items-center gap-1"
                    onclick="toggleVerifyUser({{ $d->id }}, '{{ addslashes($d->name) }}', 0)"
                    title="Verifikasi & Aktifkan Akun">
                <i class="ti ti-check ti-xs"></i> <span>Verifikasi</span>
            </button>
        @else
            <button type="button" class="btn btn-xs btn-outline-secondary d-flex align-items-center gap-1"
                    onclick="toggleVerifyUser({{ $d->id }}, '{{ addslashes($d->name) }}', 1)"
                    title="Nonaktifkan Akun">
                <i class="ti ti-ban ti-xs"></i>
            </button>
        @endif
    @endif

    <div class="dropdown">
        <a href="javascript:;" class="btn btn-xs btn-icon btn-text-secondary rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
            <i class="ti ti-dots-vertical ti-sm"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end m-0 shadow">
            @if ($permission_detail)
                <a href="{{ route($route . '.show', $d->id) }}" class="dropdown-item d-flex align-items-center gap-2">
                    <i class="ti ti-eye text-info"></i> Detail Lengkap
                </a>
            @endif
            @if ($d->nib_file_url)
                <a href="{{ route('user-umkm.download-nib', $d->id) }}" target="_blank" class="dropdown-item d-flex align-items-center gap-2">
                    <i class="ti ti-file-download text-primary"></i> Unduh Berkas NIB
                </a>
            @endif
            @if ($permission_edit)
                <a href="{{ route($route . '.edit', $d->id) }}" class="dropdown-item d-flex align-items-center gap-2">
                    <i class="ti ti-edit text-warning"></i> Edit Data
                </a>
            @endif
            @if ($permission_delete)
                <form action="{{ route($route . '.destroy', $d->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <a href="javascript:;" class="dropdown-item text-danger d-flex align-items-center gap-2" onclick="SwalDelete($(this).closest('form'))">
                        <i class="ti ti-trash"></i> Hapus
                    </a>
                </form>
            @endif
            @if ($permission_login_as && auth()->user()->id != $d->id)
                <div class="dropdown-divider my-1"></div>
                <form action="{{ route('users.login-as', $d->id) }}" method="POST" class="d-inline">
                    @csrf
                    <a href="javascript:;" class="dropdown-item text-primary d-flex align-items-center gap-2" onclick="$(this).closest('form').submit()">
                        <i class="ti ti-login"></i> Login As
                    </a>
                </form>
            @endif
        </div>
    </div>
</div>

