{{ html()->hidden('id_status_penyakit', $getParent->id) }}
<x-form-select name="tahun" label="Tahun" :options="$listTahun" placeholder="Pilih" />
<x-form-select name="id_status_penyakit_hewan" label="Hewan" placeholder="Pilih" :options="$listStatusPenyakitHewan"/>
<x-form-input name="jumlah_terinfeksi" label="Jumlah Terinfeksi"/>
<x-form-input name="jumlah_mati" label="Jumlah Mati"/>
<x-form-input name="jumlah_sembuh" label="Jumlah Sembuh"/>