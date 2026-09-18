<x-form-input name="name" label="Nama" autofocus />
<x-form-input name="no_hp" label="No. HP" />
<x-form-input type="text" name="email" label="Email / NIB / ID Koperasi" />
<div class="row mb-3 align-items-center form-password-toggle">
    <label for="password" class="col-md-4 col-form-label">Password</label>
    <div class="col-md-8">
        <div class="input-group input-group-merge">
            <input type="password" name="password" id="password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
        </div>
    </div>
</div>
<x-form-input type="textarea" name="deskripsi" label="Deskripsi Profil" />
@include('base-page.form-file-foto', ['column_name_path' => 'file_url', 'column_name' => 'file'])
<div class="row mb-3 align-items-center">
    <label class="col-md-4 col-form-label">Berkas NIB</label>
    <div class="col-md-8">
        <input type="file" name="file_nib" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
        @if(@$item->nib_file_url)
            <div class="mt-2">
                <a href="{{ $item->nib_file_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                    <i class="ti ti-file-description me-1"></i> Lihat Berkas NIB Saat Ini
                </a>
            </div>
        @endif
    </div>
</div>
<div class="row mb-3 align-items-center">
    <label class="col-md-4 col-form-label">Status Aktif</label>
    <div class="col-md-8 d-flex gap-3">
        <x-form-input-radio name="is_active" value="1">
            Ya
        </x-form-input-radio>
        <x-form-input-radio name="is_active" value="0">
            Tidak
        </x-form-input-radio>
    </div>
</div>
<div class="row mb-3 align-items-start">
    <label class="col-md-4 col-form-label">Level</label>
    <div class="col-md-8">
        @foreach ($get_Roles as $key => $value)
            <div class="checkbox mb-2">
                <x-form-input-checkbox name="role_id[]" :value="$key"
                    :checked="in_array($key, @$item->users_role_id_array ?? [])">{{ $value }}</x-form-input-checkbox>
            </div>
        @endforeach
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
@push('script')
    <script>
         $(document).ready(function() {
            $('#check-all-kecamatan').on('change', function() {
                $('.kecamatan-checkbox').prop('checked', $(this).is(':checked'));
            });

            $(document).on('click', '.form-password-toggle .input-group-text, .form-password-toggle i', function(e) {
                e.preventDefault();
                var $container = $(this).closest('.form-password-toggle');
                var $input = $container.find('input');
                var $icon = $container.find('i');
                if ($input.attr('type') === 'password') {
                    $input.attr('type', 'text');
                    $icon.removeClass('ti-eye-off').addClass('ti-eye');
                } else {
                    $input.attr('type', 'password');
                    $icon.removeClass('ti-eye').addClass('ti-eye-off');
                }
            });
        });
    </script>
@endpush
