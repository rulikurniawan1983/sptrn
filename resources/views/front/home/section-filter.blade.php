<section class="hero-filter-section" style="margin-top: -70px; position: relative; z-index: 10;">
    <div class="container">
        {{ html()->hidden('latitude', @$getKecamatan->latitude) }}
        {{ html()->hidden('longitude', @$getKecamatan->longitude) }}
        {{ html()->form('GET', route('home.index'))->attribute('enctype', 'multipart/form-data')->id('form-filter')->class('form-custom')->open() }}
        <div class="filter-card">
            <div class="filter-card-body">
                <div class="row g-3">
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label">Keyword</label>
                        <x-form-input name="q" label="" placeholder="Nama Peternakan/Perikanan" :value="@$request['q']"
                            :horizontal="false" :use-label="false" class="form-control" />
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label">Jenis</label>
                        <x-form-select name="jenis" label="" placeholder="=== Semua Jenis ===" 
                            :options="['peternakan' => 'Peternakan', 'perikanan' => 'Perikanan']" 
                            :value="@$request['jenis']"
                            :horizontal="false" :use-label="false" 
                            class="form-control select2" />
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label">Kecamatan</label>
                        <x-form-select name="id_kecamatan" label="" placeholder="=== Semua Kecamatan ===" 
                            :options="$listKecamatan"
                            :value="@$request['id_kecamatan']" 
                            :horizontal="false" :use-label="false"
                            class="form-control select2" />
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label">Desa/Kelurahan</label>
                        <x-form-select name="id_kelurahan" label="" placeholder="=== Semua Desa/Kelurahan ===" 
                            :options="@$listKelurahan ?? []"
                            :value="@$request['id_kelurahan']" 
                            :horizontal="false" :use-label="false"
                            class="form-control select2" />
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-search me-2"></i>
                        Cari Data
                    </button>
                </div>
            </div>
        </div>
        {{ html()->form()->close() }}
    </div>
</section>

@push('styles')
<style>
.hero-filter-section {
    padding-bottom: 2rem;
}

.filter-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(var(--bs-border-color-translucent-rgb, 219, 218, 222), 0.2);
}

.filter-card-body {
    padding: 1.5rem;
}

@media (max-width: 767.98px) {
    .filter-card-body {
        padding: 1rem;
    }
}
</style>
@endpush
