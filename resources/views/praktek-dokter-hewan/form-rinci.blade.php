<div class="row">
    <div class="col-xl-8">
        {{ html()->model($item)->form('put', route($route . '.update', $item->id))->class('form form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
        {{ html()->hidden('id') }}
        {{ html()->hidden('section', $section) }}
        <div class="card shadow-sm">
            <div class="card-header border-bottom py-3 d-md-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Rinci</h5>
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
                <x-form-input name="nilai_investasi" label="Nilai Investasi (Rp.)" class="form-control numeral-mask" />
                <x-form-select name="id_status_permodalan" label="Status Permodalan" placeholder="Pilih" :options="$listStatusPermodalan" />
                <x-form-input name="luas_tanah" label="Luas Tanah (m2)" />
                <x-form-input name="luas_bangunan" label="Luas Bangunan (m2)" />
            </div>
        </div>
        {{ html()->form()->close() }}
    </div>
</div>
@push('script')
    <script>
        $(document).ready(function() {
        });
    </script>
@endpush
