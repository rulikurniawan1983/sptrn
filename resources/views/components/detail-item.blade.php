@if ($isList)
    <li class="mb-2">
        <span class="fw-medium me-1">{{ $label }}:</span>
        @if ($value)
            <span>{{ $value ?? '-' }}</span>
        @else
            {{ $slot }}
        @endif
    </li>
@else
    <div class="mb-2 row">
        <div class="col-sm-4">
            <label class="col-form-label">{{ $label }}</label>
        </div>
        @if ($value)
            <label class="col-sm-8 col-form-label font-medium-1">{{ $value }}</label>
        @else
            <div class="col-sm-8 pt-2">
                {{ $slot }}
            </div>
        @endif
    </div>
@endif
