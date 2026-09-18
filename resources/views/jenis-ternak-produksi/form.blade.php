<x-form-input name="nama" label="Nama" autofocus />
<x-form-select name="jenis_produksi_id" label="Jenis Produksi" :options="$listJenisProduksi ?? []" placeholder="Pilih" /> 