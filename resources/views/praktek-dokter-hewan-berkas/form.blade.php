{{ html()->hidden('id_praktek_dokter_hewan', $getParent->id) }}
<x-form-select name="id_berkas_keswan" label="Jenis Berkas" :options="$listBerkasKeswan" placeholder="Pilih" />
<x-form-input name="nama" label="Nama" autofocus />
<x-form-input type="date" name="tanggal_berkas" label="Tanggal Berkas" />
<x-form-input type="file" name="file_berkas" label="File Unggahan" />
