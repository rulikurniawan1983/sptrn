<div class="row mb-3">
    <label class="col-md-4 col-form-label">{{ @$title ?? 'Foto' }}</label>
    <div class="col-md-8">
        <div class="row mb-3">
            <div class="col-md-6 col-4 mx-auto">
                @if (@$item->id)
                    <img src="{{ $item[$column_name_path] }}" alt="user-avatar" class="d-block w-100 rounded"
                        id="uploadedAvatar" />
                @else
                    <img src="{{ asset('/assets/img/no-image.jpeg') }}" alt="user-avatar" class="d-block w-100 rounded"
                        id="uploadedAvatar" />
                @endif
            </div>
        </div>
        <div class="button-wrapper">
            <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                <span class="d-none d-sm-block">Upload new photo</span>
                <i class="ti ti-upload d-block d-sm-none"></i>
                <div hidden>
                    <x-form-input type="file" name="{{ $column_name }}" id="upload" class="account-file-input"
                        accept='image/*' />
                </div>
            </label>
            <button type="button" class="btn btn-label-secondary account-image-reset mb-3">
                <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Reset</span>
            </button>
            <div class="text-muted">Allowed JPG, GIF or PNG. Max size of 800K</div>
        </div>
    </div>
</div>
