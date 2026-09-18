{{ html()->model($item)->form('put', route($route . '.update', $item->id))->class('form form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
<div class="row">
    <div class="col-xl-10">
        {{ html()->hidden('id') }}
        {{ html()->hidden('section', $section) }}
        <div class="card shadow-sm">
            <div class="card-header border-bottom py-3 d-md-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Alamat & Kontak</h5>
                <div class="mt-2 mt-md-0">
                    <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy"></i>
                        {{ __('message.save') }}</button>
                    <a href="{{ route("$route.index") }}" class="btn btn-secondary">
                        <i class="ti ti-arrow-left"></i> {{ __('message.back') }}
                    </a>
                </div>
            </div>
            <div class="card-body pt-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row mb-3 align-items-start">
                    <label class="col-md-4 col-form-label">
                        Kecamatan 
                        <div class="mt-1">
                            <input type="checkbox" id="check-all-kecamatan" /> Pilih Semua
                        </div>
                    </label>
                    <div class="col-md-8">
                        <div class="row">
                            @foreach ($listKecamatan as $key => $value)
                                <div class="col-md-4">
                                    <div class="checkbox mb-2">
                                        <label class="cursor-pointer">
                                            @php
                                                $isChecked = in_array($key, @$item->id_kecamatan_array ?? []);
                                            @endphp
                                            {{ html()->checkbox('id_kecamatan[]', $isChecked, $key)->class("kecamatan-checkbox") }} &nbsp;
                                            {{ $value }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{ html()->form()->close() }}
@push('script')
<script>
    $(document).ready(function() {
        $('#check-all-kecamatan').on('change', function() {
            $('.kecamatan-checkbox').prop('checked', $(this).is(':checked'));
        });
    });
</script>
@endpush
