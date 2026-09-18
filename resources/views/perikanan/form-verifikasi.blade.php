<div class="row">
    <div class="col-xl-8">
        {{ html()->model($item)->form('put', route($route . '.update', $item->id))->class('form form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
        {{ html()->hidden('id') }}
        {{ html()->hidden('section', $section) }}
        <div class="card shadow-sm">
            <div class="card-header border-bottom py-3 d-md-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Verifikasi</h5>
                <div class="mt-2 mt-md-0">
                    @can('Perikanan Set Verifikasi')
                        <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy"></i>
                            {{ __('message.save') }}</button>
                    @endcan
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
                @can('Perikanan Set Verifikasi')
                    <x-form-select name="id_status_verifikasi" label="Status Verifikasi" placeholder="Pilih"
                    :options="$listStatusVerifikasi" />
                    <x-form-input type="textarea" name="catatan_verifikasi_petugas" label="Catatan Status Verifikasi"/>
                @else
                    <x-detail-item label="Status Verifikasi" :value="$item->status_verifikasi->nama"/>
                    <x-detail-item label="Catatan" :value="$item->catatan_verifikasi_petugas ?? '-'"/>
                @endcan
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
