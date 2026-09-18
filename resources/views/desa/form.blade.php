<x-form-input name="nama" label="Nama" autofocus />
<x-form-select name="id_kecamatan" label="Kecamatan" required placeholder="Pilih" :options="$listKecamatan" />
<x-form-input name="latitude" label="Latitude" />
<x-form-input name="longitude" label="Longitude" />
