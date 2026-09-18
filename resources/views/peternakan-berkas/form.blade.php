{{ html()->hidden('id_peternakan', $getParent->id) }}
<x-form-select name="id_berkas_peternakan" label="Jenis Berkas" :options="$listBerkasPeternakan" placeholder="Pilih" />
<x-form-input name="nama" label="Nama" autofocus />
<x-form-input type="date" name="tanggal_berkas" label="Tanggal Berkas" />
<x-form-input type="file" name="file_berkas" label="File Unggahan" />
