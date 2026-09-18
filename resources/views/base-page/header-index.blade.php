<div class="card-header border-bottom py-3 d-md-flex justify-content-between align-items-center">
    <h5 class="card-title mb-0">{{ $titlePage }}</h5>
    <div class="mt-2 mt-md-0 d-flex flex-column flex-sm-row gap-2">
        @if (!@$disabled_add)
            @can("$permission_main Add")
                <a href="{{ @$routeAddCustom ? @$routeAddCustom : route("$route.create") }}" class="btn btn-primary">
                    <i class="ti ti-plus"></i> {{ __('message.add') }}
                </a>
            @endcan
        @endif
        @if (@$disabled_export == false)
            <a href="{{ url($route . '/export') }}" class="btn btn-success">
                <i class="ti ti-file-spreadsheet"></i> Export
            </a>
        @endif
        @if (!@$disabled_delete)
            @can("$permission_main Delete")
                {{ html()->form('POST', route($route . '.destroy-selected'))->style('display: contents')->open() }}
                <a href="#" class="btn btn-danger disabled" id="DeleteSelected"
                    onclick="SwalDeleteSelected($(this).closest('form'))">
                    <i class="ti ti-trash"></i> {{ __('message.delete_selected') }}
                </a>
                {{ html()->form()->close() }}
            @endcan
        @endif
    </div>
</div>
