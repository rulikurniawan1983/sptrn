<x-form-input name="name" label="Nama" autofocus />
<div class="row mb-3 align-items-center">
    <label class="col-md-4 col-form-label">Warna</label>
    <div class="col-md-8 d-flex flex-column gap-2">
        @foreach ($listBg as $value)
            <x-form-input-radio name="bg" :value="$value">
                <span class="badge {{ $value }}">{{ $value }}</span>
            </x-form-input-radio>
        @endforeach
    </div>
</div>
<x-form-select name="init_page_login" label="Halaman Setelah Login" :options="$listInitPage" placeholder="Pilih" horizontal />
<div class="row mb-3 align-items-center">
    <label class="col-md-4 col-form-label">Status Login</label>
    <div class="col-md-8 d-flex gap-3">
        <x-form-input-radio name="is_allow_login" value="1">
            Ya
        </x-form-input-radio>
        <x-form-input-radio name="is_allow_login" value="0">
            Tidak
        </x-form-input-radio>
    </div>
</div>
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
                <div class="col-md-6">
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
<div class="row mb-3 align-items-center">
    <label class="col-md-4 col-form-label">Menu Aplikasi</label>
    <div class="col-md-8 d-flex gap-3">
        <x-form-input-radio name="is_vertical_menu" value="1">
            Vertical
        </x-form-input-radio>
        <x-form-input-radio name="is_vertical_menu" value="0">
            Horizontal
        </x-form-input-radio>
    </div>
</div>
@push('script')
    <script>
         $(document).ready(function() {
            $('#check-all-kecamatan').on('change', function() {
                $('.kecamatan-checkbox').prop('checked', $(this).is(':checked'));
            });
        });
    </script>
@endpush
