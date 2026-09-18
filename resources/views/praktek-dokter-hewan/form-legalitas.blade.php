<div class="row">
    <div class="col-xl-8">
        {{ html()->model($item)->form('put', route($route . '.update', $item->id))->class('form form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
        {{ html()->hidden('id') }}
        {{ html()->hidden('section', $section) }}
        <div class="card shadow-sm">
            <div class="card-header border-bottom py-3 d-md-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Legalitas</h5>
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
                <x-form-input name="no_badan_hukum" label="No. Badan Hukum" />
                <x-form-input type="date" name="tanggal_badan_hukum" label="Tanggal Badan Hukum" />
                <x-form-select name="id_pengesahan_badan_hukum" label="Pengesahan Badan Hukum" placeholder="Pilih"
                    :options="$listPengesahanBadanHukum" />
                <x-form-input type="number" name="tahun_ind_usaha" label="Tahun Usaha" />
                <x-form-input name="nama_notaris" label="Notaris/Camat Pembuat Akta" />
                <x-form-input type="number" name="npwp" label="NPWP" />
                
                <div class="mt-4">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <div class="grow border-1 border-dashed"></div>
                        <h5 class="fw-bold px-3 mb-0">NIB</h5>
                        <div class="grow border-1 border-dashed"></div>
                    </div>
                    <x-form-input type="number" name="nib" label="Nomor" />
                    <x-form-input type="date" name="nib_tanggal_terbit" label="Tanggal Terbit" />
                    <x-form-input name="nib_dikeluarkan_oleh" label="Dikeluarkan Oleh" />
                    <x-form-input name="nib_penanggungjawab" label="Nama Penanggungjawab" />
                </div>
                <div class="mt-4">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <div class="grow border-1 border-dashed"></div>
                        <h5 class="fw-bold px-3 mb-0">Surat Izin Tempat Usaha</h5>
                        <div class="grow border-1 border-dashed"></div>
                    </div>
                    <x-form-input type="number" name="surat_izin_tempat_usaha" label="Nomor" />
                    <x-form-input type="date" name="surat_izin_tempat_usaha_tanggal_terbit" label="Tanggal Terbit" />
                    <x-form-input type="date" name="surat_izin_tempat_usaha_masa_berlaku" label="Masa Berlaku" />
                    <x-form-input name="surat_izin_tempat_usaha_dikeluarkan_oleh" label="Dikeluarkan Oleh" />
                    <x-form-input name="surat_izin_tempat_usaha_penanggungjawab" label="Nama Penanggungjawab" />
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
