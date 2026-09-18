<x-form-input name="nama" label="Nama" autofocus />
<x-form-input name="url" label="Url" />
<div class="row mb-3">
    <label class="col-md-4 col-form-label">Icon</label>
    <div class="col-md-8 gap-3">
        @foreach ($icon as $value)
            <div class="d-flex flex-wrap gap-1">
                <x-form-input-radio name="icon" :value="$value">
                    {!! $value !!}
                </x-form-input-radio>
            </div>
        @endforeach
    </div>
</div>
<div class="row mb-3 align-items-center">
    <label class="col-md-4 col-form-label">Status Aktif</label>
    <div class="col-md-8 d-flex gap-3">
        <x-form-input-radio name="is_active" value="1">
            Ya
        </x-form-input-radio>
        <x-form-input-radio name="is_active" value="0">
            Tidak
        </x-form-input-radio>
    </div>
</div>
