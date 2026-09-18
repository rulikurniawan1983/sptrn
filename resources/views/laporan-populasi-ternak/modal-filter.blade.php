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
                        <h5 class="card-title mb-0">Jenis Ternak</h5>
                    </div>
                    <div class="card-body pt-4">
                        <div class="row">
                            <div class="col-lg-4">
                                <x-form-select name="jenis_ternak_populasi_id" label="Jenis Ternak" placeholder="Pilih"
                                    :horizontal="false" :options="$listJenisTernakPopulasi ?? []" :value="request('jenis_ternak_populasi_id')" />
                            </div>
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

@push('script')
<script>
    $(document).ready(function() {
        $(document).on('click', '.btn-filter', function() {
            $('#modal-filter').modal('hide');
            $('#form-filter').submit();
        });
    });
</script>
@endpush 