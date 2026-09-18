{{ html()->hidden('id_perikanan', $getParent->id) }}
<x-form-input name="nama" label="Nama" placeholder="Masukkan Nama" />
<x-form-select name="id_jenis_galeri" label="Jenis Galeri" placeholder="Pilih Jenis" :options="$listJenisGaleri"/>
@include('base-page.form-file-foto', ['column_name_path' => 'file_foto', 'column_name' => 'file'])