<div class="row">
    <div class="col-xl-8">
        {{ html()->model($item)->form('put', route($route . '.update', $item->id))->class('form form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
        {{ html()->hidden('id') }}
        {{ html()->hidden('section', $section) }}
        <div class="card shadow-sm">
            <div class="card-header border-bottom py-3 d-md-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Jumlah Tenaga Kerja</h5>
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
                <div class="row">
                    <div class="col-md-6">
                        <x-form-input type="number" name="tki_pria" label="TKI Pria" :horizontal="false" />
                    </div>
                    <div class="col-md-6">
                        <x-form-input type="number" name="tki_wanita" label="TKI Wanita" :horizontal="false" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <x-form-input type="number" name="tka_pria" label="TKA Pria" :horizontal="false" />
                    </div>
                    <div class="col-md-6">
                        <x-form-input type="number" name="tka_wanita" label="TKA Wanita" :horizontal="false" />
                    </div>
                </div>
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
