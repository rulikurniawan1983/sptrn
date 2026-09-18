@if (@$item == null)
    {{ html()->hidden('category_identity_id', $category_identity_id) }}
@endif
<x-form-input name="kode" label="Kode" autofocus />
<x-form-input name="name" label="Name" />
<x-form-select name="type" label="Type" placeholder="Pilih" :options="$listType" />
<x-form-input type="number" name="sequence" label="Sequence" />
