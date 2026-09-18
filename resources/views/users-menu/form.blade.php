<x-form-input name="nama" label="Nama" autofocus />
<x-form-input name="kode" label="Kode" />
<x-form-input name="icon" label="Icon">
    <small>
        Silakan cari icon di laman ini
        <a href="https://tabler-icons.io/" target="_blank">https://tabler-icons.io/</a>
    </small>
</x-form-input>
<x-form-select name="rel" label="Parent" :options="$listUsersMenu" placeholder="Pilih" />
<x-form-select name="permission_id" label="Permission" :options="$get_Permission" placeholder="Pilih" />
<x-form-input name="url" label="Url" />
<x-form-input type="number" name="urutan" label="Urutan" />
