<div class="box-{{$name}}">
    @if($useLabel)
        @if($horizontal)
        <div class="row mb-3">
            <label for="{{ $id }}" class="col-md-4 col-form-label">
                {{ $label }}
                @if ($bintang or $required)
                    <small class="text-danger">*</small>
                @endif
            </label>
            <div class="col-md-8">
                @php
                    $html = html()->select($name, $options, $value)
                         ->id($id)
                         ->class($class)
                         ->required($required)
                         ->attribute('autofocus', $autofocus ? 'true' : 'false');
                    if ($placeholder != '') {
                        $html = $html->placeholder($placeholder);
                    }
                    if ($multiple == true) {
                        $html = $html->attribute('multiple', $multiple);
                    }
                @endphp
                {{$html}}
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
            </label>
            @php 
                $html = html()->select($name, $options, $value)
                        ->id($id)
                        ->class($class)
                        ->required($required)
                        ->attribute('autofocus', $autofocus ? 'true' : 'false');
                if ($placeholder != '') {
                    $html = $html->placeholder($placeholder);
                }
                if ($multiple == true) {
                    $html = $html->attribute('multiple', $multiple);
                }
            @endphp
            {{$html}}
            {{$slot}}
        </div>
        @endif
    @else
        @php
            $html = html()->select($name, $options, $value)
                 ->id($id)
                 ->class($class)
                 ->required($required)
                 ->attribute('autofocus', $autofocus ? 'true' : 'false');
            if ($placeholder != '') {
                $html = $html->placeholder($placeholder);
            }
            if ($multiple == true) {
                $html = $html->attribute('multiple', $multiple);
            }
        @endphp    
        {{$html}}
        {{$slot}}
    @endif
</div>
