<x-form-select name="jenis_ternak_produksi_id" label="Jenis Ternak Produksi" :options="$listJenisTernakProduksi ?? []" placeholder="Pilih" />
<x-form-select name="tahun" label="Tahun" :options="$listTahun ?? []" placeholder="Pilih" />
<x-form-input type="number" name="jumlah" label="Jumlah" />
<x-form-select name="id_kecamatan" label="Kecamatan" :options="$listKecamatan ?? []" placeholder="Pilih" /> 