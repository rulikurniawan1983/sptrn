@if ($box)
<div class="box-{{$name}}">
@endif
    @if($useLabel)
        @if($horizontal)
        <div class="row mb-3">
            <label for="{{ $id }}" class="col-md-4 col-form-label">{{ $label }} 
                @if ($bintang or $required)
                    <small class="text-danger">*</small>
                @endif
                <br>
                {!! $afterLabel !!}
            </label>
            <div class="col-md-8">
                @if($type === 'file')
                    {{ 
                        html()->file($name)
                             ->id($id)
                             ->class($class)
                             ->required($required)
                             ->attribute('accept', $accept) 
                    }}
                @else
                    @php
                        $html = html()->{$type}($name)
                            ->id($id)
                            ->class($class)
                            ->placeholder($placeholder)
                            ->required($required)
                            ->attribute('autofocus', $autofocus ? 'true' : 'false');
                        if ($value != NULL) {
                            $html = $html->value($value);
                        }
                        if ($tabindex != NULL) {
                            $html = $html->attribute('tabindex', $tabindex);
                        }
                        if ($rows != NULL) {
                            $html = $html->attribute('rows', $rows);
                        }
                        if ($readonly) {
                            $html = $html->attribute('readonly', 'readonly');
                        }
                        if ($readonly) {
                            $html = $html->attribute('disabled', 'disabled');
                        }
                    @endphp
                    {{ 
                        $html
                    }}
                @endif
                {{$slot}}
            </div>
        </div>
        @else
        <div class="mb-3">
            <label for="{{ $id }}" class="form-label">
                {{ $label }}
                @if ($bintang or $required)
                    <small class="text-danger">*</small>
                @endif
                {!! $afterLabel !!}
            </label>
            @if($type === 'file')
                {{ 
                    html()->file($name)
                         ->id($id)
                         ->class($class)
                         ->required($required)
                         ->attribute('accept', $accept) 
                }}
            @else
                @php
                    $html = html()->{$type}($name)
                        ->id($id)
                        ->class($class)
                        ->placeholder($placeholder)
                        ->required($required)
                        ->attribute('autofocus', $autofocus ? 'true' : 'false');
                    if ($value != NULL) {
                        $html = $html->value($value);
                    }
                    if ($tabindex != NULL) {
                        $html = $html->attribute('tabindex', $tabindex);
                    }
                    if ($rows != NULL) {
                        $html = $html->attribute('rows', $rows);
                    }
                    if ($readonly) {
                        $html = $html->attribute('readonly', 'readonly');
                    }
                    if ($readonly) {
                        $html = $html->attribute('disabled', 'disabled');
                    }
                @endphp
                {{ 
                    $html
                }}
            @endif
            {{$slot}}
        </div>
        @endif
    @else
        @if($type === 'file')
            {{ 
                html()->file($name)
                     ->id($id)
                     ->class($class)
                     ->required($required) }}
        @else
            @php
                $html = html()->{$type}($name)
                    ->id($id)
                    ->class($class)
                    ->placeholder($placeholder)
                    ->required($required)
                    ->attribute('autofocus', $autofocus ? 'true' : 'false');
                if ($value != null) {
                    $html = $html->value($value);
                }
                if ($tabindex != NULL) {
                    $html = $html->attribute('tabindex', $tabindex);
                }
                if ($rows != NULL) {
                    $html = $html->attribute('rows', $rows);
                }
                if ($readonly) {
                    $html = $html->attribute('readonly', 'readonly');
                }
                if ($readonly) {
                    $html = $html->attribute('disabled', 'disabled');
                }
            @endphp
            {{ 
                $html
            }}
        @endif
        {{$slot}}
    @endif
@if ($box)
</div>
@endif
