<div class="">
    <a href="javascript:;" class="text-body dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
        <i class="ti ti-dots-vertical ti-sm text-primary"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-end m-0">
        @if (!@$disabled_edit)
            @if ($permission_edit)
                <a href="{{ route($route . '.edit', $d->id) }}" class="dropdown-item">
                    Lihat
                </a>
            @endif
        @endif
        @if (!@$disabled_delete)
            @if ($permission_delete)
                {{ html()->form('DELETE', route($route . '.destroy', $d->id))->open() }}
                <a href="javascript:;" class="dropdown-item" onclick="SwalDelete($(this).closest('form'))">
                    {{ __('message.delete') }}
                </a>
                {{ html()->form()->close() }}
            @endif
        @endif
    </div>
</div>
