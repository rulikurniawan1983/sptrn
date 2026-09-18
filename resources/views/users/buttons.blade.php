<div class="">
    <a href="javascript:;" class="text-body dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
        <i class="ti ti-dots-vertical ti-sm text-primary"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-end m-0">
        @if ($permission_detail)
            <a href="{{ route($route . '.show', $d->id) }}" class="dropdown-item">
                Detail
            </a>
        @endif
        @if ($permission_edit)
            <a href="{{ route($route . '.edit', $d->id) }}" class="dropdown-item">
                Edit
            </a>
        @endif
        @if ($permission_delete)
            {{ html()->form('DELETE', route($route . '.destroy', $d->id))->open() }}
            <a href="javascript:;" class="dropdown-item" onclick="SwalDelete($(this).closest('form'))">
                {{ __('message.delete') }}
            </a>
            {{ html()->form()->close() }}
        @endif
        @if ($permission_login_as and auth()->user()->id != $d->id)
            {!! html()->form('POST', route($route . '.login-as', $d->id))->open() !!}
            <a href="javascript:;" class="dropdown-item" onclick="$(this).closest('form').submit()">
                Login As
            </a>
            {{ html()->form()->close() }}
        @endif
    </div>
</div>
