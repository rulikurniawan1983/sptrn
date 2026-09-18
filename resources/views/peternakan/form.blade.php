<div class="row">
    <div class="col-xl-8">
        @if (@$item == null)
            {{ html()->form('POST', route($route . '.store'))->class('form form-horizontal')->id('form')->attribute('enctype', 'multipart/form-data')->open() }}
        @else
            {{ html()->model($item)->form('put', route($route . '.update', $item->id))->class('form form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
            {{ html()->hidden('id') }}
        @endif
        {{ html()->hidden('section', $section) }}
        <div class="card shadow-sm">
            <div class="card-header border-bottom py-3 d-md-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Data Umum</h5>
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
                <x-form-input name="nama" label="Nama" autofocus />
                <x-form-select name="id_kbli" label="KBLI" :options="$listKbli" placeholder="Pilih" />
                <x-form-select name="id_jenis_usaha" label="Jenis Badan Usaha" :options="$listJenisUsaha" placeholder="Pilih" />
                <x-form-select name="id_jenis_peternakan" label="Jenis Peternakan" :options="$listJenisPeternakan" placeholder="Pilih" />
                <x-form-select name="id_kecamatan" label="Kecamatan" placeholder="Pilih" :options="$listKecamatan" />
                <x-form-select name="id_kelurahan" label="Kelurahan" placeholder="Pilih" :options="@$listKelurahan ?? []" />
            </div>
        </div>
        {{ html()->form()->close() }}
    </div>
</div>
@push('script')
    <script>
        $(document).ready(function() {
            $('[name=id_kecamatan]').on('change', function() {
                $('[name=id_kelurahan]').empty();
                $('[name=id_kelurahan]').append('<option value="">Pilih</option>');
                var id_kecamatan = $(this).val();
                if (id_kecamatan) {
                    $.ajax({
                        url: "{{ route('general.kelurahan') }}",
                        type: 'GET',
                        data: {
                            id_kecamatan: id_kecamatan
                        },
                        dataType: 'json',
                        success: function(data) {
                            $('[name=id_kelurahan]').empty();
                            $('[name=id_kelurahan]').append('<option value="">Pilih</option>');
                            $.each(data.data, function(key, value) {
                                $('[name=id_kelurahan]').append('<option value="' +
                                    value.id + '">' + value.nama + '</option>');
                            });
                        }
                    });
                }
            });
        });
    </script>
@endpush
