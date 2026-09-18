{{ html()->model($item)->form('put', route($route . '.update', $item->id))->class('form form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
<div class="row">
    <div class="col-xl-6">
        {{ html()->hidden('id') }}
        {{ html()->hidden('section', $section) }}
        <div class="card shadow-sm">
            <div class="card-header border-bottom py-3 d-md-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Fasilitas & Layanan</h5>
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
                        Fasilitas
                        <div class="mt-1">
                            <input type="checkbox" id="check-all-fasilitas-upt" /> Pilih Semua
                        </div>
                    </label>
                    <div class="col-md-8">
                        <div class="row">
                            @foreach ($listFasilitasUpt as $key => $value)
                                <div class="col-md-12">
                                    <div class="checkbox mb-2">
                                        <label class="cursor-pointer">
                                            @php
                                                $isChecked = in_array($key, @$item->id_fasilitas_upt_array ?? []);
                                            @endphp
                                            {{ html()->checkbox('id_fasilitas_upt[]', $isChecked, $key)->class("fasilitas-upt-checkbox") }} &nbsp;
                                            {{ $value }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row mb-3 align-items-start">
                    <label class="col-md-4 col-form-label">
                        Layanan
                        <div class="mt-1">
                            <input type="checkbox" id="check-all-fasilitas-upt" /> Pilih Semua
                        </div>
                    </label>
                    <div class="col-md-8">
                        <div class="row">
                            @foreach ($listLayananUpt as $key => $value)
                                <div class="col-md-12">
                                    <div class="checkbox mb-2">
                                        <label class="cursor-pointer">
                                            @php
                                                $isChecked = in_array($key, @$item->id_layanan_upt_array ?? []);
                                            @endphp
                                            {{ html()->checkbox('id_layanan_upt[]', $isChecked, $key)->class("layanan-upt-checkbox") }} &nbsp;
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
        $('#check-all-fasilitas-upt').on('change', function() {
            $('.fasilitas-upt-checkbox').prop('checked', $(this).is(':checked'));
        });
    });
</script>
@endpush
