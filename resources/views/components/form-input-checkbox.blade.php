<label class="cursor-pointer d-flex align-items-center">
    {{ html()->checkbox($name, $checked, $value) }} &nbsp;
    {{ $slot }}
</label>
