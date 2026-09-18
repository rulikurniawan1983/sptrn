{{ html()->hidden('id_peternakan', $getParent->id) }}

<div class="row mb-3">
    <label class="col-md-4 col-form-label">Tanggal Produksi</label>
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-6">
                <x-form-input type="date" name="tanggal_produksi_dari" autofocus :use-label="false" />
            </div>
            <div class="col-md-6">
                <x-form-input type="date" name="tanggal_produksi_sampai" autofocus :use-label="false" />
            </div>
        </div>
    </div>
</div>
<div class="row mb-3">
    <label class="col-md-4 col-form-label">Jumlah Kandang</label>
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-6">
                <x-form-input type="text" name="jumlah_kandang" autofocus :use-label="false" class="form-control numeral-mask" />
            </div>
            <div class="col-md-6">
                <x-form-select name="jumlah_kandang_id_satuan" :use-label="false" placeholder="Pilih Satuan" :options="$listSatuan"/>
            </div>
        </div>
    </div>
</div>
<div class="row mb-3">
    <label class="col-md-4 col-form-label">Jumlah Populasi</label>
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-6">
                <x-form-input type="text" name="jumlah_populasi" autofocus :use-label="false" class="form-control numeral-mask" />
            </div>
            <div class="col-md-6">
                <x-form-select name="jumlah_populasi_id_satuan" :use-label="false" placeholder="Pilih Satuan" :options="$listSatuan"/>
            </div>
        </div>
    </div>
</div>
<div class="row mb-3">
    <label class="col-md-4 col-form-label">Jumlah Hasil Produksi</label>
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-6">
                <x-form-input type="text" name="jumlah_produksi" autofocus :use-label="false" class="form-control numeral-mask" />
            </div>
            <div class="col-md-6">
                <x-form-select name="jumlah_produksi_id_satuan" :use-label="false" placeholder="Pilih Satuan" :options="$listSatuan"/>
            </div>
        </div>
    </div>
</div>