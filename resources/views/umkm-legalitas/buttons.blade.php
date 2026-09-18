<div class="d-flex gap-1">
    @if($permission_detail)
        <a href="{{ route($route.'.show', $d->id) }}" class="btn btn-sm btn-outline-info" title="Detail">
            <i class="ti ti-eye"></i>
        </a>
    @endif
    @if($permission_edit)
        <a href="{{ route($route.'.edit', $d->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
            <i class="ti ti-edit"></i>
        </a>
    @endif
    @if($permission_delete)
        <form action="{{ route($route.'.destroy', $d->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                <i class="ti ti-trash"></i>
            </button>
        </form>
    @endif
    @if($permission_verify)
        <button class="btn btn-sm {{ $d->is_verified ? 'btn-outline-secondary' : 'btn-outline-success' }} verify-btn" 
                data-id="{{ $d->id }}" 
                data-verified="{{ $d->is_verified }}"
                title="{{ $d->is_verified ? 'Batalkan Verifikasi' : 'Verifikasi' }}">
            <i class="ti {{ $d->is_verified ? 'ti-x' : 'ti-check' }}"></i>
        </button>
    @endif
</div>

<script>
$(document).ready(function() {
    $('.verify-btn').on('click', function() {
        const btn = $(this);
        const id = btn.data('id');
        const isVerified = btn.data('verified');
        const url = '{{ route($route.'.verify', ':id') }}'.replace(':id', id);
        
        $.post(url, {
            _token: '{{ csrf_token() }}'
        }).done(function(response) {
            if (response.status === 'success') {
                location.reload();
            }
        }).fail(function() {
            alert('Gagal melakukan verifikasi.');
        });
    });
});
</script>
