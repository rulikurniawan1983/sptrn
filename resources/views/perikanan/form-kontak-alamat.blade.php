
{{ html()->model($item)->form('put', route($route . '.update', $item->id))->class('form form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
<div class="row">
    <div class="col-xl-6">
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
                <x-form-input type="textarea" name="alamat" label="Alamat" />
                <x-form-input type="number" name="kode_pos" label="Kode POS" />
                <x-form-input name="no_tlp_1" label="No. Telp 1" />
                <x-form-input name="no_tlp_2" label="No. Telp 2" />
                <x-form-input name="fax" label="Fax" />
                <x-form-input type="email" name="email" label="Email" />
                <x-form-input name="website" label="Website" />
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card shadow-sm">
            <div class="card-header border-bottom py-3 d-md-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Lokasi Maps</h5>
            </div>
            <div class="card-body pt-4">
                <div class="col-md-12">
                    <div class="mb-0">
                        <x-form-input name="cari" placeholder="Cari Lokasi"  :horizontal="false" :use-label="false" id="cari-lokasi"/>
                        <div class="my-2">
                            <label for="" id="coordinate-text" class="text-sm text-dark"></label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="mb-2">
                        <label class="form-label" for="">Radius (Dalam Meter) (Optional)</label>
                        {!! html()->number('radius')
                        ->class('form-control input-radius')
                        ->id('radius-range')
                        ->attribute('onchange', 'changeRadius(this)') !!}
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="mb-2">
                        <label class="form-label">Lokasi</label>
                        <div id='map_canvas' style="width: 100%; height: 400px;"></div>
                        {{ html()->hidden('id') }}

                        {{ html()->hidden('lat')->id("lat-location") }}
                        {{ html()->hidden('long')->id("long-location") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{ html()->form()->close() }}
@push('script')
<script src="{{ asset('assets/js/mark_map2.js') }}"></script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLfYq6P5OOj3MsiLaHks4qb7oMbhDXKqM&callback=initMap"
    type="text/javascript"></script>
<script>
    $(document).ready(function() {
        initMap();
        changeRadius($(".input-radius"));
    });
</script>
@endpush
