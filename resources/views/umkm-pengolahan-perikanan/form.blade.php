<x-form-input name="nama_pelaku_usaha" label="Nama Pelaku Usaha" />
<x-form-input name="alamat" label="Alamat" />
<x-form-select name="id_desa" label="Desa/Kelurahan" :options="$listDesa ?? []" placeholder="Pilih" />
<x-form-select name="id_kecamatan" label="Kecamatan" :options="$listKecamatan ?? []" placeholder="Pilih" />
<x-form-input name="jenis_kegiatan" label="Jenis Kegiatan" />
<x-form-input name="produk_utama" label="Produk Utama yang Dihasilkan" />
<x-form-input type="number" name="jumlah_produksi_bulan" label="Jumlah Produksi/Bulan (Kg)" />
<x-form-input type="number" name="harga_beli_bahan_baku" label="Harga beli bahan baku (Rp/Kg)" />
<x-form-input type="number" name="harga_jual_produk" label="Harga Jual Produk (Rp)" />
<x-form-input name="wilayah_pemasaran" label="Wilayah Pemasaran" />
<x-form-input name="legalitas" label="Legalitas yang dimiliki" />
<x-form-input name="kendala" label="Kendala yang dihadapi" />
<div class="row mb-3 align-items-center">
    <label class="col-md-4 col-form-label">Apakah anda berusaha secara berkelompok?</label>
    <div class="col-md-8 d-flex gap-3">
        <x-form-input-radio name="berkelompok" value="1">Ya</x-form-input-radio>
        <x-form-input-radio name="berkelompok" value="0">Tidak</x-form-input-radio>
    </div>
</div>
<x-form-input name="nama_kelompok" label="Nama Kelompok" />
@include('base-page.form-file-foto', ['column_name_path' => 'foto_produk_url', 'column_name' => 'file']) 