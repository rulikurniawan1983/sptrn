<div class="modal fade" id="modal-filter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header pb-3">
                <h5 class="modal-title">Filter Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light">
                <div class="card shadow-sm mb-4">
                    <div class="card-header border-bottom py-3 d-md-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Lokasi Peternakan</h5>
                    </div>
                    <div class="card-body pt-4">
                        <div class="row">
                            <div class="col-lg-4">
                                <x-form-select name="id_kecamatan" label="Kecamatan" placeholder="Pilih"
                                    :horizontal="false" :options="$listKecamatan" />
                            </div>
                            <div class="col-lg-4">
                                <x-form-select name="id_kelurahan" label="Kelurahan" placeholder="Pilih"
                                    :horizontal="false" :options="@$listKelurahan ?? []" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-sm mt-4">
                    <div class="card-header border-bottom py-3 d-md-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Lainnya</h5>
                    </div>
                    <div class="card-body pt-4">
                        <div class="row">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer py-2 px-3">
                <button type="button" class="btn btn-dark btn-filter">
                    Filter
                </button>
            </div>
        </div>
    </div>
</div>
