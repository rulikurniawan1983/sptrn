{{ html()->hidden('id_perikanan', $getParent->id) }}
<x-form-select name="id_berkas_perikanan" label="Jenis Berkas" :options="$listBerkasPerikanan" placeholder="Pilih" />
<x-form-input name="nama" label="Nama" autofocus />
<x-form-input type="date" name="tanggal_berkas" label="Tanggal Berkas" />
<x-form-input type="file" name="file_berkas" label="File Unggahan" />
