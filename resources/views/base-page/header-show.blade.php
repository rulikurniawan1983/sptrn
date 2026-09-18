<div class="card-header border-bottom py-3 d-md-flex justify-content-between align-items-center">
    <h5 class="card-title mb-0">Detail {{ $titlePage }}</h5>
    <div class="mt-2 mt-md-0 d-flex flex-column flex-sm-row gap-2">
        @if (!@$disabled_edit)
            @can("$permission_main Edit")
                <a href="{{ route("$route.edit", $item->id) }}" class="btn btn-info">
                    <i class="ti ti-edit"></i> Edit
                </a>
            @endcan
        @endif
        @if (!@$disabled_delete)
            @can("$permission_main Delete")
                {{ html()->form('DELETE', route($route . '.destroy', $item->id))->open() }}
                <a href="javascript:;" class="btn btn-danger" onclick="SwalDelete($(this).closest('form'))">
                    <i class="ti ti-trash"></i> {{ __('message.delete') }}
                </a>
                {{ html()->form()->close() }}
            @endcan
        @endif
        <a href="{{ @$backroute ? @$backroute : route("$route.index") }}" class="btn btn-secondary">
            <i class="ti ti-arrow-left"></i> {{ __('message.back') }}
        </a>
    </div>
</div>
