<div class="row">
    <div class="col-xl-8">
        {{ html()->model($item)->form('put', route($route . '.update', $item->id))->class('form form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
        {{ html()->hidden('id') }}
        {{ html()->hidden('section', $section) }}
        <div class="card shadow-sm">
            <div class="card-header border-bottom py-3 d-md-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Lainnya</h5>
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
                <x-form-select name="jenis_kelamin" label="Jenis Kelamin" placeholder="Pilih" :options="['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan']" />
                <x-form-select name="id_tingkat_resiko" label="Tingkat Resiko" placeholder="Pilih"
                :options="$listTingkatResiko" />
                <x-form-select name="id_skala_usaha" label="Skala Usaha" placeholder="Pilih" :options="$listSkalaUsaha" />
                <x-form-input name="komoditas" label="Komoditas" />
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
