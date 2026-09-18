<div class="">
    <a href="javascript:;" class="text-body dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
        <i class="ti ti-dots-vertical ti-sm text-primary"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-end m-0">
        @can("$permission_main Detail")
            <a href="{{ route($route . '.show', $d->id) }}" class="dropdown-item">
                Detail
            </a>
        @endcan
        @can("$permission_main Edit")
            <a href="{{ route($route . '.edit', $d->id) }}" class="dropdown-item">
                Edit
            </a>
        @endcan
        @can("$permission_main Delete")
            {{ html()->form('DELETE', route($route . '.destroy', $d->id))->open() }}
            <a href="javascript:;" class="dropdown-item" onclick="SwalDelete($(this).closest('form'))">
                {{ __('message.delete') }}
            </a>
            {{ html()->form()->close() }}
        @endcan
    </div>
</div>
