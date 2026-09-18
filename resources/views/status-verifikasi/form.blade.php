<x-form-input name="nama" label="Nama" autofocus />
<div class="row mb-3 align-items-center">
    <label class="col-md-4 col-form-label">Status Default</label>
    <div class="col-md-8 d-flex gap-3">
        <x-form-input-radio name="is_default" value="1">
            Ya
        </x-form-input-radio>
        <x-form-input-radio name="is_default" value="0">
            Tidak
        </x-form-input-radio>
    </div>
</div>