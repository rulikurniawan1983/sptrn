<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-8">
                <div class="bg-white border-3 mb-4 rounded border-dashed p-4">
                    <h3 class="fs-5 mb-3 fw-bolder">User</h3>
                    <div>
                        <x-detail-item label="Nama" :value="$item->name" />
                        <x-detail-item label="Email" :value="$item->email" />
                        <x-detail-item label="No. HP" :value="$item->no_hp" />
                        <x-detail-item label="Status">{!! $item->is_active_badge !!}</x-detail-item>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white border-3 mb-4 rounded border-dashed p-4">
                    <p class="small text-uppercase text-muted">Foto</p>
                    <div class="col-8 col-lg-5 col-xl-5 col-md-6 col-sm-6 mx-auto mb-3">
                        <img src="{{ $item->file_url }}" alt="" class="w-100">
                    </div>
                    <x-detail-list-action-time :item="$item" />
                </div>
            </div>
        </div>
    </div>
</div>
